<?php
require_once __DIR__ . '/config.php';

/**
 * Login de usuários (password_verify)
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        flash('Informe e-mail e senha.', 'erro');
    } else {
        $stmt = $pdo->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['usuario_id'] = (int)$user['id'];
            $_SESSION['usuario']    = $user['nome'];
            flash('Login realizado com sucesso!', 'sucesso');
            header('Location: dashboard.php');
            exit;
        } else {
            flash('Credenciais inválidas.', 'erro');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - VivaMed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          referrerpolicy="no-referrer" />
</head>
<body>
<?php require_once __DIR__ . '/menu.php'; ?>

<div class="container" style="max-width: 480px;">
    <h1 class="mt-4"><i class="fas fa-sign-in-alt me-2"></i> Login</h1>
    <?php flash_show(); ?>
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <form method="post" action="login.php" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-door-open me-1"></i> Entrar
                </button>
            </form>
        </div>
    </div>

    <p class="text-center mt-3">
        Não tem conta? <a href="registro.php">Criar conta</a>
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
