<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idmascota = $_POST['idmascota'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];


    $stmt = $conex->prepare("UPDATE mascotas SET nombre = ?, edad = ? WHERE idmascotas = ?");
    $stmt->bind_param("ssi", $nombre, $edad, $idmascota);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Mascota actualizada correctamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar mascota"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}
?>
