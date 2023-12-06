<?php
require 'database.php';
$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/API/imagenes/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "La imagen ". htmlspecialchars( basename( $_FILES["file"]["name"])). " ha sido subida correctamente.";
    } else {
        echo "Lo sentimos, hubo un error al cargar tu archivo..";
    }
}

?>
