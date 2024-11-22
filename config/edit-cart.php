<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        session_start();
        
        $quantity = $_POST['quantity']; 
        $id = $_POST['id'];
        $user_id = $_SESSION['id'];

        if ( (isset($_POST['addition'])) || (isset($_POST['subtraction'])) ){
            
            require 'conn.php';

            if (isset($_POST['addition'])){
                $quantity += 1;
            }
                $quantity -= 1;{
            }
            

            $stmt = $con->prepare("UPDATE carrito SET cantidad = ? WHERE ID_producto = ? AND ID_usuario = ?");
            $stmt->bind_param('iii',$quantity,$id,$user_id);
            
            if($stmt->execute()){
                $_SESSION['error'] = 'There is a problem with the database.';
                header('location: /U-Tech/src/pages/cart.php');
                exit;
            }
            
   
        }    
         else if (isset($_POST['del'])){
            $_SESSION['error'] = 'deleted';
            header('location: /U-Tech/src/pages/cart.php');
            exit;
        } else{
            $_SESSION['success'] = 'There was an error.';
            header('location: /U-Tech/src/pages/cart.php');
            exit;
        }
    } else{
        $_SESSION['error'] = 'POST method required.';
        header('location: /U-Tech/src/pages/cart.php');
    }