<?php
require_once 'config.php';

// Destruir sessão
session_destroy();

// Definir mensagem de despedida
session_start();
definirMensagem('Logout realizado com sucesso!', 'sucesso');

// Redirecionar para página inicial
redirecionar('index.php');
?>