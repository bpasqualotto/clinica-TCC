<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços - Clínica Médica VivaMed</title>
    
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
    
    <!-- Mensagens Flash -->
    <div class="container mt-3">
        <?php exibirMensagem(); ?>
    </div>
    
    <!-- Cabeçalho da Página -->
    <section class="bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">
                        <i class="fas fa-stethoscope"></i> Nossos Serviços
                    </h1>
                    <p class="lead">Cuidados médicos especializados para toda a família</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Grade de Serviços -->
    <section class="py-5">
        <div class="container">
            <!-- Consultas Médicas -->
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="text-primary mb-4">
                        <i class="fas fa-user-md"></i> Consultas Médicas
                    </h2>
                </div>
            </div>
            
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-user-md text-success" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">Clínica Geral</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Consultas de rotina</li>
                                <li><i class="fas fa-check text-success"></i> Check-ups preventivos</li>
                                <li><i class="fas fa-check text-success"></i> Atestados médicos</li>
                                <li><i class="fas fa-check text-success"></i> Orientações de saúde</li>
                            </ul>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                                Agendar Consulta
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-heartbeat text-danger" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">Cardiologia</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Eletrocardiograma</li>
                                <li><i class="fas fa-check text-success"></i> Ecocardiograma</li>
                                <li><i class="fas fa-check text-success"></i> Teste ergométrico</li>
                                <li><i class="fas fa-check text-success"></i> Holter 24h</li>
                            </ul>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                                Agendar Consulta
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-baby text-info" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">Pediatria</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Puericultura</li>
                                <li><i class="fas fa-check text-success"></i> Vacinação</li>
                                <li><i class="fas fa-check text-success"></i> Desenvolvimento infantil</li>
                                <li><i class="fas fa-check text-success"></i> Consultas de emergência</li>
                            </ul>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                                Agendar Consulta
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-female" style="font-size: 3rem; color: #e91e63;"></i>
                            </div>
                            <h5 class="card-title">Ginecologia</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Consultas preventivas</li>
                                <li><i class="fas fa-check text-success"></i> Papanicolau</li>
                                <li><i class="fas fa-check text-success"></i> Ultrassom transvaginal</li>
                                <li><i class="fas fa-check text-success"></i> Planejamento familiar</li>
                            </ul>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                                Agendar Consulta
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-bone text-warning" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">Ortopedia</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Fraturas e luxações</li>
                                <li><i class="fas fa-check text-success"></i> Problemas articulares</li>
                                <li><i class="fas fa-check text-success"></i> Dores nas costas</li>
                                <li><i class="fas fa-check text-success"></i> Medicina esportiva</li>
                            </ul>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                                Agendar Consulta
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-allergies" style="font-size: 3rem; color: #9c27b0;"></i>
                            </div>
                            <h5 class="card-title">Dermatologia</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Consultas dermatológicas</li>
                                <li><i class="fas fa-check text-success"></i> Dermatoscopia</li>
                                <li><i class="fas fa-check text-success"></i> Tratamento de acne</li>
                                <li><i class="fas fa-check text-success"></i> Prevenção do câncer de pele</li>
                            </ul>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                                Agendar Consulta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Exames -->
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="text-primary mb-4">
                        <i class="fas fa-microscope"></i> Exames e Diagnósticos
                    </h2>
                </div>
            </div>
            
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-vial text-info"></i> Exames Laboratoriais
                            </h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Hemograma completo</li>
                                <li><i class="fas fa-check text-success"></i> Bioquímica sanguínea</li>
                                <li><i class="fas fa-check text-success"></i> Exames de urina</li>
                                <li><i class="fas fa-check text-success"></i> Hormônios</li>
                                <li><i class="fas fa-check text-success"></i> Coleta domiciliar disponível</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-x-ray text-warning"></i> Exames de Imagem
                            </h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Ultrassonografia</li>
                                <li><i class="fas fa-check text-success"></i> Raio-X digital</li>
                                <li><i class="fas fa-check text-success"></i> Ecocardiograma</li>
                                <li><i class="fas fa-check text-success"></i> Eletrocardiograma</li>
                                <li><i class="fas fa-check text-success"></i> Resultados em até 24h</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Procedimentos -->
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="text-primary mb-4">
                        <i class="fas fa-procedures"></i> Procedimentos
                    </h2>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-syringe text-success mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Vacinação</h5>
                            <p class="card-text">Vacinas para crianças e adultos conforme calendário nacional.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-cut text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Pequenas Cirurgias</h5>
                            <p class="card-text">Procedimentos cirúrgicos ambulatoriais simples.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-band-aid text-warning mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Curativos</h5>
                            <p class="card-text">Cuidados com ferimentos e curativos especializados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chamada para Ação -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3 class="mb-4">Precisa de atendimento médico?</h3>
            <p class="lead mb-4">Agende sua consulta e cuide da sua saúde com quem entende do assunto.</p>
            <div class="d-flex justify-content-center gap-3">
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                    <i class="fas fa-calendar-plus"></i> Agendar Consulta
                </button>
                <a href="contato.php" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-phone"></i> Entrar em Contato
                </a>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="bg-primary text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-hospital-alt"></i> Clínica Médica VivaMed</h5>
                    <p class="mb-1"><i class="fas fa-map-marker-alt"></i> Rua das Flores, 123</p>
                    <p class="mb-1">Curitba, PR - CEP 01234-567</p>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                    <p class="mb-1"><i class="fas fa-phone"></i> (41) 3456-7890</p>
                    <p class="mb-1"><i class="fas fa-envelope"></i> contato@clinicavivamed.com.br</p>
                    <p class="mb-1"><i class="fas fa-whatsapp"></i> (41) 99874-6633</p>
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
