<?php
// Inclua este arquivo em páginas que PRECISAM de login (ex.: dashboard.php)
require_once __DIR__ . '/config.php';
if (!function_exists('estaLogado')) {
    function estaLogado(): bool { return isset($_SESSION['usuario_id']); }
}
if (!estaLogado()) {
    $_SESSION['mensagem'] = 'Faça login para acessar esta página.';
    $_SESSION['tipo_mensagem'] = 'aviso';
    header('Location: login.php');
    exit;
}
