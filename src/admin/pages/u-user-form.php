<?php
    require '../config/a-conn.php';
    session_start();
    if (isset($_GET['id-user'])){
        $id = intval($_GET['id-user']);
        $query = "SELECT * from usuarios WHERE ID_usuario = $id";
        $res = mysqli_query($con,$query);

        if  ( $res->num_rows > 0 ){
            $user = mysqli_fetch_array($res);
        } else{
            $_SESSION['error'] = 'User not found.';
            $con->close();
            header('location: /U-Tech/src/admin/pages/updt-user.php');
        }
    } else{
        $_SESSION['error'] = 'There was a problem.';
        $con->close();
        header('location: /U-Tech/src/admin/pages/updt-user.php');
    } 
    $con->close();
    require_once '../../../config/config.php';
    require BASE_PATH . 'src/admin/admin-header.php'; 
?>
            <!-- CONTENIDO DEL INDEX -->
           <div class="container-md text-center my-5">
                <h1 class="fs-1 text-white">UPDATE USER</h1><br>
                <p class="text-white"><?php echo $user['nombre'] ?></p>
            </div>
            <div class="container-md d-flex px-lg-5" style="justify-content: center;">
                <form action="<?php echo '/U-Tech/src/admin/config/u-user.php' ?>" class="form text-white p-5 rounded-5" method="post">
                    <!-- ID -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">ID [readonly]</span>
                        <input type="text" name="id" value="<?php echo $user['ID_usuario']; ?>" class="form-control" readonly>
                    </div>    
                    <!-- NOMBRE -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" name="name" value="<?php echo $user['nombre']; ?>" class="form-control" required>
                    </div>
                    <!-- CONTRASEÑA -->
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">Password [10]</span>
                            <input type="password" name="passwd" class="form-control" value="" pattern=".{10,10}">
                        </div>
                        <div class="form-text text-white text-center"><i class="bi bi-exclamation-triangle"></i>&emsp;CAUTION! The password will be kept until you fill the field.</div>
                    </div>
                    <!-- CORREO -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Mail [readonly]</span>
                        <input type="email" name="email" value="<?php echo $user['correo']; ?>" class="form-control">
                    </div>
                    <!-- NACIMIENTO -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Birthdate</span>
                        <input type="date" name="bdate" class="form-control" value="<?php echo $user['f_nacimiento']; ?>"  required>  
                    </div>
                    <!-- TARJETA -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Credit card</span>
                        <input type="text" name="c-card"class="form-control" value="<?php echo $user['tarjeta'];?>" required>
                    </div>
                    <!-- POSTAL -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Mailig address</span>
                        <input type="number" min="0" step="1" max="99999" name="add" class="form-control" value="<?php echo $user['postal']; ?>" required>
                    </div>
                    <!-- PERMISOS -->
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">Permissions</span>
                            <input type="number" min="0" step="1" max="1" value="<?php echo $user['permisos']; ?>"; name="perm" class="form-control" required>
                        </div>
                        <div class="form-text text-white text-center"><i class="bi bi-info-circle"></i>&emsp;[0 - User]&emsp;[1 - Admin]</div>
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