<?php
    if (session_status() === PHP_SESSION_NONE) {
         session_start(); // Solo inicia la sesión si no está activa
    }
    
    if (!isset($_SESSION['id'])){
        $_SESSION['error'] = 'Please login before adding to cart.';
        header('location: /U-Tech/src/pages/login.php');
    } else{
       
        // VALIDAMOS LA URL
        if (!isset($_GET['prod-id']) || $_GET['prod-id'] < 0) {
            $_SESSION['error'] = 'Invalid URL.';
        }
        else{
            $_SESSION['cart'] = true;
            require 'conn.php';
            
            $user_id = $_SESSION['id'];
            $prod_id = intval($_GET['prod-id']);
            $cat_id = isset($_GET['cat-id'])? intval($_GET['cat-id']):null;

            //Validamos que no se haya agregado el producto anteriormente
            $query =  $con->prepare("SELECT cantidad FROM carrito WHERE ID_usuario = ? AND ID_producto = ?");
            $query->bind_param('ii',$user_id,$prod_id);
            $query->execute();
            $res = $query->get_result()->fetch_assoc();
            
            if ($res){
                //Si ya se había agregado el producto, aumentamos la cantidad
                $n = $res['cantidad']+1;
                $stmt = $con->prepare("UPDATE carrito SET cantidad = ? WHERE ID_usuario = ? AND ID_producto = ?");
            } else{
                //Para productos nuevos
                $n = 1;
                $stmt = $con->prepare("INSERT INTO carrito (cantidad, ID_usuario, ID_producto) VALUES (?, ?, ?)");
            }
            $query->close();
            $stmt->bind_param('iii', $n, $user_id, $prod_id,);
            
            if ($stmt->execute()){
                $_SESSION['success'] = 'Product added successfully';
            } else{
                $_SESSION['error'] = 'There was a problem adding the product';
            }
            }
            $stmt->close();
            $con->close();
            header('location: /U-Tech/src/pages/product.php?cat-id=' . $_GET['cat-id']);
            exit();
    } 