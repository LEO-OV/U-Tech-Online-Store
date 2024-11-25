<?php
     if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_GET['cat-id']) || $_GET['cat-id'] < 1 || $_GET['cat-id'] > 4) {
        $_SESSION['error'] = 'URL not found.';
        header('location: /U-Tech/index.php');
        exit();
    } else{
        require '../../config/conn.php';
        $cat_id=$_GET['cat-id'];
        // Consulta de productos de acuerdo a la categoría
        $prod_stmt = $con->prepare("SELECT * FROM productos WHERE ID_categoria = ?");
        $prod_stmt->bind_param('i',$cat_id);
        $prod_stmt->execute();
        $results = $prod_stmt->get_result();

        // Obtenemos el nombre de la categoría
        $query = "SELECT nombre FROM categoria WHERE ID_categoria = $cat_id";
        $title = mysqli_query($con,$query)->fetch_assoc();

        if ($results->num_rows == 0){
            $_SESSION['error'] = 'No products were found.';
            $prod_stmt->close();
            $con->close();
            header('location: /U-Tech/index.php');
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCTS</title>
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
    <style>
        .add-button{
            text-decoration: none;
            color:  white !important;
            opacity: 0.8;
            width: 80%;
            background-color: #522c5d !important;
        }
        .add-button:hover{
            transform: scale(1.1);
            opacity: 1;
        }
        .add-info{
            margin: 0;
            padding: 0;
        }
    </style>
    <!-- INICIO CONTENIDO -->
    <section class="container-fluid content my-5 text-center pb-lg-5">
    <div class="container">
        <h2 class="mb-4 color3 text-uppercase"><?php echo $title['nombre']; ?>s</h2>
    </div>

    <div class="container cat">

        <?php 
            $n = 0;
            while ($producto = $results->fetch_assoc()){
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
                        <div class="card rounded pb-3 shadow" style="border: none; height: 100%">
                            <!-- Imagen del producto -->
                            <img src="' . $img['foto'] . '" class="img-fluid mb-1 rounded-top img-hover" alt="Product Img">

                            <!-- Cuerpo de la tarjeta -->
                            <div class="card-body pb-4">
                                <!-- Título del producto -->
                                <p class="card-title color5 fs-5">
                                    ' . $producto['nombre'] . '
                                </p>    

                                <!-- Información adicional -->
                                <ul class="list-unstyled">
                                    <li class="color3"><strong>$' . $producto['precio'] . '</strong></li>
                                    <li class="text-secondary"><strong>' . $producto['fabricante'] . '</strong></li>
                                </ul>

                                <!-- Descripción del producto -->
                                <p class="card-text text-muted fs-6">
                                    ' . $producto['descripcion'] . '
                                </p>
                            </div>
                            <div class="container px-5 py-2">
                                <!-- Botón agregar al carrito -->
                                <a class="add-button px-3 py-2 rounded w-100" href="/U-Tech/config/add-cart.php?prod-id=' . $producto['ID_producto'] . '&cat-id=' . $producto['ID_categoria'] . '">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
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
            $prod_stmt->close();
            $q_img->close();
        ?>                    
    </div>
</section>
    <!-- FIN CONTENIDO -->
    <?php include '../components/footer.php' ?>  <!--HEADER -->