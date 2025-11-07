<?php
/**
 * Configurações do banco de dados e sessão
 * Clínica Médica VivaMed
 */

// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'clinica_medica');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configurações da sessão
session_start();

// Configurações gerais
define('SITE_NAME', 'Clínica Médica VivaMed');
define('SITE_URL', 'http://localhost');

// Função para conectar ao banco de dados
function conectarBanco() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
}

// Função para verificar se usuário está logado
function estaLogado() {
    return isset($_SESSION['usuario_id']);
}

// Função para redirecionar
function redirecionar($url) {
    header("Location: $url");
    exit();
}

// Função para exibir mensagens flash
function exibirMensagem() {
    if (isset($_SESSION['mensagem'])) {
        $tipo = $_SESSION['tipo_mensagem'] ?? 'info';
        $mensagem = $_SESSION['mensagem'];
        unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']);
        
        $classe = 'alert-info';
        switch($tipo) {
            case 'sucesso': $classe = 'alert-success'; break;
            case 'erro': $classe = 'alert-danger'; break;
            case 'aviso': $classe = 'alert-warning'; break;
        }
        
        echo "<div class='alert $classe alert-dismissible fade show' role='alert'>
                $mensagem
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              </div>";
    }
}

// Função para definir mensagem flash
function definirMensagem($mensagem, $tipo = 'info') {
    $_SESSION['mensagem'] = $mensagem;
    $_SESSION['tipo_mensagem'] = $tipo;
}
?>
