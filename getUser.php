<?php
session_start(); // Inicia una nueva sesión o reanuda la existente
require 'database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if(isset($data['email']) && isset($data['password'])) {
        $email = $data['email'];
        $password = $data['password'];

        $stmt = $conex->prepare("SELECT idusuario, password, tipoCuenta FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['idusuario'] = $row['idusuario']; // Guarda el idUsuario en la sesión
                echo json_encode(["success" => true, "idusuario" => $row['idusuario'], "tipoCuenta" => $row['tipoCuenta']]);
            } else {
                echo json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Usuario no encontrado"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Datos de email o contraseña no proporcionados"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}
?>
