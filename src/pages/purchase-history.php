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
    <title>Purchase History</title>
    <style>
        .purchase-item {
            background-color: #f8f9fa;
            padding: 15px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .purchase-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .purchase-item p {
            margin: 0 0 5px;
            color: #333;
        }
    </style>
    <?php 
        require_once '../../config/config.php';
        require BASE_PATH . 'src/components/header.php'; //HEADER
        
    ?>
    <!-- INICIO CONTENIDO -->
    <section class="content">
        <div class="container px-lg-5 mb-5">
            <div class="row rounded-5 mb-4 mt-lg-0 mt-5" style="background-color: #845162; padding: 20px;">
                <h2 class="color1 text-center w-100">My Purchases</h2>
            </div>
            <?php
                require '../../config/conn.php';
                $user_id = $_SESSION['id'];

                $query = "SELECT P.nombre as producto, descripcion, H.cantidad, fabricante, foto
                        FROM productos AS P 
                        JOIN historial_compras AS H ON H.ID_producto = P.ID_producto 
                        JOIN usuarios AS U ON H.ID_usuario = U.ID_usuario
                        JOIN imagenes AS I ON I.ID_img = P.ID_img
                        WHERE $user_id = H.ID_usuario";
                $res = mysqli_query($con, $query);

                // Iteramos sobre cada producto
                while ($row = mysqli_fetch_array($res)) {
                    echo '<div class="row mb-4 purchase-item shadow rounded-5">'.
                            '<div class="col-md-3 text-center">'.
                                '<img src="' . $row['foto'] . '" class="img-fluid rounded-5">'.
                            '</div>'.
                            '<div class="col-md-9">'.
                                '<h5 class="color3">' . $row['producto'] . '</h5>'.
                                '<p class="color4">' . $row['descripcion'] . '</p>'.
                                '<p class="text-secondary"><strong>Supplier:</strong> ' . $row['fabricante'] . '</p>'.
                                '<p class="text-secondary"><strong>Quantity:</strong> ' . $row['cantidad'] . '</p>'.
                            '</div>'.
                        '</div>';
                }
            ?>
        </div>
    </section>
    <!-- FIN CONTENIDO -->
    <?php include '../components/footer.php' ?>  <!--HEADER -->