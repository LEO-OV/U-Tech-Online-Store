<?php
    if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Solo inicia la sesión si no está activa
        }
    
    if (!isset($_SESSION['id'])){
        $_SESSION['error'] = 'Please login before adding to the cart.';
        header('location: /U-Tech/src/pages/login.php');
        exit;
    }
    if(!isset($_SESSION['cart'])){
        $_SESSION['error'] = 'Add something to the cart before accessing this page.';
        header('location: /U-Tech/index.php');
        exit;
    } 

    require '../../config/conn.php';

    //Obtenemos los productos del carrito del usuario
    $user_id = $_SESSION['id'];
    $stmt = $con->prepare("SELECT ID_producto, cantidad FROM carrito WHERE ID_usuario = ?"); 
    $stmt->bind_param('i',$user_id);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <style>
        .act-btn{
            border: none;
            background-color: transparent;
            opacity: 0.8;
        }
        .act-btn:hover{
            opacity: 1;
            transform: scale(1.1);
        }
    </style>
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
    <section class="container-lg mb-5 mt-lg-0 mt-5" style="justify-content: center; overflow-x:auto; width: 100%;">
        <div class="container">
        <?php 
            // Iteramos sobre cada producto
            while ($product = $result->fetch_assoc()) {
                    $id = $product['ID_producto'];
                    $cant = $product['cantidad']; 

                    // Extraemos los datos de cada producto
                    $query = $con->prepare("SELECT ID_img, nombre, descripcion, precio FROM productos WHERE ID_producto = ?");
                    $query->bind_param('i',$id);
                    $query->execute();
                    $data = $query->get_result()->fetch_assoc();

                    // Obtenemos la imagen del producto
                    $id_img = $data['ID_img'];
                    $qimg = "SELECT foto FROM imagenes WHERE ID_img = $id_img"; 
                    $img_res = mysqli_query($con, $qimg);
                    $img_src = mysqli_fetch_array($img_res);
                                

                    echo '<div class="card">' .
                            '<div class="row g-0 align-items-center">' .
                                // Columna para la imagen
                                '<div class="col-sm-4">' .
                                    '<img src="' . $img_src['foto'] . '" class="img-fluid rounded-start" alt="Product Image">' .
                                '</div>' .
                                // Columna para la información del producto
                                '<div class="col-sm-8">' .
                                    '<div class="card-body px-5">' .
                                    // Título del producto
                                        '<h6 class="card-title color2 fw-bold">' . $data['nombre'] . '</h6>' .

                                        '<ul class="list-unstyled">'.
                                            // Precio del producto
                                            '<li class="mb-2 color3 fs-5">$ ' . $data['precio'] . '</li>'.
                                            // Descripción del producto
                                            '<li class="mb-2 text-secondary">' . $data['descripcion']  . '</li>'.
                                        '</ul>'.
                                        // Cantidad
                                        '<form action="/U-Tech/config/edit-cart.php" method="post">'.
                                        '<input type="hidden" name="id" value="' . $id . '">'.
                                        '<input type="hidden" name="quantity" value="' . $cant . '">'.
                                        '<div class="row">'.
                                            '<div class="col"><button class="act-btn color3" name="del"><i class="bi bi-trash"></i></button></div>'. //Trash
                                            '<div class="col"><button class="act-btn color3" name="subtraction"><i class="bi bi-dash"></i></button></div>'. //Subtraction
                                            '<div class="col">' . $cant . '</div>'.
                                            '<div class="col"><button class="act-btn color3" name="addition"><i class="bi bi-plus"></i></button></div>'. //Addition
                                        '</div>'.
                                        '</form>'.
                                    '</div>' .
                                '</div>' .
                            '</div>' .
                        '</div>';
            } 
            $con->close(); 
            ?>
            
        </div>
     </section>
    <!-- FIN CONTENIDO -->
    <?php include '../components/footer.php' ?>  <!--FOOTER -->