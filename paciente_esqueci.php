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
    $nova  = $_POST['nova'] ?? '';
    $conf  = $_POST['conf'] ?? '';

    $erros = [];
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'Informe um e-mail válido.';
    if (strlen($nova) < 6) $erros[] = 'A nova senha deve ter pelo menos 6 caracteres.';
    if ($nova !== $conf)  $erros[] = 'A confirmação de senha não confere.';

    if (!$erros) {
        $st = $pdo->prepare("SELECT id FROM pacientes WHERE email = ? LIMIT 1");
        $st->execute([$email]);
        $p = $st->fetch();

        if (!$p) {
            $erros[] = 'Não encontramos cadastro com este e-mail.';
        } else {
            $hash = password_hash($nova, PASSWORD_DEFAULT);
            $up = $pdo->prepare("UPDATE pacientes SET senha = ? WHERE id = ?");
            $up->execute([$hash, (int)$p['id']]);
            $_SESSION['mensagem'] = 'Senha alterada com sucesso! Faça login.';
            $_SESSION['tipo_mensagem'] = 'sucesso';
            header('Location: paciente_login.php'); exit;
        }
    }

    if ($erros) {
        $_SESSION['mensagem'] = implode(' ', $erros);
        $_SESSION['tipo_mensagem'] = 'erro';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Esqueci minha senha - Paciente</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
<?php require_once __DIR__ . '/menu.php'; ?>

<div class="container" style="max-width:560px;">
  <h1 class="mt-4"><i class="fa-solid fa-key me-2"></i> Esqueci minha senha</h1>
  <?php flash_show(); ?>

  <div class="card shadow-sm mt-3">
    <div class="card-body">
      <form method="post" action="paciente_esqueci.php" novalidate>
        <div class="mb-3">
          <label class="form-label">E-mail do cadastro</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Nova senha</label>
          <input type="password" name="nova" class="form-control" minlength="6" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Confirmar nova senha</label>
          <input type="password" name="conf" class="form-control" minlength="6" required>
        </div>
        <button class="btn btn-primary w-100">
          <i class="fa-solid fa-check me-1"></i> Alterar senha
        </button>
        <div class="text-center mt-3">
          <a href="paciente_login.php" class="btn btn-link p-0">Voltar ao login</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
