<?php
require 'database.php';

$idusuario = $_POST['idusuario'];
$email = $_POST['email'];
$password = $_POST['password'];
$tipoCuenta = $_POST['tipoCuenta'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conex->prepare("UPDATE usuario SET email = ?, password = ?, tipoCuenta = ? WHERE idusuario = ?");
$stmt->bind_param("sssi", $email, $hashedPassword, $tipoCuenta, $idusuario);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Usuario actualizado correctamente"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al actualizar usuario"]);
}

$stmt->close();
$conex->close();
?>
