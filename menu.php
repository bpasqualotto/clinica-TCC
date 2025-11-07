<?php
// Menu reutilizável – garante sessão e funções globais
require_once __DIR__ . '/config.php';

// 🔒 Trava anti-duplicação: se já renderizou o menu, não imprime de novo
if (defined('MENU_RENDERED')) return;
define('MENU_RENDERED', true);

// Sessões / helpers
if (!function_exists('estaLogado')) {
    function estaLogado(): bool { return isset($_SESSION['usuario_id']); } // admin/staff
}
if (!function_exists('estaLogadoPaciente')) {
    function estaLogadoPaciente(): bool { return isset($_SESSION['paciente_id']); }
}

// Página atual para marcar "active"
$__ATUAL = basename($_SERVER['PHP_SELF'] ?? '');
?>
<!-- Menu de Navegação Reutilizável -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="fas fa-hospital-alt me-2"></i>
            Clínica Médica VivaMed
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Esquerda -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='index.php' ? 'active' : '' ?>" href="index.php">
                        <i class="fas fa-home"></i> Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='servicos.php' ? 'active' : '' ?>" href="servicos.php">
                        <i class="fas fa-stethoscope"></i> Serviços
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='sobre.php' ? 'active' : '' ?>" href="sobre.php">
                        <i class="fas fa-info-circle"></i> Sobre
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='contato.php' ? 'active' : '' ?>" href="contato.php">
                        <i class="fas fa-envelope"></i> Contato
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='reclamacao.php' ? 'active' : '' ?>" href="reclamacao.php">
                        <i class="fas fa-exclamation-triangle"></i> Reclamação
                    </a>
                </li>
            </ul>

            <!-- Direita -->
            <ul class="navbar-nav">
                <?php if (estaLogado()): ?>
                    <!-- Admin/Staff logado -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-shield"></i>
                            <?= htmlspecialchars($_SESSION['usuario'] ?? 'Usuário') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="dashboard.php">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php elseif (estaLogadoPaciente()): ?>
                    <!-- Paciente logado -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= ($__ATUAL==='paciente_dashboard.php') ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                            <?= htmlspecialchars($_SESSION['paciente_nome'] ?? 'Paciente') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="paciente_dashboard.php">
                                    <i class="fas fa-user-circle"></i> Minha conta
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="paciente_logout.php">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php else: ?>
                    <!-- Ninguém logado -->
                    <li class="nav-item">
                        <a class="nav-link <?= $__ATUAL==='login.php' ? 'active' : '' ?>" href="login.php">
                            <i class="fas fa-sign-in-alt"></i> Login (Admin)
                        </a>
                    </li>

                    <!-- REMOVIDO: Criar conta (Admin) público -->
                    <!-- <li class="nav-item">
                        <a class="nav-link <?= $__ATUAL==='registro.php' ? 'active' : '' ?>" href="registro.php">
                            <i class="fas fa-user-plus"></i> Criar conta (Admin)
                        </a>
                    </li> -->

                    <!-- Área do Paciente + Criar Conta (Paciente) -->
                    <li class="nav-item">
                        <a class="nav-link <?= ($__ATUAL==='paciente_login.php') ? 'active' : '' ?>"
                           href="paciente_login.php">
                            <i class="fas fa-user"></i> Área do Paciente
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($__ATUAL==='paciente_registro.php') ? 'active' : '' ?>"
                           href="paciente_registro.php">
                            <i class="fas fa-user-plus"></i> Criar conta (Paciente)
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Agendar como página (sem modal) -->
                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='agendar.php' ? 'active' : '' ?> btn btn-success ms-2 px-3"
                       href="agendar.php">
                        <i class="fas fa-calendar-plus"></i> Agendar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
