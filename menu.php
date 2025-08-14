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
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                        <i class="fas fa-home"></i> Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'servicos.php' ? 'active' : ''; ?>" href="servicos.php">
                        <i class="fas fa-stethoscope"></i> Serviços
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'sobre.php' ? 'active' : ''; ?>" href="sobre.php">
                        <i class="fas fa-info-circle"></i> Sobre
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contato.php' ? 'active' : ''; ?>" href="contato.php">
                        <i class="fas fa-envelope"></i> Contato
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <?php if (estaLogado()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> <?php echo $_SESSION['usuario']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Sair
                            </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                <?php endif; ?>
                
                <li class="nav-item">
                    <a class="nav-link btn btn-success ms-2 px-3" href="#" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                        <i class="fas fa-calendar-plus"></i> Agendar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal de Agendamento -->
<div class="modal fade" id="agendamentoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-plus"></i> Agendar Consulta
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="agendar.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nome_paciente" class="form-label">Nome Completo *</label>
                            <input type="text" class="form-control" id="nome_paciente" name="nome_paciente" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email_paciente" class="form-label">E-mail *</label>
                            <input type="email" class="form-control" id="email_paciente" name="email_paciente" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefone_paciente" class="form-label">Telefone *</label>
                            <input type="tel" class="form-control" id="telefone_paciente" name="telefone_paciente" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tipo_servico" class="form-label">Tipo de Consulta *</label>
                            <select class="form-select" id="tipo_servico" name="tipo_servico" required>
                                <option value="">Selecione...</option>
                                <option value="Clínica Geral">Clínica Geral</option>
                                <option value="Cardiologia">Cardiologia</option>
                                <option value="Dermatologia">Dermatologia</option>
                                <option value="Ginecologia">Ginecologia</option>
                                <option value="Pediatria">Pediatria</option>
                                <option value="Ortopedia">Ortopedia</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="data_agendamento" class="form-label">Data Preferida *</label>
                            <input type="date" class="form-control" id="data_agendamento" name="data_agendamento" required min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hora_agendamento" class="form-label">Horário Preferido *</label>
                            <input type="time" class="form-control" id="hora_agendamento" name="hora_agendamento" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Observações</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="3" placeholder="Descreva seus sintomas ou informações adicionais..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Solicitar Agendamento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>