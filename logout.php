<?php
session_start();
require 'database.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    echo json_encode(["success" => true, "message" => "Sesión cerrada con éxito"]);
    exit;
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
    exit;
}
?>
