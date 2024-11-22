<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Solo inicia la sesión si no está activa
    }
    if (isset($_SESSION['perm'])){
        if($_SESSION['perm'] != 1){
            $_SESSION['notadmin'] = 'Sorry... you can not access this page.';
            header('location: /U-Tech/index.php');
        }
    } else{
        $_SESSION['notadmin'] = 'You need to be logged in as an admin to access this page';
        header('location: /U-Tech/index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo '/U-Tech/src/admin/admin-style.css'; ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>ADMIN [U-Tech]</title>
</head>
<body class="">
    <section class="page-container">
        <!-- NAVBAR -->
        <section class="navbar navbar-expand-md bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a href="<?php echo '/U-Tech/src/admin/admin.php'; ?>" class="navbar-brand"><i class="bi bi-moon-fill"></i></a>
                <button class="navbar-toggler" style="border: none;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <!-- FUNCIONALIDADES -->
                        <li class="nav-item dropdown px-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-gear"></i>&emsp;ADMIN
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo '/U-Tech/index.php'; ?>"><i class="bi bi-shop-window"></i>&emsp;U-Tech Store</a></li>
                                <li><a class="dropdown-item" href="<?php echo '/U-Tech/config/out.php'; ?>"><i class="bi bi-power"></i>&emsp;Sign out</a></li>
                            </ul>
                        </li>
                        <!-- PRODUCTOS -->
                        <li class="nav-item dropdown px-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-basket-fill"></i>&emsp;Products
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo '/U-Tech/src/admin/pages/add-prod.php'; ?>"><i class="bi bi-plus-circle"></i>&emsp;Add product</a></li>
                                <li><a class="dropdown-item" href="<?php echo '/U-Tech/src/admin/pages/updt-prod.php'; ?>"><i class="bi bi-arrow-clockwise"></i>&emsp;Update product</a></li>
                            </ul>
                        </li>
                        <!-- USUARIOS -->
                        <li class="nav-item dropdown px-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-lines-fill"></i>&emsp;Users
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo '/U-Tech/src/admin/pages/add-user.php'; ?>"><i class="bi bi-plus-circle"></i>&emsp;Add user</a></li>
                                <li><a class="dropdown-item" href="<?php echo '/U-Tech/src/admin/pages/updt-user.php'; ?>"><i class="bi bi-arrow-clockwise"></i>&emsp;Update user</a></li>
                            </ul>
                        </li>
                        <!-- HISTORIAL DE COMPRAS -->
                        <li class="nav-item px-3">
                            <a class="nav-link " aria-current="page" href="<?php echo '/U-Tech/src/admin/pages/history.php'; ?>"><i class="bi bi-clock-history"></i>&emsp;Purchase history</a>
                        </li>
                    </ul>
            </div>
        </section>
        <section class="content p-lg-5 py-5">
        <?php 
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