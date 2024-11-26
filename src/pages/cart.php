<?php
    if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Solo inicia la sesión si no está activa
        }
    
    if (!isset($_SESSION['id'])){
        $_SESSION['error'] = 'Please login before adding to the cart.';
        header('location: /U-Tech/src/pages/login.php');
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
        .e-cart{
            color: #2e2e2e;
            opacity: 0.6;
            transition: 0.5s ease;
            font-size: 14px;
            background-color: transparent;
            border: none;
        }
        .e-cart:hover{
            transform: translateX(5%);
            opacity:0.8;
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
        }
        
        else if (isset($_SESSION['success'])){
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
        
        else if (isset($_SESSION['purchase'])){
            echo '
                <script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Payment proccessed.",
                        showConfirmButton: true,
                        timer: 1500
                    }).then(()=>{
                        Swal.fire({
                        title: "'. $_SESSION['purchase'] .'",
                        width: 600,
                        padding: "3em",
                        color: "#716add",
                        background: "#fff",
                        backdrop: `
                            rgba(0,0,123,0.4)
                            url("/U-Tech/public/img/dog.gif")
                            left top
                            no-repeat`
                        });
                    });
                </script>';
                unset($_SESSION['purchase']);
        }
    ?>
    <script>
        function pay(){
            Swal.fire({
                title: "Do you want to proceed with the payment?",
                showCancelButton: true,
                icon: "question",
                confirmButtonText: "Confirm",
                }).then((result) => {
                if (result.isConfirmed) {
                    let timerInterval;
                    Swal.fire({
                    title: "Proccessing your payment.",
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location = '/U-Tech/config/pay.php';
                    }
                }); 
                } 
            });
        }

        function empty(){
            Swal.fire({
                title: "Do you want to empty your cart?",
                showCancelButton: true,
                confirmButtonText: "Yes",
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href =  '/U-Tech/config/empty-cart.php?action=empty&user_id=<?php echo $_SESSION["id"]; ?>';
                } 
            });
        }
    </script>
    <!-- INICIO CONTENIDO -->
    <section class="container-lg mb-5 mt-lg-0 mt-5" style="justify-content: center; overflow-x:auto; width: 100%;">
        <div class="container text-center mb-4">
            <h2 class="mb-4 color3">CART</h2>
        </div>
    <?php 
         if(!isset($_SESSION['cart'])){
            echo '<h2 class="text-center color2"> Your shopping cart is empty&emsp;<i class="bi bi-emoji-frown"></i></h2>';
        } else {
            echo '<div class="row">
                <div class="col-sm-8 pe-sm-5">';
                    $total = 0;
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

                            echo '<div class="card mb-3 bg-sand">' .
                                    '<div class="row g-0 align-items-center">' .
                                        // Columna para la imagen
                                        '<div class="col-sm-4">' .
                                            '<img src="' . $img_src['foto'] . '" class="img-fluid rounded-start img-hover" alt="Product Image">' .
                                        '</div>' .
                                        // Columna para la información del producto
                                        '<div class="col-sm-8">' .
                                            '<div class="card-body px-5">' .
                                            // Título del producto
                                                '<h6 class="card-title color2 fw-bold">' . $data['nombre'] . '</h6>' .

                                                '<ul class="list-unstyled">'.
                                                    // Precio del producto
                                                    '<li class="mb-2 color3 fs-5">$ ' . number_format($data['precio'],2) . '</li>'.
                                                    // Descripción del producto
                                                    '<li class="mb-2 text-secondary">' . $data['descripcion']  . '</li>'.
                                                '</ul>'.
                                                // Cantidad
                                                '<form action="/U-Tech/config/edit-cart.php" method="post">'.
                                                '<input type="hidden" name="id" value="' . $id . '">'.
                                                '<input type="hidden" name="quantity" value="' . $cant . '">'.
                                                '<div class="row">'.   
                                                // ACCIONES DE EDIT CART          
                                                    '<div class="col"><button class="act-btn color3" name="trash"><i class="bi bi-trash"></i></button></div>'. //Trash
                                                    '<div class="col"><button class="act-btn color3" name="subtraction"><i class="bi bi-dash"></i></button></div>'. //Subtraction
                                                    '<div class="col">' . $cant . '</div>'.
                                                    '<div class="col"><button class="act-btn color3" name="addition"><i class="bi bi-plus"></i></button></div>'. //Addition
                                                '</div>'.
                                                '</form>'.
                                            '</div>' .
                                        '</div>' .
                                    '</div>' .
                                '</div>';
                    $total += $data['precio']*$cant;
                    }  
                echo "</div>
                        <div class='col-sm-4 ps-sm-5'>
                            <div class='card payment'>
                                <div class='card-body bg-sand text-center'>
                                    <h6 class='card-title color2 fw-bold'>Purchase Summary</h6>
                                    <p class='text-secondary fs-5'>". $num_prod . " product";
                                    echo ($num_prod>1)?'s':'';  
                                    echo "</p> <p class='color3 fs-4'>Total: $ " . number_format($total,2) ."</p>
                                    <button onclick='empty()' class='e-cart'><i class='bi bi-cart-x'></i>&emsp;Empty Cart</button><br>
                                    <button onclick='pay()' class='btn-purple px-5 py-1 rounded mt-3'><i class='bi bi-currency-exchange'></i>&emsp;PAY</button>
                                </div>
                            </div>
                        </div>
                    </div>";
                }?>
     </section>
    <!-- FIN CONTENIDO -->
    <?php 


        include '../components/footer.php' 
    ?>  <!--FOOTER -->