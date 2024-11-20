<?php 
    require_once '../../../config/config.php';
    require BASE_PATH . 'src/admin/admin-header.php';  

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
        <!-- CONTENIDO DEL INDEX -->
            <div class="container-md text-center my-5">
                <h1 class="fs-1 text-white">ADD PRODUCT</h1>
            </div>
            <div class="container-md d-flex px-lg-5" style="justify-content: center;">
                <form action="<?php echo '/U-Tech/src/admin/config/a-prod.php'; ?>" class="form text-white p-5 rounded-5" enctype="multipart/form-data" method="post">
                    <!-- NOMBRE -->
                    <div class="input-group mb-3">
                        <input type="text" name="name" placeholder="Name" class="form-control" required>
                    </div>
                    <!-- CATEGORIA -->
                    <div class="input-group mb-3">
                        <select name="cat" class="form-select" required>
                            <option value="" selected disabled>Category...</option>
                            <?php
                                include '../config/a-conn.php';

                                $query = "SELECT ID_categoria, nombre FROM categoria;";
                                $res = mysqli_query($con,$query);

                                while ($row =  mysqli_fetch_array($res)){
                                    echo '<option value="'.$row['ID_categoria'] .'">'. $row['nombre'] .'</option>';
                                }
                                $con->close();
                            ?>
                        </select>
                    </div>
                    <!-- DESCRIPCIÓN -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Description</span>
                        <textarea name="desc" class="form-control" maxlength="300" required></textarea>
                    </div>
                    <!-- FOTO -->
                    <div class=" mb-3">
                        <div class="input-group">
                            <input type="file" name="img" accept="image/*" class="form-control" required>
                        </div>
                        <div class="form-text text-white">Upload the product photo here.</div>
                    </div>
                    <!-- PRECIO -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.1" min="0" name="price" class="form-control" placeholder="Price" required>
                        <span class="input-group-text">.00</span>    
                    </div>
                    <!-- CANTIDAD -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Quantity</span>
                        <input type="number" name="quantity" min="0" class="form-control" required>
                    </div>
                    <!-- FABRICANTE -->
                    <div class="input-group mb-3">
                        <input type="text" name="sup" placeholder="Supplier" class="form-control" required>
                    </div>
                    <!-- ORIGEN -->
                    <div class="input-group mb-3">
                        <input type="text" name="origin" placeholder="Origin" class="form-control" required>
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