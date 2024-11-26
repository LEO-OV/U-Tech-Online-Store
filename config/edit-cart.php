<?php
    // FUNCIÓN PARA ELIMINAR PRODUCTOS DEL CARRITO
    function eliminar ($prod_id, $user_id){
        require 'conn.php';

        $stmt = $con->prepare("DELETE FROM carrito WHERE ID_producto = ? AND ID_usuario = ?");
        if(!$stmt){
            $con->close();
            return false;
        }
        
        $stmt->bind_param('ii',$prod_id,$user_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    // FUNCIÓN PARA VACIAR EL CARRITO
    function empy_cart ($user_id){
        require 'conn.php';
        
        $stmt = $con->prepare("SELECT COUNT(*) AS total FROM carrito WHERE ID_usuario = ?");
        if(!$stmt){
            $con->close();
            return false;
        }
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        
        if ($row['total'] < 1){
            return true;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        session_start();
        
        $quantity = intval($_POST['quantity']) ; 
        $id = intval ($_POST['id']);
        $user_id = $_SESSION['id'];

        if ( isset($_POST['addition']) || isset($_POST['subtraction']) ){
            
            require 'conn.php';

            // AUMENTAR ITEM
            if (isset($_POST['addition'])){
                $quantity += 1;
            } 
            // RESTAR ITEM
            else{
                $quantity -= 1;
                if ($quantity < 1){
                    // SI LA RESTA ES < A 0 SE ELIMINA EL ITEM
                    if (eliminar ($id,$user_id)){
                        if (empy_cart($user_id)){
                            unset($_SESSION['cart']);
                            $_SESSION['info'] = 'You have emptied your shopping cart!';
                            header('location: /U-Tech/index.php');
                            exit;
                        }
                        $_SESSION['success'] = 'Product deleted successfully.';
                        header('location: /U-Tech/src/pages/cart.php');
                        exit;
                    } else{
                        $_SESSION['error'] = 'Could not delete the product.';
                        header('location: /U-Tech/src/pages/cart.php');
                        exit;
                    }
                }
            }            
            // SE HACE EL UPDATE DE LA CANTIDAD EN EL CARRITO
            $stmt = $con->prepare("UPDATE carrito SET cantidad = ? WHERE ID_producto = ? AND ID_usuario = ?");
            $stmt->bind_param('iii',$quantity,$id, $user_id);
            
            if(!$stmt->execute()){
                $_SESSION['error'] = 'There is a problem with the database.';
            }
            $stmt->close();
            $con->close();
            header('location: /U-Tech/src/pages/cart.php');
            exit;
            
            // SI SE DESEA ELIMINAR EL PRODUCTO
        } else if (isset($_POST['trash'])){
            if (eliminar ($id,$user_id)){
                if (empy_cart($user_id)){
                    unset($_SESSION['cart']);
                    $_SESSION['info'] = 'You have emptied your shopping cart!';
                    header('location: /U-Tech/index.php');
                    exit;
                } else{
                    $_SESSION['success'] = 'Product deleted successfully.';
                    header('location: /U-Tech/src/pages/cart.php');
                    exit;
                }   
            } else{
                $_SESSION['error'] = 'The item was not deleted.';
            }
        } 
    } 
    $_SESSION['error'] = 'There was an error.';
    header('location: /U-Tech/src/pages/cart.php');
    exit;