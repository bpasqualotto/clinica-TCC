<?php
require_once 'config.php';

// Verificar se usuário está logado
if (!estaLogado()) {
    definirMensagem('Acesso negado. Faça login primeiro.', 'erro');
    redirecionar('login.php');
}

// Buscar dados para o dashboard
try {
    $pdo = conectarBanco();
    
    // Buscar agendamentos recentes
    $sql_agendamentos = "SELECT * FROM agendamentos ORDER BY criado_em DESC LIMIT 10";
    $stmt_agendamentos = $pdo->query($sql_agendamentos);
    $agendamentos = $stmt_agendamentos->fetchAll();
    
    // Buscar mensagens recentes
    $sql_contatos = "SELECT * FROM contatos ORDER BY criado_em DESC LIMIT 5";
    $stmt_contatos = $pdo->query($sql_contatos);
    $contatos = $stmt_contatos->fetchAll();
    
    // Estatísticas
    $stats = [
        'total_agendamentos' => $pdo->query("SELECT COUNT(*) FROM agendamentos")->fetchColumn(),
        'pendentes' => $pdo->query("SELECT COUNT(*) FROM agendamentos WHERE status = 'pendente'")->fetchColumn(),
        'confirmados' => $pdo->query("SELECT COUNT(*) FROM agendamentos WHERE status = 'confirmado'")->fetchColumn(),
        'total_contatos' => $pdo->query("SELECT COUNT(*) FROM contatos")->fetchColumn()
    ];
    
} catch (Exception $e) {
    definirMensagem('Erro ao carregar dados do dashboard.', 'erro');
    $agendamentos = [];
    $contatos = [];
    $stats = ['total_agendamentos' => 0, 'pendentes' => 0, 'confirmados' => 0, 'total_contatos' => 0];
}
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
    <!-- Incluir Menu -->
    <?php include 'menu.php'; ?>
    
    <!-- Mensagens Flash -->
    <div class="container mt-3">
        <?php exibirMensagem(); ?>
    </div>
    
    <!-- Dashboard Header -->
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
                        <i class="fas fa-user"></i> <?php echo $_SESSION['nome_completo']; ?>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Content -->
    <section class="py-5">
        <div class="container">
            <!-- Quick Stats -->
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-check fa-3x mb-3"></i>
                            <h3 class="card-title"><?php echo $stats['total_agendamentos']; ?></h3>
                            <p class="card-text">Total de Agendamentos</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope fa-3x mb-3"></i>
                            <h3 class="card-title"><?php echo $stats['total_contatos']; ?></h3>
                            <p class="card-text">Mensagens Recebidas</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-3x mb-3"></i>
                            <h3 class="card-title"><?php echo $stats['pendentes']; ?></h3>
                            <p class="card-text">Pendentes</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <h3 class="card-title"><?php echo $stats['confirmados']; ?></h3>
                            <p class="card-text">Confirmados</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Appointments -->
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
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Paciente</th>
                                                <th>Data/Hora</th>
                                                <th>Serviço</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($agendamentos as $agendamento): ?>
                                            <tr>
                                                <td>
                                                    <strong><?php echo htmlspecialchars($agendamento['nome_paciente']); ?></strong><br>
                                                    <small class="text-muted"><?php echo htmlspecialchars($agendamento['email_paciente']); ?></small>
                                                </td>
                                                <td>
                                                    <?php echo date('d/m/Y', strtotime($agendamento['data_agendamento'])); ?><br>
                                                    <small><?php echo date('H:i', strtotime($agendamento['hora_agendamento'])); ?></small>
                                                </td>
                                                <td><?php echo htmlspecialchars($agendamento['tipo_servico']); ?></td>
                                                <td>
                                                    <?php
                                                    $status_class = '';
                                                    $status_text = '';
                                                    switch($agendamento['status']) {
                                                        case 'pendente':
                                                            $status_class = 'bg-warning';
                                                            $status_text = 'Pendente';
                                                            break;
                                                        case 'confirmado':
                                                            $status_class = 'bg-success';
                                                            $status_text = 'Confirmado';
                                                            break;
                                                        case 'cancelado':
                                                            $status_class = 'bg-danger';
                                                            $status_text = 'Cancelado';
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-outline-primary" title="Ver detalhes" 
                                                                onclick="verDetalhes(<?php echo $agendamento['id']; ?>)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <?php if ($agendamento['status'] == 'pendente'): ?>
                                                        <button class="btn btn-outline-success" title="Confirmar"
                                                                onclick="alterarStatus(<?php echo $agendamento['id']; ?>, 'confirmado')">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <?php endif; ?>
                                                        <button class="btn btn-outline-danger" title="Cancelar"
                                                                onclick="alterarStatus(<?php echo $agendamento['id']; ?>, 'cancelado')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Nenhum agendamento encontrado</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Messages -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-envelope"></i> Mensagens Recentes
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($contatos)): ?>
                                <?php foreach ($contatos as $contato): ?>
                                <div class="border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1"><?php echo htmlspecialchars($contato['nome']); ?></h6>
                                            <p class="mb-1 small"><?php echo htmlspecialchars($contato['assunto']); ?></p>
                                            <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($contato['criado_em'])); ?></small>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary" title="Ver mensagem"
                                                onclick="verMensagem(<?php echo $contato['id']; ?>)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <p class="mb-0 small text-muted mt-2">
                                        <?php 
                                        $mensagem = htmlspecialchars($contato['mensagem']);
                                        echo strlen($mensagem) > 100 ? substr($mensagem, 0, 100) . '...' : $mensagem;
                                        ?>
                                    </p>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-envelope-open fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Nenhuma mensagem encontrada</p>
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
                    <p class="mb-1">Curitba, PR - CEP 01234-567</p>
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
    <!-- JavaScript Personalizado -->
    <script src="script.js"></script>
    
    <script>
    // Funções JavaScript para o dashboard
    function verDetalhes(id) {
        alert('Ver detalhes do agendamento #' + id);
        // Implementar modal ou redirecionamento
    }
    
    function alterarStatus(id, novoStatus) {
        if (confirm('Confirma a alteração do status?')) {
            // Implementar AJAX para alterar status
            window.location.href = 'alterar_status.php?id=' + id + '&status=' + novoStatus;
        }
    }
    
    function verMensagem(id) {
        alert('Ver mensagem #' + id);
        // Implementar modal ou redirecionamento
    }
    </script>
</body>
</html>