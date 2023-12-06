<?php
require 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $mascotas = array();


    $stmt = $conex->prepare("SELECT m.idmascotas, m.nombre, m.edad, m.imagen_url, u.telefono FROM mascotas m JOIN usuario u ON m.idRefugio = u.idusuario");
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $mascotas[] = [
            'idmascotas' => $row['idmascotas'],
            'nombre' => $row['nombre'],
            'edad' => $row['edad'],
            'imagen_url' => 'http://192.168.1.4/API/imagenes/' . $row['imagen_url'],
            'telefono' => $row['telefono']
        ];
    }

    $stmt->close();

    echo json_encode($mascotas);
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}
?>
