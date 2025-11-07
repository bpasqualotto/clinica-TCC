<?php
require_once __DIR__ . '/config.php';
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(403);
    exit('Acesso restrito aos administradores.');
}

<?php
require_once __DIR__ . '/config.php';

/**
 * Página de cadastro (criar conta)
 */

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
    echo "<h1>Erro de conexão</h1><p>Não foi possível conectar ao banco de dados.</p>";
    if (ini_get('display_errors')) {
        echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    }
    exit;
}

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

$erros = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome']  ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $conf  = $_POST['confirmacao'] ?? '';

    if ($nome === '')   $erros[] = 'Informe seu nome.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'Informe um e-mail válido.';
    if (strlen($senha) < 6) $erros[] = 'A senha deve ter ao menos 6 caracteres.';
    if ($senha !== $conf) $erros[] = 'A confirmação de senha não confere.';

    if (!$erros) {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $erros[] = 'Já existe uma conta com este e-mail.';
        }
    }

    if (!$erros) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $hash]);
        flash('Conta criada com sucesso! Você já pode fazer login.', 'sucesso');
        header('Location: login.php');
        exit;
    } else {
        flash(implode(' ', $erros), 'erro');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta - VivaMed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          referrerpolicy="no-referrer" />
</head>
<body>
<?php require_once __DIR__ . '/menu.php'; ?>

<div class="container" style="max-width: 560px;">
    <h1 class="mt-4"><i class="fas fa-user-plus me-2"></i> Criar conta</h1>
    <?php flash_show(); ?>
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <form method="post" action="registro.php" novalidate>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" minlength="6" required>
                    <div class="form-text">Mínimo de 6 caracteres.</div>
                </div>
                <div class="mb-3">
                    <label for="confirmacao" class="form-label">Confirmar senha</label>
                    <input type="password" id="confirmacao" name="confirmacao" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-check-circle me-1"></i> Criar conta
                </button>
            </form>
        </div>
    </div>

    <p class="text-center mt-3">
        Já tem conta? <a href="login.php">Entrar</a>
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
