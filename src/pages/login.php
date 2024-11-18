<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo '/U-Tech/src/styles/styles-session.css'; ?>">

    <?php 
        // SI HAY UNA SESIÓN ACTIVA BLOQUEA EL ACCESO
        session_start();
        if (isset($_SESSION['id']) && isset($_SESSION['username'])){
            header("location: /U-Tech/index.php");
        } else{
            //SI NO HAY SESIÓN ACTIVA TRAE EL HEADER
            require_once '../../config/config.php';
            require BASE_PATH . 'src/components/header.php'; //HEADER
        }        
        
        
        if (isset($_SESSION['error'])) {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "'. $_SESSION['error'] . '",
                        });
                    </script>';
            unset($_SESSION['error']); // Elimina el mensaje después de mostrarlo
        }
    ?>
    
    <!-- INICIO SESIONES -->
    <section class="content d-flex mb-lg-5 mb-5 mt-lg-0 mt-5 color3" style="justify-content: center; flex:1;">
        <div class="container-session rounded-5">
            <!-- INICIAR SESIÓN -->
            <div class="container-form">
                <form action="<?php echo '/U-Tech/config/sign-in.php'; ?>" method="post" class="sign-in p-sm-5 p-2">
                    <h4 class="pb-sm-5 pb-2 text-center">SIGN IN</h4>
                    <!-- mail -->
                    <div class="row mb-3">
                        <label for="mail-in" class="col-sm-2 col-form-label"><i class="bi bi-envelope-at fs-3"></i></label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="E-mail" name="mail-in" id="mail-in" class="form-control" required>
                        </div>
                    </div>                        
                    <!-- password -->
                    <div class="row mb-3">
                        <label for="passwd-in" class="col-sm-2 col-form-label"><i class="bi bi-lock fs-3"></i></label>
                        <div class="col-sm-10">
                            <input type="password" placeholder="Password" name="passwd-in" id="passwd-in" class="form-control" required>
                        </div>
                    </div>
                
                    <button class="btn-access fs-5 px-5 py-2 rounded-5" type="submit"> SIGN IN</button>
                </form>
            </div>

            <!-- CREAR CUENTA -->
            <div class="container-form">
                <form action="<?php echo '/U-Tech/config/sign-up.php'; ?>" method="post" class="sign-up p-sm-5 p-2">
                    <h4 class="pb-sm-5 pb-2 text-center">CREATE ACCOUNT</h4>
                    <!-- nombre -->
                    <div class="row mb-2">
                        <label for="name" class="col-sm-2 col-form-label"><i class="bi bi-person fs-3"></i></label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Name" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <!-- mail -->
                    <div class="row mb-2">
                        <label for="mail-up" class="col-sm-2 col-form-label"><i class="bi bi-envelope-at fs-3"></i></label>
                        <div class="col-sm-10">
                            <input type="email" placeholder="E-mail" id="mail-up" name="mail-up" class="form-control" required>
                        </div>
                    </div>
                    <!-- password -->
                    <div class="row mb-2">
                        <label for="passwd-up" class="col-sm-2 col-form-label"><i class="bi bi-lock fs-3"></i></label>
                        <div class="col-sm-10">
                            <input type="password" placeholder="Password [10]" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,k}"  id="passwd-up" name="passwd-up" class="form-control" required>
                        </div>
                    </div>
                    <!-- tarjeta bancaria -->
                    <div class="row mb-2">
                        <label for="c-card" class="col-sm-2 col-form-label"><i class="bi bi-credit-card fs-3"></i></label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Credit Card" id="c-card" name="c-card" class="form-control" required>
                        </div>
                    </div>
                    <!-- fecha nacimiento -->
                    <div class="row mb-2">
                        <label for="bdate" class="col-sm-2 col-form-label"><i class="bi bi-calendar-event fs-3"></i></label>
                        <div class="col-sm-10">
                            <input type="date" id="bdate" name="bdate" class="form-control" required>
                        </div>
                    </div>
                    <!-- dirección postal -->
                    <div class="row mb-2">
                        <label for="address" class="col-sm-2 col-form-label"><i class="bi bi-house fs-3"></i></label>
                        <div class="col-sm-10">
                            <input type="number" min="0" max="99999" step="1" placeholder="Mailing Address" id="address" name="address" class="form-control" required>
                        </div>
                    </div>

                    <button class="btn-access fs-5 px-5 py-2 rounded-5" type="submit"> REGISTER </button>
                </form>
            </div>
            <!-- BOTONES DE CAMBIO DE FORMULARIO -->
            <div class="container-welcome rounded-5">
                <div class="welcome welcome-sign-up p-sm-5 p-2">
                    <h4>Hi new user!</h4>
                    <p>Register your data to be able to use the site.</p>
                    <button class="btn-switch fs-5 px-5 py-2 rounded-5" id="btn-sign-up">SIGN UP</button>
                </div>
                <div class="welcome welcome-sign-in p-sm-5 p-2">
                    <h5>Welcome back!</h5>
                    <p>Log in with your data.</p>
                    <button class="btn-switch fs-5 px-5 py-2 rounded-5" id="btn-sign-in">SIGN IN</button>
                </div>
            </div>
        </div>
        
    </section>
    

    <!-- FIN SESIONES -->

    <script src="<?php echo '/U-Tech/src/scripts/script-sessions.js'; ?>"></script>
     <!-- FIN DEL ABOUT -->
     <?php include '../components/footer.php' ?>  <!--HEADER -->