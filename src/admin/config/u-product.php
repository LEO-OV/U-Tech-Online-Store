<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id-img'])) {
        require 'a-conn.php';

        $id_img =intval($_GET['id-img']);
        $id = $_POST['id'];
        $name = $_POST['name'];
        $cat = $_POST['cat'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $quant = $_POST['quantity'];
        $sup = $_POST['sup'];
        $ori = $_POST['origin'];

        //Borramos la imagen anterior del servidor
        $query = "SELECT foto FROM imagenes WHERE ID_img = $id_img";
        $file = mysqli_query($con,$query)->fetch_assoc()['foto'];

        try{
            //Si se recibe una imagen nueva
            if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK){
                
                // Verifica si el archivo existe
                if ($file && file_exists($_SERVER['DOCUMENT_ROOT'].$file)) { 
                    unlink($_SERVER['DOCUMENT_ROOT'].$file);
                } else {
                    throw new Exception("Image file not found.".$file);        
                }
    
                //Si se borro el archivo, borramos el registro de la base de datos
                $query = "DELETE FROM imagenes WHERE ID_img = $id";
                if (!mysqli_query($con,$query)){    
                    throw new Exception( "There was a problem deleting the image from the data base.");          
                }
    
                //Cargamos la nueva imagen
                $img = $_FILES['img']['tmp_name'];
                $img_name = $_FILES['img']['name'];
                $format = strtolower(pathinfo($img_name,PATHINFO_EXTENSION)); 
                $dir = '/U-tech/public/img/products/';
                $img_reg = $con->query("INSERT INTO imagenes (foto) VALUES ('')");
                
                //Se recupera el id y se inserta la ruta de la imagen a la base de datos
                $id_reg = $con->insert_id;
                $img_route = $dir.$id_reg.'.'.$format;
                $img_save = $con->query("UPDATE imagenes SET foto='$img_route' WHERE ID_img=$id_reg");
                $id_img = $id_reg;

                if(!move_uploaded_file($img,$_SERVER['DOCUMENT_ROOT'].$img_route)){
                     throw new Exception('A problem occurred while saving the image.');
                }
                
            } 

            $reg = "UPDATE productos set ID_categoria=?,nombre=?, descripcion=?, ID_img=?, precio=?, cantidad=?, fabricante=?, origen=? WHERE ID_producto=$id";
            $stmt = $con->prepare($reg);
            $stmt->bind_param("issidiss",$cat,$name,$desc, $id_img,$price,$quant,$sup,$ori);
    
            if ($stmt->execute()){
                //Se agregó el producto
                $_SESSION['success'] = 'Product updated succesfully.';
            } else {
                //Error al agregar el producto
                $_SESSION['error'] = 'Error, the product was not updated.';
            }
            $stmt->close();
            $con->close();
            header('location: /U-Tech/src/admin/pages/u-prod-form.php?id-prod='.$id);
            
        } catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
            $con->close();
            header('location: /U-Tech/src/admin/pages/u-prod-form.php?id-prod=' . $id);
            exit;
        }
    } else{
        $_SESSION['error'] = 'There was an error.';
        header('location: /U-Tech/src/admin/pages/updt-prod.php');
        exit;
    } 