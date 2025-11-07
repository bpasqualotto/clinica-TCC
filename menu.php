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

// Detecta página atual para marcar "active"
$__ATUAL = basename($_SERVER['PHP_SELF'] ?? 'index.php');
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

        <div id="navbarNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='index.php' ? 'active' : '' ?>" href="index.php">
                        Início
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='servicos.php' ? 'active' : '' ?>" href="servicos.php">
                        Serviços
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='sobre.php' ? 'active' : '' ?>" href="sobre.php">
                        Sobre
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $__ATUAL==='contato.php' || $__ATUAL==='reclamacao.php' ? 'active' : '' ?>" href="reclamacao.php">
                        Contato
                    </a>
                </li>

                <?php if (estaLogado() || estaLogadoPaciente()): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $__ATUAL==='agendar.php' ? 'active' : '' ?> btn btn-success ms-2 px-3"
                           href="agendar.php">
                            <i class="fas fa-calendar-plus"></i> Agendar
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (estaLogado()): ?>
                    <!-- Menu de usuário staff/admin -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($__ATUAL, ['dashboard.php','paciente.php','agenda.php']) ? 'active' : '' ?>"
                           href="#" id="admDrop" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Administração
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="admDrop">
                            <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                            <li><a class="dropdown-item" href="paciente.php">Pacientes</a></li>
                            <li><a class="dropdown-item" href="agenda.php">Agenda</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (estaLogadoPaciente()): ?>
                    <!-- Menu do paciente -->
                    <li class="nav-item">
                        <a class="nav-link <?= $__ATUAL==='paciente_dashboard.php' ? 'active' : '' ?>"
                           href="paciente_dashboard.php">Minha Área</a>
                    </li>
                <?php endif; ?>

                <!-- Login / Logout -->
                <?php if (!estaLogado() && !estaLogadoPaciente()): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $__ATUAL==='paciente_login.php' ? 'active' : '' ?> btn btn-outline-light ms-lg-3"
                           href="paciente_login.php">Entrar</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light ms-lg-3" href="logout.php">Sair</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
