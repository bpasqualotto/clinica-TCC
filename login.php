<?php
require_once 'config.php';

// Processar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    
    if (empty($usuario) || empty($senha)) {
        definirMensagem('Por favor, preencha todos os campos.', 'erro');
    } else {
        try {
            $pdo = conectarBanco();
            $sql = "SELECT * FROM usuarios WHERE usuario = ? AND ativo = 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$usuario]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($senha, $user['senha_hash'])) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['cargo'] = $user['cargo'];
                $_SESSION['nome_completo'] = $user['nome_completo'];
                
                definirMensagem("Bem-vindo, {$user['nome_completo']}!", 'sucesso');
                redirecionar('dashboard.php');
            } else {
                definirMensagem('Credenciais inválidas.', 'erro');
            }
        } catch (Exception $e) {
            definirMensagem('Erro no sistema. Tente novamente.', 'erro');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clínica Médica VivaMed</title>
    
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
    
    <!-- Login Form -->
    <div class="container py-5">
        <!-- Mensagens Flash -->
        <?php exibirMensagem(); ?>
        
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user-md"></i> Login da Clínica
                        </h4>
                    </div>
                    
                    <div class="card-body p-4">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">
                                    <i class="fas fa-user"></i> Usuário
                                </label>
                                <input type="text" class="form-control" id="usuario" name="usuario" 
                                       placeholder="Digite seu usuário" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="senha" class="form-label">
                                    <i class="fas fa-lock"></i> Senha
                                </label>
                                <input type="password" class="form-control" id="senha" name="senha" 
                                       placeholder="Digite sua senha" required>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> Entrar
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="card-footer text-center text-muted">
                        <small>
                            <i class="fas fa-shield-alt"></i> Acesso restrito a funcionários
                        </small>
                    </div>
                </div>
                
                <!-- Credenciais de demonstração -->
                <div class="alert alert-info mt-3">
                    <h6><i class="fas fa-info-circle"></i> Credenciais de demonstração:</h6>
                    <strong>Usuário:</strong> admin<br>
                    <strong>Senha:</strong> admin123
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="bg-primary text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-hospital-alt"></i> Clínica Médica VivaMed</h5>
                    <p class="mb-1"><i class="fas fa-map-marker-alt"></i> Rua das Flores, 123</p>
                    <p class="mb-1">Curitiba, PR - CEP 01234-567</p>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                    <p class="mb-1"><i class="fas fa-phone"></i> (41) 3456-7890</p>
                    <p class="mb-1"><i class="fas fa-envelope"></i> contato@clinicavivamed.com.br</p>
                    <p class="mb-1"><i class="fas fa-whatsapp"></i> (41) 99997-1693</p>
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
</body>

</html>
