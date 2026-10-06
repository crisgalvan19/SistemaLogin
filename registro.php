<?php
require 'conexion.php';
 
$mensaje = '';
$exito = false;
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';
 
    if (!empty($usuario) && !empty($password)) {
        // Encripta la contraseña usando password_hash
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
 
        try {
            // Usamos las columnas exactas de tu tabla: name_user y password_user
            $stmt = $pdo->prepare('INSERT INTO usuarios (name_user, password_user) VALUES (?, ?)');
            $stmt->execute([$usuario, $passwordHash]);
            $mensaje = "¡Cuenta creada! <a href='login.php'>Inicia sesión</a>";
            $exito = true;
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $mensaje = "El nombre de usuario ya está registrado.";
            } else {
                $mensaje = "Error al registrar: " . $e->getMessage();
            }
        }
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth">
    <aside class="auth-brand">
        <div class="brand-name">Sistema de Inicio y Registro de usuarios</div>
        <div class="brand-text">
            <h2>Crea tu cuenta en un minuto.</h2>
            <p>Elige un usuario y una contraseña. Eso es todo lo que necesitas.</p>
        </div>
    </aside>
 
    <main class="auth-main">
        <div class="auth-card">
            <h1>Crear cuenta</h1>
            <p class="sub">Elige tu usuario y contraseña.</p>
 
            <?php if (!empty($mensaje)): ?>
                <div class="alert <?php echo $exito ? 'alert-ok' : 'alert-error'; ?>" role="alert"><?php echo $mensaje; ?></div>
            <?php endif; ?>
 
            <form action="registro.php" method="POST">
                <div class="field">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" autocomplete="username" autofocus required>
                </div>
                <div class="field">
                    <label for="password">Contraseña</label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="password" autocomplete="new-password" required>
                        <button type="button" class="toggle-pass" data-target="password">Mostrar</button>
                    </div>
                </div>
                <button type="submit" class="btn">Crear cuenta</button>
            </form>
 
            <p class="switch">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
        </div>
    </main>
</div>
<script src="app.js"></script>
</body>
</html>
 