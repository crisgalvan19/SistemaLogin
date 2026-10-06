<?php
session_start();
require 'conexion.php';
 
$error = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';
 
    if (!empty($usuario) && !empty($password)) {
        // Consulta adaptada a la columna name_user de tu tabla
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE name_user = ?');
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();
 
        // Comprueba si existe el usuario y si coincide la contraseña encriptada
        if ($user && password_verify($password, $user['password_user'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['name_user'];
            header('Location: panel.php');
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Por favor, completa todos los campos.";
    }
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth">
    <aside class="auth-brand">
        <div class="brand-name">Sistema de Inicio y Registro de usuarios</div>
        <div class="brand-text">
            <h2>Qué bueno verte de nuevo.</h2>
            <p>Entra con tu cuenta para continuar donde lo dejaste.</p>
        </div>
    </aside>
 
    <main class="auth-main">
        <div class="auth-card">
            <h1>Inicia sesión</h1>
            <p class="sub">Ingresa tu usuario y contraseña.</p>
 
            <?php if (!empty($error)): ?>
                <div class="alert alert-error" role="alert"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
 
            <form action="login.php" method="POST">
                <div class="field">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" autocomplete="username" autofocus required>
                </div>
                <div class="field">
                    <label for="password">Contraseña</label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="password" autocomplete="current-password" required>
                        <button type="button" class="toggle-pass" data-target="password">Mostrar</button>
                    </div>
                </div>
                <button type="submit" class="btn">Entrar</button>
            </form>
 
            <p class="switch">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
        </div>
    </main>
</div>
<script src="app.js"></script>
</body>
</html>