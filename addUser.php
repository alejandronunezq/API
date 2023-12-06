<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tipoCuenta = $_POST['tipoCuenta'];
    $telefono = $_POST['telefono'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conex->prepare("INSERT INTO usuario (email, password, tipoCuenta, telefono) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $hashedPassword, $tipoCuenta,$telefono);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Usuario agregado correctamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al agregar usuario"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}
?>
