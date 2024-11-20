<?php 
    require 'a-conn.php';
    session_start();
    if  (isset($_GET['id-user'])){
        $id = intval($_GET['id-user']);
        $query = "DELETE FROM usuarios WHERE ID_usuario = $id";
        if (mysqli_query($con,$query)){
            $_SESSION['success'] = 'User deleted succesfully.';
        } else{
            $_SESSION['error'] = 'There was a problem deleting the user';
        }
    } else{
        $_SESSION['error'] = 'There was a problem.';
    }
    
    $con->close();
    header('location: /U-Tech/src/admin/pages/updt-user.php');