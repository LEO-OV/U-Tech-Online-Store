<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require 'a-conn.php';
        require 'val-functions.php';
        //Se extraen los datos
        $id = $_POST['id'];
        $name = test_input($_POST['name']);
        $passwd =test_input( $_POST['passwd']);
        $bdate = $_POST['bdate'];
        $card = test_input($_POST['c-card']);
        $add = test_input($_POST['add']);
        $perm = $_POST['perm'];  
        

        //Validamos la tarjeta de credito
        if (!card_validation($card)){
            $_SESSION['error'] = 'The credit card is invalid.';
            header('location: /U-Tech/src/admin/pages/u-user-form.php?id-user='.$id);
            exit;
        } 

        // Verificamos si se modifico la contraseña y hacemos el registro
        if (empty($passwd)){
            $registro = "UPDATE usuarios set nombre=?, f_nacimiento=?, tarjeta=?, postal=?, permisos=? WHERE ID_usuario = ?";
            $stmt = $con->prepare($registro);        
            $stmt->bind_param("sssiii", $name,$bdate,$card,$add,$perm,$id);
        } else {
            $hased_pwd = password_hash($passwd,PASSWORD_DEFAULT);
            $registro = "UPDATE usuarios set nombre=?, contrasena=?, f_nacimiento=?, tarjeta=?, postal=?, permisos=? WHERE ID_usuario = ?";
            $stmt = $con->prepare($registro);        
            $stmt->bind_param("ssssiii", $name, $hased_pwd,$bdate,$card,$add,$perm,$id);
        }

        //Ejecutamos los cambios
        if ($stmt->execute()) {
            $_SESSION['success'] = 'User '.$name.' updated succesfully!';
        } else {
            //No se pudo realizar el registro
            $_SESSION['error'] = 'There was a problem updating the data';
        }
        $stmt->close();
        $con->close();
        header('location: /U-Tech/src/admin/pages/u-user-form.php?id-user='.$id);

    } else{
        $_SESSION['error'] = 'POST request method required';
        header('location: /U-Tech/src/admin/pages/updt-user.php');
    }
    exit;
