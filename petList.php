<?php
require 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['idRefugio'])) {
        $idRefugio = $_GET['idRefugio'];

        $stmt = $conex->prepare("SELECT * FROM mascotas WHERE idRefugio = ?");
        $stmt->bind_param("i", $idRefugio);
        $stmt->execute();
        $result = $stmt->get_result();

        $mascotas = array();
        while ($row = $result->fetch_assoc()) {
            $mascotas[] = [
                'idmascotas' => $row['idmascotas'],
                'nombre' => $row['nombre'],
                'edad' => $row['edad'],
                'imagen_url' => 'http://192.168.1.4/API/imagenes/' . $row['imagen_url']

            ];
        }
        $stmt->close();


        echo json_encode($mascotas);
    } else {
        echo json_encode(["success" => false, "message" => "idRefugio no proporcionado"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}
?>