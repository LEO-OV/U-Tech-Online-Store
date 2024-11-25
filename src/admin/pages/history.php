    <?php 
        require_once '../../../config/config.php';
        require BASE_PATH . 'src/admin/admin-header.php'; //HEADER
        
    ?>        
            <!-- CONTENIDO DEL INDEX -->
            <div class="container-md text-center my-5">
                <h1 class="fs-1 text-white">PURCHASE HISTORY</h1>
            </div>
            <div class="container px-lg-5" style="justify-content: center; overflow-x:auto; width: 100%;">
                <table class="table table-dark table-borderless table-hover text-center" style="width: 100%;">
                    <thead class="table-light">
                        <th>Purchase</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                require BASE_PATH. 'src/admin/config/a-conn.php';

                                // Consulta para obtener los productos
                                $query = "SELECT H.ID_compra, U.nombre AS usuario, P.nombre AS producto, H.cantidad 
                                            FROM historial_compras AS H 
                                            JOIN productos AS P ON H.ID_producto = P.ID_producto 
                                            JOIN usuarios AS U ON H.ID_usuario = U.ID_usuario";
                                $res = mysqli_query($con, $query);
                                
                                // Iteramos sobre cada producto
                                while ($row = mysqli_fetch_array($res)) {                                
                                    // Mostramos la fila
                                    echo '<tr>';
                                    echo '<td>'.$row['ID_compra'].'</td>';
                                    echo '<td>'.$row['usuario'].'</td>';
                                    echo '<td>'.$row['producto'].'</td>'; 
                                    echo '<td>'.$row['cantidad'].'</td>';
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