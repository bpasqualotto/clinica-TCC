<?php
require_once 'config.php';

// Processar formulário de agendamento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_paciente = trim($_POST['nome_paciente'] ?? '');
    $email_paciente = trim($_POST['email_paciente'] ?? '');
    $telefone_paciente = trim($_POST['telefone_paciente'] ?? '');
    $data_agendamento = trim($_POST['data_agendamento'] ?? '');
    $hora_agendamento = trim($_POST['hora_agendamento'] ?? '');
    $tipo_servico = trim($_POST['tipo_servico'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');
    
    // Validar campos obrigatórios
    if (empty($nome_paciente) || empty($email_paciente) || empty($telefone_paciente) || 
        empty($data_agendamento) || empty($hora_agendamento) || empty($tipo_servico)) {
        definirMensagem('Por favor, preencha todos os campos obrigatórios.', 'erro');
    } else {
        // Validar se a data não é no passado
        if (strtotime($data_agendamento) < strtotime(date('Y-m-d'))) {
            definirMensagem('A data do agendamento deve ser a partir de hoje.', 'erro');
        } else {
            try {
                $pdo = conectarBanco();
                
                // Verificar se já existe agendamento no mesmo horário
                $sql_verificar = "SELECT COUNT(*) FROM agendamentos WHERE data_agendamento = ? AND hora_agendamento = ? AND status != 'cancelado'";
                $stmt_verificar = $pdo->prepare($sql_verificar);
                $stmt_verificar->execute([$data_agendamento, $hora_agendamento]);
                $contador = $stmt_verificar->fetchColumn();
                
                if ($contador > 0) {
                    definirMensagem('Já existe um agendamento para este horário. Por favor, escolha outro horário.', 'aviso');
                } else {
                    // Inserir novo agendamento
                    $sql = "INSERT INTO agendamentos (nome_paciente, email_paciente, telefone_paciente, data_agendamento, hora_agendamento, tipo_servico, mensagem) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$nome_paciente, $email_paciente, $telefone_paciente, $data_agendamento, $hora_agendamento, $tipo_servico, $mensagem]);
                    
                    definirMensagem('Agendamento solicitado com sucesso! Entraremos em contato para confirmação.', 'sucesso');
                }
            } catch (Exception $e) {
                definirMensagem('Erro ao agendar consulta. Tente novamente.', 'erro');
            }
        }
    }
}

// Redirecionar de volta
$referrer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
redirecionar($referrer);
?>
