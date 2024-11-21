<?php
    session_start();
    if (!isset($_GET['cat-id']) || $_GET['cat-id'] < 1 || $_GET['cat-id'] > 4) {
        $_SESSION['error'] = 'Invalid category ID.';
        header('location: /U-Tech/index.php');
        exit();
    } else{
        require '../../config/conn.php';

        // Consulta de productos de acuerdo a la categoría
        $stmt = $con->prepare("SELECT * FROM productos WHERE ID_categoria = ?");
        $stmt->bind_param('i',$_GET['cat-id']);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0){
            $_SESSION['error'] =  'No products were found.';
            $stmt->close();
            $con->close();
            header('location: /U-Tech/index.php');
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCTS</title>
    <link rel="stylesheet" href="<?php echo '/U-Tech/src/styles/style-prod.css'; ?>">
    <?php 
        require_once '../../config/config.php';
        require BASE_PATH . 'src/components/header.php'; //HEADER
        
        //ALERTAS
        if (isset($_SESSION['error'])) {
            echo '<script>
                    Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "'. $_SESSION['error'] . '",
                            });
                    </script>';
            unset($_SESSION['error']); 
        } else if (isset($_SESSION['success'])){
            echo '
                <script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "' . $_SESSION['success'] . ' ",
                        showConfirmButton: true,
                        timer: 1500
                    });
                </script>';
                unset($_SESSION['success']);
            }
    ?>
    <!-- INICIO CONTENIDO -->
    <section class="container-fluid content my-5 text-center pb-lg-5">
    <div class="container">
        <h2 class="mb-4 color3">PHONES</h2>
    </div>

    <div class="container cat">

        <?php 
            $n = 0;
            while ($producto = $res->fetch_assoc()){
                // EXTRAEMOS LA IMAGEN
                $q_img = $con->prepare("SELECT foto FROM imagenes WHERE ID_img = ?");
                $q_img->bind_param('i',$producto['ID_img']);
                $q_img->execute();
                $img = $q_img->get_result()->fetch_assoc();
                
                // TARJETA DE PRODUCTO
                if ($n % 3 == 0){
                    echo '<div class="row g-4 justify-content-start">';
                } 
                echo '<div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card p-3 shadow rounded" style="background-color: #f5f3ef; border: none;">
                            <!-- Imagen del producto -->
                            <img src="' . $img['foto'] . '" class="img-fluid mb-3" alt="Product Img">

                            <!-- Cuerpo de la tarjeta -->
                            <div class=" rounded-5">
                                <!-- Título del producto -->
                                <p class="card-title text-white rounded px-1 py-1 mb-3 fs-5" style="background-color: #522c5d;">
                                    ' . $producto['nombre'] . '
                                </p>

                                <!-- Descripción del producto -->
                                <p class="card-text color5 fs-6">
                                    ' . $producto['descripcion'] . '
                                </p>

                                <!-- Información adicional -->
                                <ul class="list-group list-group-flush" style="background-color: #f5f3ef;">
                                    <li class="list-group-item border-0 px-0 py-1"><strong>Price:</strong> $' . $producto['precio'] . '</li>
                                    <li class="list-group-item border-0 px-0 py-1"><strong>Manufacturer:</strong> ' . $producto['fabricante']. '</li>
                                    <li class="list-group-item border-0 px-0 py-1"><strong>Origin:</strong>' . $producto['origen'] . '</li>
                                </ul>

                                <!-- Botón agregar al carrito -->
                                <a class="add-button btn px-4 py-2 mt-4 rounded w-100" href="/U-Tech/config/add-cart.php?prod-id="' . $producto['ID_producto'] . '" style="background-color: #522c5d;">
                                    <i class="bi bi-cart-plus"></i>&emsp;ADD TO CART
                                </a>
                            </div>
                        </div>
                    </div>';
                $n++;
                if ($n % 3 == 0){
                    echo '</div';
                } 
            }
            if ($n % 3 != 0){
                echo '</div>';
            }

            // Cerramos las consultas y la conexión
            $stmt->close();
            $q_img->close();
            $con->close();
        ?>                    
    </div>
</section>
    <!-- FIN CONTENIDO -->
    <?php include '../components/footer.php' ?>  <!--HEADER -->