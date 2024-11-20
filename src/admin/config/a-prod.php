<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK){
            require 'a-conn.php';
            //Se recibe la imagen
            $img = $_FILES['img']['tmp_name'];
            $img_name = $_FILES['img']['name'];
            $format = strtolower(pathinfo($img_name,PATHINFO_EXTENSION)); 
            $dir = '/U-tech/public/img/products/';

            //Se hace el registro vacio para obtener el id
            $img_reg = $con->query("INSERT INTO imagenes (foto) VALUES ('')");
            
            //Se recupera el id y se inserta la ruta de la imagen a la base de datos
            $id_reg = $con->insert_id;
            $img_route = $dir.$id_reg.'.'.$format;
            $img_save = $con->query("UPDATE imagenes SET foto='$img_route' WHERE ID_img=$id_reg");


            if(move_uploaded_file($img,$_SERVER['DOCUMENT_ROOT'].$img_route)){
                //Se extrea el resto de los datos
                $name = $_POST['name'];
                $cat = $_POST['cat'];
                $des = $_POST['desc'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $sup = $_POST['sup'];
                $origin = $_POST['origin'];

                //Se agrega el producto
                $reg = "INSERT INTO productos (ID_categoria, nombre, descripcion, ID_img, precio, cantidad, fabricante, origen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $con->prepare($reg);
                $stmt->bind_param("issidiss",$cat,$name,$des,$id_reg,$price,$quantity,$sup,$origin);

                
                if ($stmt->execute()){
                    //Se agregó el producto
                    $_SESSION['success'] = 'Product added succesfully.';
                } else {
                    //Error al agregar el producto
                    $_SESSION['error'] = 'Error, the product was not added.';
                }

                $stmt->close();
                $con->close();
                header('location: /U-tech/src/admin/pages/add-prod.php'); 
            }else{
                //Error al guardar la imagen
                $_SESSION['error'] = 'A problem occurred while saving the image.';
                header('location: /U-tech/src/admin/pages/add-prod.php'); 
            }
        } else{
            //Error al cargar la imagen
            $_SESSION['error'] = 'Image upload failed.';
            $con->close();
            header('location: /U-tech/src/admin/pages/add-prod.php'); 
        }
    } else{
        $_SESSION['error'] = 'Invalid POST method required.';
        header('location: /U-tech/src/admin/pages/add-prod.php');
    }
    exit;