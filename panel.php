<?php
session_start();
 
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de control</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <strong>Sistema de Inicio y Registro de usuarios </strong>
        <div class="user-chip">
            <span class="avatar"><?php echo htmlspecialchars(mb_strtoupper(mb_substr($_SESSION['usuario_nombre'], 0, 1))); ?></span>
            <span><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
            <a href="logout.php" class="btn btn-ghost">Cerrar sesión</a>
        </div>
    </header>
 
    <main class="content">
        <h1>Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></h1>
        <p class="lead">Este es tu panel de control.</p>
 
        <div class="status">
            <span class="dot"></span>
            <span>Tu sesión está activa.</span>
        </div>
    </main>
</body>
</html>
 