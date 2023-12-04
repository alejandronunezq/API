<?php
require 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


// Este endpoint será accedido con el método GET.
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $mascotas = array();

    // Consulta todas las mascotas en la base de datos.
    $stmt = $conex->prepare("SELECT idmascotas, nombre, edad, imagen_url FROM mascotas");
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        // Para cada mascota en la base de datos, agrega un nuevo elemento al array de mascotas.
        // Asegúrate de que la URL de la imagen sea accesible públicamente desde Internet o tu red local.
        $mascotas[] = [
            'idmascotas' => $row['idmascotas'],
            'nombre' => $row['nombre'],
            'edad' => $row['edad'],
            'imagen_url' => 'http://192.168.1.4/API/imagenes/' . $row['imagen_url']
        ];
    }

    $stmt->close();

    // Devuelve el array de mascotas en formato JSON.
    echo json_encode($mascotas);
} else {
    // Manejar error de método no permitido.
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Método no permitido"]);

}
?>
