<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars(($data));
        return $data;
    }
    function card_validation($num_card){
        $num_card = preg_replace('/\D/', '', $num_card);

        // Verificar que el número tenga solo dígitos
        if (!ctype_digit($num_card)) {
            return false; // El número contiene caracteres no válidos
        }
        $sum = 0;
        $len = strlen($num_card);
        $par = $len % 2 === 0; // Determina si la longitud es par

        for ($i = 0; $i < $len; $i++) {
            $digito = (int)$num_card[$i];

            // Duplica cada segundo dígito desde la derecha
            if (($i % 2 === 0 && $par) || ($i % 2 !== 0 && !$par)) {
                $digito *= 2;
                if ($digito > 9) {
                    $digito -= 9; // Si el dígito es mayor a 9, resta 9
                }
            }
            $sum += $digito;
        }

        // Es válido si la suma es divisible por 10
        return $sum % 10 === 0;
    }

    require 'conn.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_start();
        //Se extraen los datos
        $mail = test_input($_POST['mail-up']);
        $name = test_input($_POST['name']);
        $pwd = $_POST['passwd-up'];
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
        $stmt->bind_param("ssssiii", $name, $mail, $hased_pwd,$bdate,$card,$add,$permisos);
        
        if ($stmt->execute()) {
            // Registro exitoso
            $_SESSION['success'] = 'Welcome to U-Tech '.$name.'!';
            $_SESSION['id'] = $stmt->insert_id; // Sesión para el ID
            $_SESSION['username'] = $name; // Sesión para el nombre
            $stmt->close();
            $con->close();
            header('location: ../index.php');
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