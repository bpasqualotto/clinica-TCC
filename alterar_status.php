<?php
require_once 'config.php';

// Verificar se usuário está logado
if (!estaLogado()) {
    definirMensagem('Acesso negado.', 'erro');
    redirecionar('login.php');
}

$id = intval($_GET['id'] ?? 0);
$status = $_GET['status'] ?? '';

// Validar parâmetros
if ($id <= 0 || !in_array($status, ['pendente', 'confirmado', 'cancelado'])) {
    definirMensagem('Parâmetros inválidos.', 'erro');
    redirecionar('dashboard.php');
}

try {
    $pdo = conectarBanco();
    $sql = "UPDATE agendamentos SET status = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$status, $id]);
    
    if ($stmt->rowCount() > 0) {
        $statusTexto = [
            'pendente' => 'pendente',
            'confirmado' => 'confirmado',
            'cancelado' => 'cancelado'
        ];
        
        definirMensagem("Status alterado para '{$statusTexto[$status]}' com sucesso!", 'sucesso');
    } else {
        definirMensagem('Agendamento não encontrado.', 'erro');
    }
} catch (Exception $e) {
    definirMensagem('Erro ao alterar status.', 'erro');
}

redirecionar('dashboard.php');
?>
