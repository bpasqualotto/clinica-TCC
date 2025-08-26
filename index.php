<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Médica VivaMed - Cuidando da sua saúde</title>
    
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
    
    <!-- Seção Hero -->
    <section class="hero-section bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        Cuidando da sua saúde com excelência
                    </h1>
                    <p class="lead mb-4">
                        Há mais de 20 anos oferecendo cuidados médicos de qualidade com uma equipe especializada e tecnologia de ponta.
                    </p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                            <i class="fas fa-calendar-plus"></i> Agendar Consulta
                        </button>
                        <a href="contato.php" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-phone"></i> Entrar em Contato
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-hospital-alt" style="font-size: 200px; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Prévia dos Serviços -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">Nossas Especialidades</h2>
                    <p class="lead">Atendimento especializado em diversas áreas da medicina</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-heartbeat text-danger mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Cardiologia</h5>
                            <p class="card-text">Cuidados especializados para o seu coração com equipamentos modernos.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-baby text-info mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Pediatria</h5>
                            <p class="card-text">Cuidado especial para crianças e adolescentes com carinho e atenção.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-user-md text-success mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Clínica Geral</h5>
                            <p class="card-text">Atendimento geral para toda a família com médicos experientes.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-bone text-warning mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Ortopedia</h5>
                            <p class="card-text">Tratamento especializado para problemas ósseos e articulares.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-female text-pink mb-3" style="font-size: 3rem; color: #e91e63;"></i>
                            <h5 class="card-title">Ginecologia</h5>
                            <p class="card-text">Cuidados especializados para a saúde da mulher em todas as fases.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-allergies text-purple mb-3" style="font-size: 3rem; color: #9c27b0;"></i>
                            <h5 class="card-title">Dermatologia</h5>
                            <p class="card-text">Cuidados especializados para a saúde da sua pele.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="servicos.php" class="btn btn-primary btn-lg">
                        Ver Todos os Serviços <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Por que escolher nossa clínica -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">Por que escolher nossa clínica?</h2>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <i class="fas fa-award text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5>Excelência Médica</h5>
                    <p>Médicos especialistas com ampla experiência e formação continuada.</p>
                </div>
                
                <div class="col-md-3 text-center">
                    <i class="fas fa-clock text-success mb-3" style="font-size: 3rem;"></i>
                    <h5>Pontualidade</h5>
                    <p>Respeito ao seu tempo com agendamentos precisos e atendimento pontual.</p>
                </div>
                
                <div class="col-md-3 text-center">
                    <i class="fas fa-microscope text-info mb-3" style="font-size: 3rem;"></i>
                    <h5>Tecnologia Avançada</h5>
                    <p>Equipamentos modernos para diagnósticos precisos e tratamentos eficazes.</p>
                </div>
                
                <div class="col-md-3 text-center">
                    <i class="fas fa-heart text-danger mb-3" style="font-size: 3rem;"></i>
                    <h5>Atendimento Humanizado</h5>
                    <p>Cuidado personalizado com foco no bem-estar e conforto do paciente.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Emergências -->
    <section class="py-5 bg-danger text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3><i class="fas fa-ambulance"></i> Emergências 24 horas</h3>
                    <p class="mb-0">Atendimento de urgência e emergência disponível 24 horas por dia, 7 dias por semana.</p>
                </div>
                <div class="col-md-4 text-center">
                    <a href="tel:+551199999999" class="btn btn-light btn-lg">
                        <i class="fas fa-phone"></i> (41) 99874-6633
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Informações de Contato -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-map-marker-alt text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5>Localização</h5>
                    <p>Rua das Flores, 123<br>
                    Curitiba, PR - CEP 01234-567</p>
                </div>
                
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-phone text-success mb-3" style="font-size: 3rem;"></i>
                    <h5>Telefone</h5>
                    <p>(41) 3456-7890<br>
                    WhatsApp: (41) 99874-6633</p>
                </div>
                
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-clock text-info mb-3" style="font-size: 3rem;"></i>
                    <h5>Horário</h5>
                    <p>Segunda a Sexta: 7h às 19h<br>
                    Sábado: 8h às 14h</p>
                </div>
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
                    <p class="mb-1">Curitiba, PR - CEP 01234-567</p>
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


