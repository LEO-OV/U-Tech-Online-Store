<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="<?php echo '/U-Tech/src/styles/styles.css'; ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function logout(){
        Swal.fire({
            title: "Do you wanto to logout?",
            showDenyButton: true,
            denyButtonText: `Cancel`,
            confirmButtonText: 'Continue'
            
        }).then((result) => {
        // Si se confirma, se cierra la sesión con el archivo logout.php
            if (result.isConfirmed) {
                Swal.fire("Session closed!", "", "success");
                window.location = '/U-Tech/config/out.php';
            }               
        });
    }
</script>

</head>
<body>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Solo inicia la sesión si no está activa
        }
        $admin = false;
        $user = '';
        // Si existe la sesión 'id' y 'username', asigna el nombre de usuario
        if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['perm'])){
            if($_SESSION['perm'] == 1){
                $admin = true;
            }
            $user = $_SESSION['username'];
            $user_display = strlen($user) > 15 ? substr($user, 0, 15) . '...' : $user;
        }
    ?>
    <!-- MENU -->
    <nav class="navbar relative-top navbar-dark navbar-expand-lg mb-lg-5 px-lg-2 py-0">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center justify-content-start pe-lg-2">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu" >
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <!-- MENU LOGO -->
                <a href="<?php echo '/U-Tech/index.php'; ?>">
                    <span class="bi bi-moon-fill fs-1 link"></span>
                </a>
            </div>
            <!-- OFFCANVAS CONTENEDOR PRINCIPAL -->
            <section class="offcanvas offcanvas-start " id="menu" tabindex="-1 " style="background-color: #845162;">
                <!-- OFFCANVAS HEADER -->
                <div class="offcanvas-header justify-content-evenly" >
                    <h1>U Te<span class="bi bi-moon-fill"></span>h</h1>
                    <button class="btn-close btn-close-white ms-2" type="button" aria-label="Close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column justify-content-between" >
                <ul class="navbar-nav fs-5 justify-content-start ">
                    <!-- ENLACES SESIÓN -->
                        <?php 
                            // SI EXISTE LA SESIÓN
                            if ($user != ''){
                                echo ' 
                                    <li class="nav-item dropdown px-3 ">
                                    <a href="#" class="nav-link link" role="button" data-bs-toggle="dropdown" > <i class="bi bi-person-circle fs-1"></i></a>
                                    <ul class="dropdown-menu p-3" style="background-color: #845162; border: none;">
                                        <li class="text-white">' .  $user_display  . '</li>
                                        <li><hr class="dropdown-divider text-white"></li>
                                        <li><a href="/U-Tech/src/pages/account-management.php"class="dropdowm-item link"><i class="bi bi-gear"></i>&emsp;Account</a></li>
                                        <li><a onclick="logout()" class="dropdowm-item link"><i class="bi bi-power fs-5"></i>&emsp;Log Out</a></li>
                                    </ul>';
                            } 
                            // SI NO HAY SESIÓN
                            else{
                                echo '<li class="nav-item px-3"><a href="/U-Tech/src/pages/login.php" class="nav-link"><i class="bi bi-person-circle fs-1"></i></a></li>';
                            } ?>
                    </li>
                    <!-- ADMIN -->
                    <?php
                        if($admin){
                            echo '<li class="nav-item p-3 py-md-3"><a href="/U-Tech/src/admin/admin.php" class="nav-link link"><i class="bi bi-person-fill-gear"></i> ADMIN</a></li>';
                        } 
                    ?>
                    <!-- ENLACES A SECCIONES DE LA PÁGINA -->
                    <li class="nav-item dropdown p-3 py-md-3">
                        <a href="#" class="nav-link link dropdown-toggle" role="button" data-bs-toggle="dropdown">PRODUCTS</a>
                        <!-- MENU DESPLEGABLE -->
                        <ul class="dropdown-menu" style="background-color: #845162; border: none;">
                            <li><a href="" class="dropdown-item link"><i class="bi bi-phone"></i>&emsp;Phones</a></li>
                            <li><a href="" class="dropdown-item link"><i class="bi bi-tablet"></i>&emsp;Laptops</a></li>
                            <li><a href="" class="dropdown-item link"><i class="bi bi-laptop"></i>&emsp;Tablets</a></li>
                            <li><a href="" class="dropdown-item link"><i class="bi bi-headphones"></i>&emsp;Headphones</a></li>
                        </ul>
                    </li>    
                    <!-- CARRITO -->
                    <li class="nav-item p-3 py-md-3 "><a href="" class="nav-link link">MENU 2</a></li> 
                    <!-- ABOUT US -->
                    <li class="nav-item p-3 py-md-3 "><a href="<?php echo '/U-Tech/src/pages/about-us.php'; ?>" class="nav-link link">ABOUT US</a></li>
                </ul>
                    <!-- ICONOS DE REDES SOCIALES -->
                    <div class="d-lg-none text-center">
                        <a href="" class="icon-link link p-4 fs-1"><i class="bi bi-twitter-x" style="color: white"></i></a>
                        <a href="" class="icon-link link p-4 fs-1"><i class="bi bi-facebook" style="color: white"></i></a>
                        <a href="https://github.com/LEO-OV" class="icon-link link p-4 fs-1"><i class="bi bi-github" style="color: white"></i></a>
                    </div>    
                </div>
            </section>

            <!-- ICONO CARRITO  -->
            <ul class="nav justify-content-end align-items-center">  
                <li class="nav-item">
                    <a href="" class="nav-link link"><i class="bi bi-cart fs-1"></i></a> 
                </li> 
            </ul>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>