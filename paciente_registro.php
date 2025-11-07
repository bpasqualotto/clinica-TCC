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
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $tel   = trim($_POST['telefone'] ?? '');
    $nasc  = trim($_POST['nascimento'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $conf  = $_POST['confirmacao'] ?? '';

    $erros = [];
    if ($nome==='') $erros[]='Informe o nome.';
    if ($email==='' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[]='E-mail inválido.';
    if (strlen($senha)<6) $erros[]='Senha mínima de 6 caracteres.';
    if ($senha!==$conf) $erros[]='Confirmação de senha não confere.';

    if (!$erros) {
        $st = $pdo->prepare("SELECT id FROM pacientes WHERE email=? LIMIT 1");
        $st->execute([$email]);
        if ($st->fetch()) $erros[]='Já existe cadastro com este e-mail.';
    }

    if (!$erros) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $st = $pdo->prepare("INSERT INTO pacientes (nome,email,senha,telefone,nascimento) VALUES (?,?,?,?,NULLIF(?,''))");
        $st->execute([$nome,$email,$hash,$tel,$nasc]);
        $_SESSION['mensagem']='Conta criada! Faça login.';
        $_SESSION['tipo_mensagem']='sucesso';
        header('Location: paciente_login.php'); exit;
    } else {
        $_SESSION['mensagem']=implode(' ',$erros);
        $_SESSION['tipo_mensagem']='erro';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Criar conta do paciente</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
<?php require_once __DIR__ . '/menu.php'; ?>
<div class="container" style="max-width:600px;">
  <h1 class="mt-4"><i class="fa-solid fa-user-plus me-2"></i> Cadastro do paciente</h1>
  <?php flash_show(); ?>
  <div class="card shadow-sm mt-3"><div class="card-body">
    <form method="post" action="paciente_registro.php" novalidate>
      <div class="mb-3"><label class="form-label">Nome completo</label>
        <input name="nome" class="form-control" required></div>
      <div class="mb-3"><label class="form-label">E-mail</label>
        <input name="email" type="email" class="form-control" required></div>
      <div class="mb-3"><label class="form-label">Telefone</label>
        <input name="telefone" class="form-control" placeholder="(xx) xxxxx-xxxx"></div>
      <div class="mb-3"><label class="form-label">Data de nascimento</label>
        <input name="nascimento" type="date" class="form-control"></div>
      <div class="mb-3"><label class="form-label">Senha</label>
        <input name="senha" type="password" class="form-control" minlength="6" required></div>
      <div class="mb-3"><label class="form-label">Confirmar senha</label>
        <input name="confirmacao" type="password" class="form-control" required></div>
      <button class="btn btn-primary w-100"><i class="fa fa-check me-1"></i> Criar conta</button>
    </form>
    <p class="text-center mt-3 mb-0">Já tem conta? <a href="paciente_login.php">Entrar</a></p>
  </div></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
