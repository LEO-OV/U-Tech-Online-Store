<!-- FOOTER -->
    <footer>
        <div class="footer px-5 py-2">
            <!-- SECCIONES DEL FOOTER -->
            <div class="row text-center text-md-start">
                <div class="col-md-3 col-lg-3 co-xl-3  mx-auto pt-5">
                    <h5 class="fs-5 mb-4 color1">OUR PRODUCTS</h5>
                    <hr class="mb-4">
                    <p class="link-footer link fs-5"><a class="color1" href="<?php echo '/U-Tech/src/pages/product.php?cat-id=1' ?>" ><i class="bi bi-phone"></i>&emsp;Phones</a></p>
                    <p class="link-footer link fs-5"><a class="color1" href="<?php echo '/U-Tech/src/pages/product.php?cat-id=2' ?>" ><i class="bi bi-tablet"></i>&emsp;Laptops</a></p>
                    <p class="link-footer link fs-5"><a class="color1" href="<?php echo '/U-Tech/src/pages/product.php?cat-id=3' ?>" ><i class="bi bi-laptop"></i>&emsp;Tablets</a></p>
                    <p class="link-footer link fs-5"><a class="color1" href="<?php echo '/U-Tech/src/pages/product.php?cat-id=4' ?>" ><i class="bi bi-headphones"></i>&emsp;Headphones</a></p>
                </div>
                <div class="col-md-3 col-lg-3 co-xl-3 mx-auto pt-5">
                    <h5 class="fs-5 mb-4 color1">SUPPORT</h5>
                    <hr class="mb-4">
                    <p class="link-footer link fs-5"><a class="color1" href="#" >Contact</a></p>
                    <p class="link-footer link fs-5"><a class="color1" href="#" >Request a repair</a></p>
                    <p class="link-footer link fs-5"><a class="color1" href="#" >Manuals & Software</a></p>
                </div>
                <div class="col-md-3 col-lg-3 co-xl-3  mx-auto pt-5">
                    <h6 class="mb-4 fs-5 color1">LEGAL</h6>
                    <hr class="mb-4">
                    <p class="link-footer link fs-5"><a class="color1" href="#" >Privacy</a></p>
                    <p class="link-footer link fs-5"><a class="color1" href="#" >Privacy Notice</a></p>
                    <p class="link-footer link fs-5"><a class="color1" href="#" >Terms & Conditions</a></p>
                    <p class="link-footer link fs-5"><a class="color1" href="#" >Cookies</a></p>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center">
            <hr class="mb-4">
            <p class="fs-5 color1" style="opacity: 0.6;">Copyright <i class="bi bi-c-circle"></i> 2024 U-Tech. &emsp;All rights reserved</p>
        </div>
    </footer>
    <script src="<?php echo '/U-Tech/src/scripts/btns.js'; ?>"></script>
    <?php 
        if (isset($con)) {
            $con->close();
        } 
        ?>
</body>
</html>