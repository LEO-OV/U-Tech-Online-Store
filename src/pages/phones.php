<?php
    
    session_start(); // Solo inicia la sesión si no está activa

    
    if(!isset($_SESSION['id'])){
        $_SESSION['error'] = 'You need to be logged in to access this page';
        header('location: /U-Tech/src/pages/login.php');
    }


    if(isset($_SESSION['id'])){
        require '../../config/conn.php';
        $_SESSION['success'] = 'There was a problem, try again.';
        header('location: /U-Tech/index.php');
       
    } else{
        $_SESSION['error'] = 'There was a problem, try again.';
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
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
    <section class="container-fluid content my-5 text-center py-5">
    <div class="container">
        <h2 class="mb-4 color3">PHONES</h2>
    </div>

    <div class="container cat">
        <div class="row g-4 justify-content-center">
            <!-- Tarjeta 3 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card prod p-3 shadow rounded-5" style=" border: none">
                    <img src="<?php echo '/U-Tech/public/img/products/19.png'; ?>" class="img-fluid rounded-5 mb-3" alt="Producto">
                    <div class="card-body rounded-5" style="background-color: white;">
                        <h3 class="card-title text-white rounded-5" style="background-color: #522c5d; ">Producto</h3>
                        <p class="card-text color5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, dicta iure. Repellendus at ex, illum velit corrupti, voluptatum similique eligendi nesciunt iste perspiciatis consequuntur, quos impedit sapiente provident alias deserunt.</p>
                        <a class="add-button px-5 py-2 my-5 rounded-5 link" href=""><i class="bi bi-cart-plus"></i>&emsp;ADD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- FIN CONTENIDO -->
    <?php include '../components/footer.php' ?>  <!--HEADER -->