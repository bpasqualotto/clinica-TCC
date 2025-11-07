<?php
require_once 'config.php';

// Permite apenas usuários autenticados (admin ou paciente)
if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['paciente_id'])) {
    $_SESSION['mensagem'] = 'Faça login para agendar.';
    $_SESSION['tipo_mensagem'] = 'aviso';
    header('Location: paciente_login.php');
    exit;
}

// Processar formulário de agendamento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_paciente = trim($_POST['nome_paciente'] ?? '');
    $email_paciente = trim($_POST['email_paciente'] ?? '');
    $telefone_paciente = trim($_POST['telefone_paciente'] ?? '');
    $data_agendamento = trim($_POST['data_agendamento'] ?? '');
    $hora_agendamento = trim($_POST['hora_agendamento'] ?? '');
    $tipo_servico = trim($_POST['tipo_servico'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    // Validação simples
    $erros = [];
    if ($nome_paciente === '') $erros[] = 'Informe o nome.';
    if ($email_paciente === '') $erros[] = 'Informe o e-mail.';
    if ($telefone_paciente === '') $erros[] = 'Informe o telefone.';
    if ($data_agendamento === '') $erros[] = 'Informe a data.';
    if ($hora_agendamento === '') $erros[] = 'Informe a hora.';
    if ($tipo_servico === '') $erros[] = 'Informe o tipo de serviço.';

    if (empty($erros)) {
        try {
            $pdo = getPDO();

            $stmt = $pdo->prepare("
                INSERT INTO agendamentos (nome_paciente, email_paciente, telefone_paciente, data_agendamento, hora_agendamento, tipo_servico, mensagem, status)
                VALUES (:nome, :email, :tel, :data, :hora, :tipo, :msg, 'PENDENTE')
            ");
            $stmt->execute([
                ':nome' => $nome_paciente,
                ':email' => $email_paciente,
                ':tel' => $telefone_paciente,
                ':data' => $data_agendamento,
                ':hora' => $hora_agendamento,
                ':tipo' => $tipo_servico,
                ':msg' => $mensagem,
            ]);

            definirMensagem('Agendamento solicitado com sucesso! Entraremos em contato para confirmação.', 'sucesso');
        } catch (Exception $e) {
            definirMensagem('Erro ao agendar consulta. Tente novamente.', 'erro');
        }
    } else {
        definirMensagem(implode('<br>', $erros), 'erro');
    }

    // Redireciona para evitar re-envio de POST
    header('Location: agendar.php');
    exit;
}
?>
<?php include 'menu.php'; ?>

<div class="container py-4">
    <h1 class="mb-4"><i class="fas fa-calendar-plus"></i> Agendar Consulta</h1>

    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?? 'info' ?>">
            <?= $_SESSION['mensagem']; unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
        </div>
    <?php endif; ?>

    <form method="post" class="card p-3 shadow-sm">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nome</label>
                <input type="text" name="nome_paciente" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">E-mail</label>
                <input type="email" name="email_paciente" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone_paciente" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Data</label>
                <input type="date" name="data_agendamento" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Hora</label>
                <input type="time" name="hora_agendamento" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Serviço</label>
                <select name="tipo_servico" class="form-select" required>
                    <option value="">Selecione...</option>
                    <option>Clínico Geral</option>
                    <option>Pediatria</option>
                    <option>Dermatologia</option>
                    <option>Cardiologia</option>
                    <option>Ginecologia</option>
                    <option>Ortopedia</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Mensagem (opcional)</label>
                <textarea name="mensagem" class="form-control" rows="4"></textarea>
            </div>
        </div>

        <div class="mt-3 d-flex gap-2">
            <button class="btn btn-success">
                <i class="fas fa-paper-plane"></i> Enviar solicitação
            </button>
            <a class="btn btn-outline-secondary" href="index.php">Cancelar</a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
