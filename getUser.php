<?php
require 'database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos JSON enviados desde la aplicación Android
    $data = json_decode(file_get_contents('php://input'), true);

    // Comprueba que tanto el email como la contraseña estén presentes
    if(isset($data['email']) && isset($data['password'])) {
        $email = $data['email'];
        $password = $data['password'];

        $stmt = $conex->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                // La contraseña coincide, el login es exitoso
                echo json_encode(["success" => true, "tipoCuenta" => $row['tipoCuenta']]);
            } else {
                // La contraseña no coincide
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
