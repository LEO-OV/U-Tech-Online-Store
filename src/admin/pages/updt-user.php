<?php 
    require_once '../../../config/config.php';
    require BASE_PATH . 'src/admin/admin-header.php';  
    ?>
        <!-- CONTENIDO DEL INDEX -->
            <div class="container-md text-center my-5">
                <h1 class="fs-1 text-white">UPDATE USER</h1>
            </div>
            <div class="container px-lg-5" style="justify-content: center; overflow-x:auto; width: 100%;">
                <table class="table table-dark table-borderless table-hover text-center" style="width: 100%;">
                    <thead class="table-light">
                        <th>User_ID</th>
                        <th>Name</th>
                        <th>Mail</th>
                        <th>Birthdate</th>
                        <th>Credit card</th>
                        <th>Mailing address</th>
                        <th>Permissions</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                require BASE_PATH. 'src/admin/config/a-conn.php';

                                // Consulta para obtener los productos
                                $query = "SELECT * FROM usuarios";
                                $res = mysqli_query($con, $query);
                                
                                // Iteramos sobre cada producto
                                while ($row = mysqli_fetch_array($res)) {                                
                                    // Mostramos la fila
                                    echo '<tr>';
                                    echo '<td>'.$row['ID_usuario'].'</td>';
                                    echo '<td>'.$row['nombre'].'</td>';
                                    echo '<td>'.$row['correo'].'</td>'; // Mostramos el nombre de la categoría
                                    echo '<td>'.$row['f_nacimiento'].'</td>';
                                    echo '<td>'.$row['tarjeta'].'</td>';
                                    echo '<td>'.$row['postal'].'</td>';
                                    echo '<td>'.$row['permisos'].'</td>';
                                    echo '<td><a class="link" href="/U-Tech/src/admin/pages/u-user-form.php?id-user='.$row['ID_usuario'].'"><i class="bi bi-arrow-clockwise"></i></a></td>';
                                    echo '<td><a class="link" href="/U-Tech/src/admin/config/del-user.php?id-user='.$row['ID_usuario'].'"><i class="bi bi-backspace-reverse"></i></a></td>';
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