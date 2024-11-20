<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Tech</title>
    <link rel="stylesheet" href="src/styles/styles-index.css">
    <?php 
        require_once 'config/config.php';
        require 'src/components/header.php';  //HEADER 
        
        if (isset($_SESSION['success'])){
            if ($_SESSION['perm'] == 1){
                echo '
                <script>
                    Swal.fire({
                    title: "Welcome admin!",
                    text: "'.$_SESSION['username'].'",
                    imageUrl: "/U-Tech/public/img/admin.png",
                    imageHeight: 200,
                    imageAlt: "Boss image"
                    });
                </script>';
            } else{
                echo '
                <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "' . $_SESSION['success'] . ' ",
                        showConfirmButton: false,
                        timer: 2500
                    });
                </script>';
            }
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['notadmin'])){
            echo '
                <script>
                    Swal.fire({
                    title: "Admin permissions needed to access this page.",
                    text: "'.$_SESSION['notadmin'].'",
                    imageUrl: "/U-Tech/public/img/notadmin.png",
                    imageHeight: 200,
                    imageAlt: "Crying image"
                    });
                </script>';
            unset($_SESSION['success']);
        }
    ?>  

        <!-- CARRUSEL -->
        <section class="carousel-index text-center">
            <div class="carousel slide" id="carousel-index" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carousel-index" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carousel-index" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carousel-index" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carousel-index" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000" style="background-image: url(public/img/carrusel-1.png);">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000" style="background-image: url(public/img/carrusel-2.png);">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000" style="background-image: url(public/img/carrusel-3.png);">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000" style="background-image: url(public/img/carrusel-4.png);">
                    </div>
                </div>
                <div class="text-overlay text-white">
                    <h1 class="fw-bold">U Te<i class="bi bi-moon-fill" style="color: #E3B6B1;"></i>h</h1>
                    <br>
                    <h6 class="color1"><i class="bi bi-moon-fill"></i>onnecting U to the future.</h6>
                </div>
            </div>
        </section>
        

    <!-- CONTENIDO DEL INDEX -->
    <section class="container-fluid content">

        <!-- CARACTERISTICAS DESTACADAS -->
        <section class="container-fluid content-index my-5 px-lg-0 px-4 text-center color2">
            <div class="row my-5 p-5">
                <h2 class="fw-bold color3">WHY U TECH?</h2>
            </div>
            <!-- CARACTERISTICA 1 -->
            <div class="row i-card rounded-5 mb-5 mx-auto">
                <div class="col-md-7 ver-align px-5 py-4 text-lg-start text-center">
                    <h4 class="color3">AI that Learns from U</h4>
                    <p>Our AI technology adapts to your preferences and usage patterns, optimizing performance and anticipating your needs to make every interaction more efficient and personalized.</p>
                </div>
                <div class="col-md-5 ver-align">
                    <img src="public/img/car1.png" alt="AI that learns from you." class="img-fluid">
                </div>
            </div>

            <!-- CARACTERISTICA 2 Y 3 -->
            <div class="row mx-auto">
                <div class="col-md i-card rounded-5 me-md-4  my-5 px-5 py-4 mx-auto">
                    <div class="row">
                        <h4 class="color3">Next Generation Security</h4>
                        <p>Protecting your data is our priority. We implement advanced security systems, including facial recognition and AI-encrypted fingerprints for accuracy and speed.</p>
                    </div>
                    <div class="row">
                        <img src="public/img/car4.png" alt="Next generation security." class="img-fluid">
                    </div>
                </div>
                <div class="col-md i-card rounded-5 ms-md-4 my-5 px-5 py-4 mx-auto">
                    <div class="row">
                        <h4 class="color3">Immersive Experience</h4>
                        <p>Experience audiovisual excellence with our high-resolution displays and artificial intelligence-optimized surround sound systems for an unparalleled entertainment experience.</p>
                    </div>
                    <div class="row">
                        <img src="public/img/car5.png" alt="Immersive experience." class="img-fluid">
                    </div>
                </div>
            </div>
            
            <!-- CARACTERISTICA 4 -->
            <div class="row i-card rounded-5 mb-5 mx-auto">
                <div class="col-md-4 ver-align">
                    <img src="public/img/car2.png" alt="Innovation at the highest level." class="img-fluid">
                </div>
                <div class="col-md-8 ver-align px-5 py-4">
                    <h4 class="color3">Innovation at the Highest Level</h4>
                    <p>Our products are designed with state-of-the-art technology, integrating the latest innovations in artificial intelligence and advanced hardware to deliver a superior experience in every use.</p>
                </div>
            </div>

            <!-- CARACTERISTICA 5 -->
            <div class="row i-card rounded-5 mb-5 mx-auto"> 
                <div class="col-md-5 ver-align">
                    <img src="public/img/car3.png" alt="Unbeatable performance." class="img-fluid">
                </div>
                <div class="col-md-7 ver-align px-5 py-4 text-lg-end text-center">
                    <h4>Unbeatable Performance</h4>
                    <p>Equipped with high-end processors and an optimized architecture, our devices guarantee smooth performance even in the most demanding tasks, without interruptions or delays.</p>

                </div>
            </div>
        </section>

        <!-- PREGUNTAS FRECUENTES -->
        <section class="container-fluid content-index mb-5">
            <div class="row">
                <div class="col-lg-4  ver-align">
                    <div class="container text-center p-3 rounded-5" style="background-color: #522c5d;">
                        <h4 class="fw-bold text-white">Frequently Asked Questions</h4>
                    </div>
                </div>
                <div class="col-lg-8 ver-align">
                    <div class="accordion accordion-flush" id="FAQ">
                        <!-- PREGUNTA 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#Q1" aria-expanded="false" aria-controls="Q1"> 
                                    What are the advantages of artificial intelligence in your products?
                                </button>
                            </h2>
                            <div id="Q1" class="accordion-collapse collapse" data-bs-parent="#FAQ">
                                <div class="accordion-body">
                                    <p class="fs-5">Our AI is designed to learn from your habits and optimize your experience, whether it's battery usage, task processing, or the security of your data. This means our devices become faster and more efficient over time, adapting to the way you work and play.</p>
                                </div>
                            </div>
                        </div>
                        <!-- PREGUNTA 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#Q2" aria-expanded="false" aria-controls="Q1"> 
                                    What kind of technical support do you offer?
                                </button>
                            </h2>
                            <div id="Q2" class="accordion-collapse collapse" data-bs-parent="#FAQ">
                                <div class="accordion-body">
                                    <p class="fs-5">We offer 24/7 technical support through online chat, email and telephone assistance. In addition, we have a network of authorized service centers and a team of experts ready to help you with any problem you may have.</p>
                                </div>
                            </div>
                        </div>
                        <!-- PREGUNTA 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#Q3" aria-expanded="false" aria-controls="Q1"> 
                                    Can I use the products with other devices of different brands?
                                </button>
                            </h2>
                            <div id="Q3" class="accordion-collapse collapse" data-bs-parent="#FAQ">
                                <div class="accordion-body">
                                    <p class="fs-5">Yes, our products are designed to be highly compatible with other brands' devices, although we recommend taking advantage of our integrated ecosystem to enjoy the best possible experience.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

<!-- FIN DEL INDEX -->
<?php include 'src/components/footer.php'; ?>  <!--HEADER -->