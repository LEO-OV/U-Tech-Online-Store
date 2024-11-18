<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Tech</title>
    <style>
        @media (max-width: 767px) {
            .container-about{
                height: 400px;
            }
        }
        .about{
            display: flex;
            flex-direction: column;
            margin-top: auto;
            margin-bottom: auto;
        }
    </style>
    
    <?php 
        require_once '../../config/config.php';
        require BASE_PATH . 'src/components/header.php'; //HEADER
        
    ?>


    <!-- ABOUT -->
    <section class="content about px-lg-0 px-5 my-5">
        <div class="container-fluid mb-4 py-5 text-center rounded-5 shadow"  style="background-color: #522c5d;">
            <h2 class="text-white">ABOUT US</h2>
        </div>
        <!-- ABOUT DESCRIPCIÓN -->
        <div class="row align-items-stretch color5 py-5 px-2 rounded-5 shadow">
            <div class="col-md-8 d-flex flex-column pe-md-5 justify-content-center" style="text-align: justify;">
                <p class="color5">At U Tech, we are passionate about merging the latest technology with seamless user experiences. Founded with the goal of revolutionizing the way people interact with their devices, we specialize in cutting-edge products that include smartphones, laptops, tablets, and headphones. Our commitment to innovation and excellence is what sets us apart in the industry.</p>
                <p class="color5">Our team is driven by a shared vision: to create technology that enhances everyday life while staying at the forefront of advancements in artificial intelligence and digital solutions. We believe in delivering products that not only meet but exceed user expectations by combining power, reliability, and elegant design.</p>
                <p class="color5">With a customer-centric approach, we aim to build an ecosystem where all our products are interconnected, intuitive, and secure. At U Tech, your satisfaction and trust are paramount. We continuously strive to ensure that our products are both high-quality and forward-thinking, tailored to your unique needs and preferences.</p>
            </div>
            <div class="col-md-4 container-about  mb-md-0">
                <div class="container-img h-100">
                    <img src="../../public/img/aboutUs-img.png" class="fit-img rounded-5" alt="Img About U Tech">
                </div>
            </div>
        </div>
        <!-- EQUIPO -->
        <div class="container-fluid my-5 p-5 px-lg-5 text-center rounded-5 shadow" style="background-color: #FFE3D8;  color: #845162;">
            <div class="row pt-5">
                <h2 class="color3">OUR TEAM</h2>
            </div>
            <div class="row">
                <!-- INGENIERO -->
                <div class="col-lg-4 rounded-5 px-4">
                    <img src="../../public/img/ing.png" alt="" class="img-fluid rounded-circle" width="300" height="300">
                    <h4 class="py-3">ING. BOB</h4>
                    <p class="text-justify">U Tech's Principal Engineer and Developer is an expert in advanced technology and interconnected product design. His focus on reliability and efficiency drives the creation of innovative devices that transform the user experience, ensuring that each product meets the highest standards of quality and functionality.</p>
                </div>
                <!-- CEO -->
                <div class="col-lg-4 rounded-5 px-4">
                    <img src="../../public/img/ceo.png" alt="" class="img-fluid rounded-circle" width="300" height="300">
                    <h4 class="py-3">CEO</h4>
                    <p class="text-justify">U Tech's CEO is a visionary technology leader focused on innovation and excellence. Under her leadership, the company creates an intuitive and secure digital ecosystem that connects people to the future through advanced, user-centric products.</p>
                </div>
                <!-- IA -->
                <div class="col-lg-4 rounded-5 px-4">
                    <img src="../../public/img/ia.png" alt="" class="img-fluid rounded-circle" width="300" height="300">
                    <h4 class="py-3">AI</h4>
                    <p class="text-justify">U Tech's artificial intelligence is an advanced assistant designed to solve problems quickly and efficiently. With real-time learning and analytics capabilities, this AI delivers customized solutions, optimizes device performance and enhances the user experience, ensuring that every interaction is seamless, intuitive and secure.</p>
                </div>
            </div>
        </div>
    </section>

    
    <!-- FIN DEL ABOUT -->
    <?php include '../components/footer.php' ?>  <!--HEADER -->