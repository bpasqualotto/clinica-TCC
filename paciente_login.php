<?php
require_once __DIR__ . '/config.php';

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

function flash_show() {
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($email === '' || $senha === '') {
        $_SESSION['mensagem'] = 'Informe e-mail e senha.'; $_SESSION['tipo_mensagem'] = 'erro';
    } else {
        $st = $pdo->prepare("SELECT id, nome, email, senha FROM pacientes WHERE email = ? LIMIT 1");
        $st->execute([$email]);
        $pac = $st->fetch();
        if ($pac && password_verify($senha, $pac['senha'])) {
            $_SESSION['paciente_id']    = (int)$pac['id'];
            $_SESSION['paciente_nome']  = $pac['nome'];
            $_SESSION['paciente_email'] = $pac['email'];
            header('Location: paciente_dashboard.php'); exit;
        } else {
            $_SESSION['mensagem'] = 'Credenciais inválidas.'; $_SESSION['tipo_mensagem'] = 'erro';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login do paciente</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
<?php require_once __DIR__ . '/menu.php'; ?>

<div class="container" style="max-width:520px;">
  <h1 class="mt-4"><i class="fa-solid fa-user me-2"></i> Área do paciente</h1>
  <?php flash_show(); ?>

  <div class="card shadow-sm mt-3">
    <div class="card-body">
      <form method="post" action="paciente_login.php" novalidate>
        <div class="mb-3">
          <label class="form-label">E-mail</label>
          <input name="email" type="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Senha</label>
          <input name="senha" type="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">
          <i class="fa fa-door-open me-1"></i> Entrar
        </button>

        <div class="d-flex justify-content-between mt-3">
          <a class="btn btn-link p-0" href="paciente_esqueci.php">
            <i class="fa-solid fa-key me-1"></i> Esqueci minha senha
          </a>
          <a class="btn btn-outline-secondary btn-sm" href="paciente_registro.php">
            <i class="fa-solid fa-user-plus me-1"></i> Criar conta
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
