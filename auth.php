<?php
// auth.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ajuste a lógica conforme seu login.
function estaLogado(): bool {
    return isset($_SESSION['usuario']); // ou $_SESSION['usuario_id']
}
