<?php 
    require_once '../../../config/config.php';
    session_start();
    require BASE_PATH . 'src/admin/admin-header.php';  
    
    if (isset($_SESSION['error'])) {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "'. $_SESSION['error'] . '",
                    });
                </script>';
        unset($_SESSION['error']); // Elimina el mensaje después de mostrarlo
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
        <!-- CONTENIDO DEL INDEX -->
            <div class="container-md text-center my-5">
                <h1 class="fs-1 text-white">ADD USER</h1>
            </div>
            <div class="container-md d-flex px-lg-5" style="justify-content: center;">
                <form action="<?php echo '/U-Tech/src/admin/config/a-user.php' ?>" class="form text-white p-5 rounded-5" method="post">
                    <!-- NOMBRE -->
                    <div class="input-group mb-3">
                        <input type="text" name="name" placeholder="Name" class="form-control" required>
                    </div>
                    <!-- CONTRASEÑA -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Password [10]</span>
                        <input type="password" name="passwd" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,k}" required>
                    </div>
                    <!-- CORREO -->
                    <div class=" mb-3">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" required placeholder="E-mail">
                        </div>
                    </div>
                    <!-- NACIMIENTO -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Birthdate</span>
                        <input type="date" name="bdate" class="form-control" placeholder="Price" required>  
                    </div>
                    <!-- TARJETA -->
                    <div class="input-group mb-3">
                        <input type="text" name="c-card"class="form-control" placeholder="Credit card" required>
                    </div>
                    <!-- POSTAL -->
                    <div class="input-group mb-3">
                        <input type="number" min="0" step="1" max="99999" name="add" class="form-control" placeholder="Mailing Address" required>
                        <span class="input-group-text">00000</span>
                    </div>
                    <!-- PERMISOS -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Permissions</span>
                        <input type="number" min="0" step="1" max="1" name="perm" class="form-control" required>
                    </div>
                    <div class="container text-center">
                        <button type="submit" class="btn btn-form px-5 rounded-5">SAVE</button>
                    </div>
                </form>
            </div>
        </section>
    </section>
</body>
</html>