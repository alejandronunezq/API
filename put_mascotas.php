<?php
require 'database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);


    if(isset($data['nombre'], $data['edad'], $data['imagen'], $data['idRefugio'])) {
        $nombre = $data['nombre'];
        $edad = $data['edad'];
        $imagen = $data['imagen'];
        $idRefugio = $data['idRefugio'];


        $stmt = $conex->prepare("INSERT INTO mascotas (nombre, edad, imagen_url, idRefugio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nombre, $edad, $imagen, $idRefugio);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(["success" => true, "message" => "Mascota añadida exitosamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al añadir mascota"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}
?>
