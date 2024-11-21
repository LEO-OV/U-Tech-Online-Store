<?php
    require 'val-functions.php';
    require 'a-conn.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_start();
        //Se extraen los datos
        $mail = test_input($_POST['email']);
        $name = test_input($_POST['name']);
        $pwd = $_POST['passwd'];
        $bdate = $_POST['bdate'];
        $card = test_input($_POST['c-card']);
        $add = test_input($_POST['add']);
        $perm = $_POST['perm'];  
        
        // Verificamos que el correo no este registrado
        $query = "SELECT correo FROM usuarios WHERE correo = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $res = $stmt->get_result();
        
        //Si el mail ya esta registrado
        if ($res->num_rows > 0){
            $_SESSION['error'] = "E-mail already registered, try a different one.";
            $stmt->close();
            $con->close();
            header('location: /U-tech/src/admin/pages/add-user.php');
        }
        //Validamos la tarjeta de credito
        if (!card_validation($card)){
            $_SESSION['error'] = 'The credit card is invalid.';
            $con->close();
            header('location: /U-tech/src/admin/pages/add-user.php');
        } 
        //Encriptamos la contraseña
        $hased_pwd = password_hash($_POST['passwd-up'],PASSWORD_DEFAULT);

        //Si los datos son validos procedemos con el registro
        $registro = "INSERT INTO usuarios (nombre, correo, contrasena, f_nacimiento, tarjeta, postal, permisos) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($registro);        
        
        // Ejecuta el registro
        $stmt->bind_param("sssssii", $name, $mail, $hased_pwd,$bdate,$card,$add,$perm);
        
        if ($stmt->execute()) {
            // Registro exitoso
            $_SESSION['success'] = 'User '.$name.' added succesfully!';
            $stmt->close();
            $con->close();
            header('location: /U-tech/src/admin/pages/add-user.php');
        } else {
            //No se pudo realizar el registro
            $_SESSION['error'] = 'There was a problem in the registration';
            $stmt->close();
            $con->close();
            header('location: /U-tech/src/admin/pages/add-user.php');   
        }
    } else{
        $_SESSION['error'] = 'POST request method required.';
        header('location: /U-tech/src/admin/pages/add-user.php');  
    } 
    exit;