<?php 
    session_start();
    if(isset($_SESSION['id']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        require 'val-functions.php';
        require 'conn.php';
        // Extraemos los datos
        $id = $_SESSION['id'];
        $name = test_input($_POST['name']); 
        $pwd = $_POST['passwd'];
        $bdate = $_POST['bdate'];
        $card = test_input($_POST['c-card']);
        $add = test_input($_POST['address']);    
        
        //Validamos la tarjeta de credito
        if (!card_validation($card)){
            $_SESSION['error'] = 'The credit card is invalid.';
            $con->close();
            header('location: /U-tech/src/pages/account-management.php');
            exit;
        } 

        if (empty($passwd)){
            $registro = "UPDATE usuarios set nombre=?, f_nacimiento=?, tarjeta=?, postal=? WHERE ID_usuario = ?";
            $stmt = $con->prepare($registro);        
            $stmt->bind_param("sssii", $name,$bdate,$card,$add,$id);
        } else {
            $hased_pwd = password_hash($passwd,PASSWORD_DEFAULT);
            $registro = "UPDATE usuarios set nombre=?, contrasena=?, f_nacimiento=?, tarjeta=?, postal=? WHERE ID_usuario = ?";
            $stmt = $con->prepare($registro);        
            $stmt->bind_param("ssssii", $name, $hased_pwd,$bdate,$card,$add,$id);
        }
        
        if ($stmt->execute()) {
            // Registro exitoso
            $_SESSION['success'] = 'Data updated succesfully!';
            $_SESSION['username'] = $name; 
        } else {
            //No se pudo realizar el registro
            $_SESSION['error'] = 'There was a problem updating the data.';
        }
        $stmt->close();
        $con->close(); 
        header('location: /U-tech/src/pages/account-management.php');
    } else{
        $_SESSION['error'] = 'POST request method required';
        header('location: /U-tech/src/pages/account-management.php');
        exit;
    }
    exit;