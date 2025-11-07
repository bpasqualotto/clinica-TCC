<?php
require_once __DIR__ . '/config.php';
if (!isset($_SESSION['paciente_id'])) {
    $_SESSION['mensagem'] = 'Faça login para acessar sua área.';
    $_SESSION['tipo_mensagem'] = 'aviso';
    header('Location: paciente_login.php');
    exit;
}
