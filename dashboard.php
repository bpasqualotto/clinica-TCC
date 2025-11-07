<?php require_once __DIR__ . '/require_login.php'; ?>
<?php
require_once __DIR__ . '/config.php';

/* ---------------------- Helpers de mensagem (flash) ---------------------- */
function flash(string $msg, string $tipo = 'info'): void {
    $_SESSION['mensagem'] = $msg;
    $_SESSION['tipo_mensagem'] = $tipo;
}
function flash_show(): void {
    if (!empty($_SESSION['mensagem'])) {
        $tipo = $_SESSION['tipo_mensagem'] ?? 'info';
        $classe = 'alert-info';
        if ($tipo === 'sucesso') $classe = 'alert-success';
        if ($tipo === 'erro')    $classe = 'alert-danger';
        if ($tipo === 'aviso')   $classe = 'alert-warning';
        echo '<div class="alert ' . $classe . ' mt-3" role="alert">'
           . htmlspecialchars($_SESSION['mensagem']) .
           '</div>';
        unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']);
    }
}

/* ---------------------- Verificação de login ---------------------- */
if (!estaLogado()) {
    flash('Acesso negado. Faça login primeiro.', 'erro');
    header('Location: login.php');
    exit;
}

/* ---------------------- Conexão PDO ---------------------- */
try {
    if (!isset($pdo)) {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }
} catch (Throwable $e) {
    flash('Erro ao conectar ao banco de dados.', 'erro');
    $pdo = null;
}

/* ---------------------- Consultas do dashboard ---------------------- */
$agendamentos = [];
$contatos = [];
$stats = ['total_agendamentos' => 0, 'pendentes' => 0, 'confirmados' => 0, 'total_contatos' => 0];

if ($pdo) {
    try {
        // Agendamentos recentes (campos existentes na sua tabela)
        $sql_ag = "SELECT id, nome, email, especialidade, data_agendamento, mensagem, criado_em
                   FROM agendamentos
                   ORDER BY criado_em DESC
                   LIMIT 10";
        $agendamentos = $pdo->query($sql_ag)->fetchAll();

        // Mensagens recentes
        $sql_ct = "SELECT id, nome, assunto, mensagem, criado_em
                   FROM contatos
                   ORDER BY criado_em DESC
                   LIMIT 5";
        $contatos = $pdo->query($sql_ct)->fetchAll();

        // Estatísticas existentes
        $stats['total_agendamentos'] = (int)$pdo->query("SELECT COUNT(*) FROM agendamentos")->fetchColumn();
        $stats['total_contatos']     = (int)$pdo->query("SELECT COUNT(*) FROM contatos")->fetchColumn();

        // Como sua tabela NÃO tem coluna 'status', deixamos 0.
        // Se você criar a coluna status (pendente/confirmado/cancelado), me avise que ajusto aqui.
        $stats['pendentes']   = 0;
        $stats['confirmados'] = 0;
    } catch (Throwable $e) {
        flash('Erro ao carregar dados do dashboard.', 'erro');
    }
}

