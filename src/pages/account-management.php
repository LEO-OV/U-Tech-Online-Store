<?php
    if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Solo inicia la sesión si no está activa
        }
    require '../../config/conn.php';

    if (isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $query = "SELECT * from usuarios WHERE ID_usuario = $id";
        $res = mysqli_query($con,$query);

        if  ( $res->num_rows > 0 ){
            $userD = mysqli_fetch_array($res);
        } else{
            $con->close();
            header('location: /U-Tech/config/out.php');
        }

    } else{
        $_SESSION['error'] = 'You need to be logged in to access this page';
        $con->close();
        header('location: /U-Tech/src/pages/login.php');
    } 
    
    $con->close();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Account </title>
    <style>
        .btn-acc{
            background-color: #522c5d;
            color: white;
            border: none;
            opacity: 0.7;
            width: auto;
        }
        .btn-acc:hover{
            opacity: 1;
            transform: scale(1.05);
        }
    </style>
    <?php 
        require_once '../../config/config.php';
        require BASE_PATH . 'src/components/header.php'; //HEADER

        // ALERTAS
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
    <section class="container content my-5 mt-lg-0  mx-5 p-sm-5 p-3">
        <div class="p-5 rounded-5 shadow" style="background-color: #212529;">
            <div class="container ">
                <h3 class="text-center color1">Manage Account</h3>
            </div>
            <!-- FORMULARIO PARA CAMBIAR DATOS -->
            <form class="row g-3 text-white" action="<?php echo'/U-Tech/config/updt-user.php' ?>" method="post">
                <div class="col-md-2">
                    <label for="id" class="form-label"><i class="bi bi-moon-fill"></i>&emsp;ID</label>
                    <input type="text" name="id" class="form-control-plaintext color1" id="id" value="<?php echo $userD['ID_usuario']; ?>" readonly>
                </div>
                <!-- NOMBRE -->
                <div class="col-md-10">
                    <label for="name" class="form-label"><i class="bi bi-person"></i>&emsp;Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $userD['nombre'] ?>" required>
                </div>
                <!-- FECHA NACIMIENTO -->
                <div class="col-md-4">
                    <label for="bdate" class="form-label"><i class="bi bi-calendar-event"></i>&emsp;Birthdate</label>
                    <input type="date" name="bdate" class="form-control" id="bdate" value="<?php echo $userD['f_nacimiento'] ?>" required>
                </div>
                <!-- TARJETA -->
                <div class="col-md-4">
                    <label for="card" class="form-label"><i class="bi bi-credit-card-fill"></i>&emsp;Credit Card</label>
                    <input type="text" name="c-card" class="form-control" id="card" value="<?php echo $userD['tarjeta'] ?>" required>
                </div>
                <!-- POSTAL -->
                <div class="col-md-4">
                    <label for="address" class="form-label"><i class="bi bi-house"></i>&emsp;Mailing Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="<?php echo $userD['postal'] ?>" required>
                </div>
                <!-- CORREO -->
                <div class="col-md-6">
                    <label for="mail" class="form-label"><i class="bi bi-envelope"></i>&emsp;E-mail</label>
                    <input type="email" name="mail" class="form-control" id="mail" value="<?php echo $userD['correo'] ?>" required>
                </div>
                <!-- CONTRASEÑA -->
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="bi bi-lock"></i>&emsp;Password</label>
                    <input type="password" name="passwd" class="form-control" id="password" pattern=".{10,10}" value="">
                    <div class="form-text color1">
                    <i class="bi bi-info-circle-fill"></i> If you want to change your password, fill in this field; otherwise, leave the field empty. Please note that you will not be able to recover your old password.
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn-acc px-5 py-2 rounded-5">Sign in</button>
                </div>
            </form>
        </div>
    </section>
    <!-- FIN CONTENIDO -->
    <?php include '../components/footer.php' ?>  <!--HEADER -->