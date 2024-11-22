<?php 
    require_once '../../../config/config.php';
    require BASE_PATH . 'src/admin/admin-header.php';
?>
        <!-- CONTENIDO DEL INDEX -->
            <div class="container-md text-center my-5">
                <h1 class="fs-1 text-white">UPDATE PRODUCT</h1>
            </div>
            <div class="container px-lg-5" style="justify-content: center; overflow-x:auto; width: 100%;">
                <table class="table table-dark table-borderless table-hover text-center" style="width: 100%;">
                    <thead class="table-light">
                        <th>ProductID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Supplier</th>
                        <th>Origin</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                require BASE_PATH. 'src/admin/config/a-conn.php';

                                // Consulta para obtener los productos
                                $query = "SELECT * FROM productos";
                                $res = mysqli_query($con, $query);
                                
                                // Iteramos sobre cada producto
                                while ($row = mysqli_fetch_array($res)) {
                                    // Obtenemos la categoría del producto
                                    $id_cat = $row['ID_categoria'];
                                    $qcat = "SELECT nombre FROM categoria WHERE ID_categoria = $id_cat"; 
                                    $cat_res = mysqli_query($con, $qcat);
                                    $cat = mysqli_fetch_array($cat_res);
                                
                                    // Obtenemos la imagen del producto
                                    $id_img = $row['ID_img'];
                                    $qimg = "SELECT foto FROM imagenes WHERE ID_img = $id_img"; 
                                    $img_res = mysqli_query($con, $qimg);
                                    $img_src = mysqli_fetch_array($img_res);
                                
                                    // Mostramos la fila
                                    echo '<tr>';
                                    echo '<td>'.$row['ID_producto'].'</td>';
                                    echo '<td>'.$cat['nombre'].'</td>'; // Mostramos el nombre de la categoría
                                    echo '<td>'.$row['nombre'].'</td>';
                                    echo '<td>'.$row['descripcion'].'</td>';
                                    echo '<td><img src="'.$img_src['foto'].'" alt="Image" style="width: 50px; height: auto;"></td>'; // Mostramos la imagen
                                    echo '<td>'.$row['cantidad'].'</td>';
                                    echo '<td>$'.$row['precio'].'</td>';
                                    echo '<td>'.$row['fabricante'].'</td>';
                                    echo '<td>'.$row['origen'].'</td>';
                                    echo '<td><a class="link" href="/U-Tech/src/admin/pages/u-prod-form.php?id-prod='.$row['ID_producto'].'"><i class="bi bi-arrow-clockwise"></i></a></td>';
                                    echo '<td><a class="link" href="/U-Tech/src/admin/config/del-product.php?id-prod='.$row['ID_producto'].'"><i class="bi bi-backspace-reverse"></i></i></a></td>';
                                    echo '</tr>';

                                }                                
                            ?>
                        </tr>
                    </tbody>
                </table>
                <!-- Cerramos la conexión con la base de datos -->
                <?php $con->close(); ?>
            </div>
        </section>
    </section>
</body>
</html>