/* ---------------------- Nome no topo ---------------------- */
$NOME_DASH = $_SESSION['usuario'] ?? ($_SESSION['nome_completo'] ?? 'Usuário');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Clínica Médica VivaMed</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link href="estilo.css" rel="stylesheet">
</head>
<body>
    <!-- Menu -->
    <?php require_once __DIR__ . '/menu.php'; ?>

    <!-- Mensagens -->
    <div class="container">
        <?php flash_show(); ?>
    </div>

    <!-- Header -->
    <section class="bg-primary text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold">
                        <i class="fas fa-tachometer-alt"></i> Dashboard Administrativo
                    </h1>
                    <p class="lead mb-0">Bem-vindo ao painel de controle da clínica</p>
                </div>
                <div class="col-md-4 text-end">
                    <span class="badge bg-success fs-6">
                        <i class="fas fa-user"></i> <?php echo htmlspecialchars($NOME_DASH); ?>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Conteúdo -->
    <section class="py-5">
        <div class="container">
            <!-- KPIs -->
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-check fa-3x mb-3"></i>
                            <h3 class="card-title"><?php echo (int)$stats['total_agendamentos']; ?></h3>
                            <p class="card-text">Total de Agendamentos</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope fa-3x mb-3"></i>
                            <h3 class="card-title"><?php echo (int)$stats['total_contatos']; ?></h3>
                            <p class="card-text">Mensagens Recebidas</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-3x mb-3"></i>
                            <h3 class="card-title"><?php echo (int)$stats['pendentes']; ?></h3>
                            <p class="card-text">Pendentes</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <h3 class="card-title"><?php echo (int)$stats['confirmados']; ?></h3>
                            <p class="card-text">Confirmados</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agendamentos Recentes -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-alt"></i> Agendamentos Recentes
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($agendamentos)): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Paciente</th>
                                                <th>Data/Hora</th>
                                                <th>Especialidade</th>
                                                <th>Observação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($agendamentos as $ag): ?>
                                            <?php
                                                $dt = $ag['data_agendamento'];
                                                $dataFmt = $dt ? date('d/m/Y', strtotime($dt)) : '-';
                                                $horaFmt = $dt ? date('H:i', strtotime($dt)) : '-';
                                            ?>
                                            <tr>
                                                <td>
                                                    <strong><?php echo htmlspecialchars($ag['nome'] ?? '-'); ?></strong><br>
                                                    <small class="text-muted"><?php echo htmlspecialchars($ag['email'] ?? ''); ?></small>
                                                </td>
                                                <td><?php echo $dataFmt; ?><br><small><?php echo $horaFmt; ?></small></td>
                                                <td><?php echo htmlspecialchars($ag['especialidade'] ?? '-'); ?></td>
                                                <td class="text-truncate" style="max-width: 280px;">
                                                    <small class="text-muted"><?php echo htmlspecialchars($ag['mensagem'] ?? ''); ?></small>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Nenhum agendamento encontrado</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Mensagens Recentes -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-envelope"></i> Mensagens Recentes
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($contatos)): ?>
                                <?php foreach ($contatos as $c): ?>
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1"><?php echo htmlspecialchars($c['nome'] ?? '-'); ?></h6>
                                                <p class="mb-1 small"><?php echo htmlspecialchars($c['assunto'] ?? ''); ?></p>
                                                <small class="text-muted">
                                                    <?php echo $c['criado_em'] ? date('d/m/Y H:i', strtotime($c['criado_em'])) : ''; ?>
                                                </small>
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary" title="Ver mensagem"
                                                    onclick="verMensagem(<?php echo (int)$c['id']; ?>)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <p class="mb-0 small text-muted mt-2">
                                            <?php
                                                $msg = trim((string)($c['mensagem'] ?? ''));
                                                echo htmlspecialchars(mb_strimwidth($msg, 0, 120, '...'));
                                            ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-envelope-open fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Nenhuma mensagem encontrada</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="bg-primary text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-hospital-alt"></i> Clínica Médica VivaMed</h5>
                    <p class="mb-1"><i class="fas fa-map-marker-alt"></i> Rua das Flores, 123</p>
                    <p class="mb-1">Curitiba, PR - CEP 01234-567</p>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                    <p class="mb-1"><i class="fas fa-phone"></i> (11) 3456-7890</p>
                    <p class="mb-1"><i class="fas fa-envelope"></i> contato@clinicasp.com.br</p>
                    <p class="mb-1"><i class="fas fa-whatsapp"></i> (11) 99999-9999</p>
                </div>
                <div class="col-md-4">
                    <h5>Horário de Funcionamento</h5>
                    <p class="mb-1">Segunda a Sexta: 7h às 19h</p>
                    <p class="mb-1">Sábado: 8h às 14h</p>
                    <p class="mb-1">Domingo: Emergências</p>
                </div>
            </div>
            <hr class="my-3">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2024 Clínica Médica VivaMed. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function verDetalhes(id) {
        alert('Ver detalhes do agendamento #' + id);
    }
    function alterarStatus(id, novoStatus) {
        alert('Status não disponível — a tabela não possui coluna "status".');
        // Se você criar a coluna status, posso implementar o AJAX aqui.
    }
    function verMensagem(id) {
        alert('Ver mensagem #' + id);
    }
    </script>
</body>
</html>
