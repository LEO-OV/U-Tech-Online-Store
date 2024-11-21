<?php
    require 'val-functions.php';
    require 'conn.php';
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Se extraen los datos
        $mail = test_input($_POST['mail-up']);
        $name = test_input($_POST['name']);
        $pwd = test_input($_POST['passwd-up']);
        $bdate = $_POST['bdate'];
        $card = test_input($_POST['c-card']);
        $add = test_input($_POST['address']);    
        
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
            header('location: /U-tech/src/pages/login.php');
            exit;
        }
        //Validamos la tarjeta de credito
        if (!card_validation($card)){
            $_SESSION['error'] = 'The credit card is invalid.';
            $con->close();
            header('location: /U-tech/src/pages/login.php');
            exit;
        } 
        //Encriptamos la contraseña
        $hased_pwd = password_hash($_POST['passwd-up'],PASSWORD_DEFAULT);

        //Si los datos son validos procedemos con el registro
        $registro = "INSERT INTO usuarios (nombre, correo, contrasena, f_nacimiento, tarjeta, postal, permisos) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($registro);
        $permisos = 0; //Permisos de usuario
        
        
        // Ejecuta el registro
        $stmt->bind_param("sssssii", $name, $mail, $hased_pwd,$bdate,$card,$add,$permisos);
        
        if ($stmt->execute()) {
            // Registro exitoso
            $_SESSION['success'] = 'Welcome to U-Tech '.$name.'!';
            $_SESSION['id'] = $stmt->insert_id; // Sesión para el ID
            $_SESSION['username'] = $name; // Sesión para el nombre
            $_SESSION['perm'] = $permisos; // Sesión para los permisos
            $stmt->close();
            $con->close();
            header('location: /U-Tech/index.php');
            exit;
        } else {
            //No se pudo realizar el registro
            $_SESSION['error'] = 'There was a problem in the registration';
            $stmt->close();
            $con->close();
            header('location: /U-tech/src/pages/login.php');   
        }
    } else{
        $_SESSION['error'] = 'POST request method required';
        $con->close();
        header('location: /U-tech/src/pages/login.php');  
        exit();
    }