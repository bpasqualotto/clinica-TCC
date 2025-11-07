<?php
require_once __DIR__ . '/require_paciente_login.php'; // inclui config e valida sessão

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
    http_response_code(500);
    echo "<h1>Erro</h1><p>Falha ao conectar ao banco.</p>";
    exit;
}

// Busca agendamentos do paciente (por paciente_id; fallback por email)
$pacienteId = (int)($_SESSION['paciente_id'] ?? 0);
$pacienteEmail = $_SESSION['paciente_email'] ?? null;

$sql = "SELECT id, especialidade, data_agendamento, mensagem 
        FROM agendamentos WHERE ";
$params = [];
if ($pacienteId > 0) {
    $sql .= " paciente_id = ? ";
    $params[] = $pacienteId;
} else {
    $sql .= " email = ? ";
    $params[] = $pacienteEmail;
}
$sql .= " ORDER BY data_agendamento DESC LIMIT 50";
$ag = $pdo->prepare($sql);
$ag->execute($params);
$agendamentos = $ag->fetchAll();

// Busca exames
$ex = $pdo->prepare("SELECT id, tipo, data_exame, status FROM exames WHERE paciente_id = ? ORDER BY data_exame DESC LIMIT 50");
$ex->execute([$pacienteId]);
$exames = $ex->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Minha conta - Paciente</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
<?php require_once __DIR__ . '/menu.php'; ?>
<div class="container">
  <h1 class="mt-4"><i class="fa-solid fa-user-circle me-2"></i> Olá, <?php echo htmlspecialchars($_SESSION['paciente_nome']); ?></h1>

  <div class="row g-3 mt-2">
    <div class="col-md-4"><div class="card text-center shadow-sm"><div class="card-body">
      <div class="h3 mb-0"><?php echo count($agendamentos); ?></div>
      <div class="text-muted">Meus agendamentos</div>
    </div></div></div>
    <div class="col-md-4"><div class="card text-center shadow-sm"><div class="card-body">
      <div class="h3 mb-0"><?php echo count($exames); ?></div>
      <div class="text-muted">Meus exames</div>
    </div></div></div>
  </div>

  <h3 class="mt-4">Agendamentos</h3>
  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead><tr>
        <th>#</th><th>Especialidade</th><th>Data/Hora</th><th>Observação</th>
      </tr></thead>
      <tbody>
        <?php if (!$agendamentos): ?>
          <tr><td colspan="4" class="text-center text-muted">Nenhum agendamento.</td></tr>
        <?php else: foreach ($agendamentos as $r): ?>
          <tr>
            <td><?php echo (int)$r['id']; ?></td>
            <td><?php echo htmlspecialchars($r['especialidade'] ?? '-'); ?></td>
            <td><?php echo htmlspecialchars($r['data_agendamento']); ?></td>
            <td><?php echo htmlspecialchars($r['mensagem'] ?? ''); ?></td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>

  <h3 class="mt-4">Exames</h3>
  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead><tr>
        <th>#</th><th>Tipo</th><th>Data</th><th>Status</th>
      </tr></thead>
      <tbody>
        <?php if (!$exames): ?>
          <tr><td colspan="4" class="text-center text-muted">Nenhum exame.</td></tr>
        <?php else: foreach ($exames as $e): ?>
          <tr>
            <td><?php echo (int)$e['id']; ?></td>
            <td><?php echo htmlspecialchars($e['tipo']); ?></td>
            <td><?php echo htmlspecialchars($e['data_exame']); ?></td>
            <td><?php echo htmlspecialchars($e['status']); ?></td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
