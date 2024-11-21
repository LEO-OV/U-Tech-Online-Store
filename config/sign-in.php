<?php 
    require 'conn.php';
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars(($data));
        return $data;
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_start();

        $mail = test_input($_POST['mail-in']);
        $pwd = test_input($_POST['passwd-in']);

        // Consulta preparada
        $query = "SELECT ID_usuario, nombre, contrasena, permisos FROM usuarios WHERE correo = ?";
        $stmt = $con->prepare($query);
        
        // Bind de parámetros
        $stmt->bind_param("s", $mail);
        // Ejecuta la consulta
        $stmt->execute();

        // Obtiene los resultados
        $res = $stmt->get_result() -> fetch_assoc();
        
        if ($res) {
            //Verificamos que la contraseña coincida
            if (password_verify($pwd, $res['contrasena'])){
                // Si la contraseña coincide inicia la sesion
                $_SESSION['success'] = 'Welcome back '.$res['nombre'].'!';
                $_SESSION['id'] = $res['ID_usuario']; // Sesión para el ID
                $_SESSION['username'] = $res['nombre']; // Sesión para el nombre
                $_SESSION['perm'] = $res['permisos']; // Sesión para los permisos
                $stmt->close();
                $con->close();
                header('location: /U-Tech/index.php');
                exit;
            } else{
                $_SESSION['error'] = 'The data entered is incorrect!';
                $stmt->close();
                $con->close();
                header('location: /U-tech/src/pages/login.php');
                exit;
            }
        } else{
            $_SESSION['error'] = 'Theres was a problem accessing the database.';
            $stmt->close();
            $con->close();
            header('location: /U-tech/src/pages/login.php');
            exit;
        }
        
    } else{
        $_SESSION['error'] = 'POST request method required';
        $con->close();
        header('location: /U-tech/src/pages/login.php');
        exit;
    }
   