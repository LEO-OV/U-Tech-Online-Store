<?php 
    require_once '../../../config/config.php';
    require BASE_PATH . 'src/admin/admin-header.php';  
    ?>
        <!-- CONTENIDO DEL INDEX -->
            <div class="container-md text-center my-5">
                <h1 class="fs-1 text-white">UPDATE PRODUCT</h1>
            </div>
            <div class="container px-lg-5" style="justify-content: center; overflow-x:auto; width: 100%;">
                <table class="table table-dark table-borderless" style="width: 100%;">
                    <thead>
                        <th scope="col">ID_product</th>
                        <th scope="col">Category</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Origin</th>
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
                                    echo '<td>'.$row['nombre'].'</td>';
                                    echo '<td>'.$cat['nombre'].'</td>'; // Mostramos el nombre de la categoría
                                    echo '<td>'.$row['descripcion'].'</td>';
                                    echo '<td><img src="'.$img_src['foto'].'" alt="Imagen del producto" style="width: 25px; height: auto;"></td>'; // Mostramos la imagen
                                    echo '<td>'.$row['cantidad'].'</td>';
                                    echo '<td>$'.$row['precio'].'</td>';
                                    echo '<td>'.$row['fabricante'].'</td>';
                                    echo '<td>'.$row['origen'].'</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </section>
</body>
</html>