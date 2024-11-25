<?php 
    session_start();
    function empty_c ($ID_usuario){
        include 'conn.php';
        $stmt = $con->prepare("DELETE FROM carrito WHERE ID_usuario = ?");
        $stmt->bind_param('i',$ID_usuario);
        $stmt->execute();
        $stmt->close();
        $con->close();
     }

    if (isset($_SESSION['id']) || isset($_SESSION['cart'])){
        $user_id = $_SESSION['id'];
        
        require 'conn.php';

        $stmt = $con->prepare("SELECT ID_producto, cantidad FROM carrito WHERE ID_usuario = ?");
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        if($res->num_rows>0){
            while ($prod = $res->fetch_assoc()){
                
                $cant = $prod['cantidad'];
                $curr_prod = $prod['ID_producto'];

                //RESTAR DEL ALMACÉN 
                $sub_prod = $con->prepare("SELECT cantidad FROM productos WHERE ID_producto = ?");
                $sub_prod->bind_param('i',$curr_prod);
                $sub_prod->execute();
                $prod_cant = $sub_prod->get_result()->fetch_assoc();
                $sub_prod->close();
                if ( ($new_cant = $prod_cant['cantidad']- $cant) < 0){
                    $_SESSION['error'] = 'Not enough stock in the warehouse.';
                    $con->close();
                    header('location: /U-Tech/src/pages/cart.php'); 
                } else{
                    $updt_stmt = $con->prepare("UPDATE productos SET cantidad = ?  WHERE ID_producto = ?");
                    $updt_stmt->bind_param('ii',$new_cant,$curr_prod);
                    $updt_stmt->execute();
                }
                
                //Pasamos la informacion al historial de compras
                $ins_stmt = $con->prepare("INSERT INTO historial_compras (ID_usuario, ID_producto, cantidad) VALUES (?, ?, ?)");
                $ins_stmt->bind_param('iii',$user_id,$curr_prod, $cant);
                
                if($ins_stmt->execute()){
                    $_SESSION['purchase'] = "Thank you for your purchase <3";
                } else {
                    $_SESSION['error'] = "Couldn't proccess the purchase.";
                }
            }
            empty_c($user_id);
            unset($_SESSION['cart']);
            $ins_stmt->close();
            $con->close();
            header('location: /U-Tech/src/pages/cart.php'); 
        } else{
            empty_c($user_id);
            unset($_SESSION['cart']);
            $_SESSION['error'] = 'There was a request problem.';
            $con->close();
            header('location: /U-Tech/src/pages/cart.php'); 
        }
        

        // unset($_SESSION['cart']);
    } else{
        $_SESSION['error'] = 'Can not access this page.';
        header('location: /U-Tech/index.php'); 
    }