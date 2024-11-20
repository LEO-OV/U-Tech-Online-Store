<?php 
    require 'a-conn.php';
    session_start();
    if  (isset($_GET['id-prod'])){
        $id = intval($_GET['id-prod']);
        $query = "DELETE FROM productos WHERE ID_producto = $id";
        if (mysqli_query($con,$query)){
            $_SESSION['success'] = 'Product deleted succesfully';
        } else{
            $_SESSION['error'] = 'There was a problem deleting the product';
        }
    } else{
        $_SESSION['error'] = 'There was a problem.';
    }
    
    $con -> close();
    header('location: /U-tech/src/admin/pages/updt-prod.php');  