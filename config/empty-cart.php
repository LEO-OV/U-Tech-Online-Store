<?php
    session_start();
    if (isset($_GET['action']) && $_GET['action'] === 'empty') {
        $user_id = $_GET['user_id'] ?? null;
        empty_c($user_id);

        unset($_SESSION['cart']);
        header("Location: /U-Tech/src/pages/cart.php");
        exit;
    }
 function empty_c ($ID_usuario){
    include 'conn.php';
    $stmt = $con->prepare("DELETE FROM carrito WHERE ID_usuario = ?");
    $stmt->bind_param('i',$ID_usuario);
    $stmt->execute();
    $stmt->close();
    $con->close();
 }