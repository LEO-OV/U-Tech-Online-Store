<?php
    require '../config/a-conn.php';
    session_start();
    if (isset($_GET['id-prod'])){
        $id = intval($_GET['id-prod']);
        $query = "SELECT * from productos WHERE ID_Producto = $id";
        $res = mysqli_query($con,$query);

        if  ( $res->num_rows > 0 ){
            $prod = mysqli_fetch_array($res);
        } else{
            $_SESSION['error'] = 'Product not found.';
            $con->close();
            header('location: /U-Tech/src/admin/pages/updt-prod.php');
        }
    } else{
        $_SESSION['error'] = 'There was a problem.';
        $con->close();
        header('location: /U-Tech/src/admin/pages/updt-prod.php');
    } 

    require_once '../../../config/config.php';
    require BASE_PATH . 'src/admin/admin-header.php'; 

    $query = "SELECT ID_categoria, nombre FROM categoria;";
    $res_cat = mysqli_query($con,$query);

    $id_img = $prod['ID_img'];
    $qimg = "SELECT foto FROM imagenes WHERE ID_img = $id_img"; 
    $img_res = mysqli_query($con, $qimg);
    $img_src = mysqli_fetch_array($img_res);

    $con->close();
?>
            <!-- CONTENIDO DEL INDEX -->
            <div class="container-md text-center my-5">
                <h1 class="fs-1 text-white">UPDATE PRODUCT</h1><br>
                <p class="text-white"><?php echo $prod['nombre'] ?></p>
            </div>
            <div class="container-md d-flex px-lg-5" style="justify-content: center;">
                <form action="<?php echo '/U-Tech/src/admin/config/u-product.php?id-img='.$prod['ID_img'] ?>" class="form text-white p-5 rounded-5" method="post" enctype="multipart/form-data">
                    <!-- ID -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">ProductID</span>
                        <input type="text" name="id" value="<?php echo $prod['ID_producto'] ?>" class="form-control" readonly>
                    </div>
                    <!-- NOMBRE -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" name="name" value="<?php echo $prod['nombre'] ?>" class="form-control" required>
                    </div>
                    <!-- CATEGORIA -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Category</span>
                        <select name="cat" class="form-select" required>
                            <?php
                                while ($row =  mysqli_fetch_array($res_cat)){
                                    echo '<option value="'.$row['ID_categoria'].'" ';
                                    if ($row['ID_categoria'] == $prod['ID_categoria']){
                                        echo 'selected';
                                    } 
                                    echo '>'. $row['nombre'] .'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <!-- DESCRIPCIÓN -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Description</span>
                        <textarea name="desc" class="form-control" maxlength="300"  required><?php echo $prod['descripcion'] ?></textarea>
                    </div>
                    <!-- FOTO -->
                    <div class=" mb-3">
                        <div class="input-group">
                            <span class="input-group-text">Actual image</span>
                            <?php
                                include '../config/a-conn.php';
                                // Obtenemos la imagen del producto
                                echo '<span class="input-group-text"> <img src="'.$img_src['foto'].'" alt="Image" style="width: 50px; height: auto;"></span>';
                            ?>
                                <input type="file" name="img" accept="image/*" class="form-control">
                        </div>
                        <div class="form-text text-white"><i class="bi bi-info-circle"></i>&emsp;Upload the product photo here if you want to replace it.</div>
                    </div>
                    <!-- PRECIO -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Price [$]</span>
                        <input type="number" step="0.1" min="0" name="price" class="form-control" value="<?php echo $prod['precio'] ?>" required>
                        <span class="input-group-text">.00</span>    
                    </div>
                    <!-- CANTIDAD -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Quantity</span>
                        <input type="number" name="quantity" min="0" value="<?php echo $prod['cantidad'] ?>" class="form-control" required>
                    </div>
                    <!-- FABRICANTE -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Supplier</span>
                        <input type="text" name="sup" value="<?php echo $prod['fabricante'] ?>" class="form-control" required>
                    </div>
                    <!-- ORIGEN -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Origin</span>
                        <input type="text" name="origin" value=" <?php echo $prod['origen'] ?>" class="form-control" required>
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