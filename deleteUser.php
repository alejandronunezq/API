<?php
require 'database.php';

$idusuario = $_POST['idusuario'];

$stmt = $conex->prepare("DELETE FROM usuario WHERE idusuario = ?");
$stmt->bind_param("i", $idusuario);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Usuario eliminado correctamente"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al eliminar usuario"]);
}

$stmt->close();
$conex->close();
?>
