<?php
    if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Solo inicia la sesión si no está activa
        }
    
    if(!isset($_SESSION['id'])){
        $_SESSION['error'] = 'You need to be logged in to access this page';
        header('location: /U-Tech/src/pages/login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <?php 
        require_once '../../config/config.php';
        require BASE_PATH . 'src/components/header.php'; //HEADER
        
    ?>
    <!-- INICIO CONTENIDO -->
    <section class="content">

    </section>
    <!-- FIN CONTENIDO -->
    <?php include '../components/footer.php' ?>  <!--HEADER -->