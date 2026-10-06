<?php
$dsn = "mysql:host=localhost;dbname=usuario_login;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (\PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>