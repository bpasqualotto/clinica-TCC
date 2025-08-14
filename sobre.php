<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - Clínica Médica VivaMed</title>
    
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
                        <i class="fas fa-info-circle"></i> Sobre Nossa Clínica
                    </h1>
                    <p class="lead">Conheça nossa história, missão e compromisso com a sua saúde</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Conteúdo Sobre -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="text-primary mb-4">Nossa História</h2>
                    <p class="lead">
                        Fundada em 2023, a Clínica Médica VivaMed nasceu do sonho de oferecer cuidados médicos 
                        de excelência com atendimento humanizado e acessível para toda a comunidade.
                    </p>
                    <p>
                        Ao longo do tempo estamos crescendo e evoluindo constantemente, sempre mantendo nossos 
                        valores fundamentais: qualidade, ética, respeito e dedicação ao bem-estar dos nossos pacientes.
                    </p>
                    <p>
                        Hoje, contamos com uma equipe multidisciplinar altamente qualificada e equipamentos de 
                        última geração, proporcionando diagnósticos precisos e tratamentos eficazes.
                    </p>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-hospital text-primary" style="font-size: 250px; opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Missão, Visão, Valores -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-bullseye text-primary mb-3" style="font-size: 3rem;"></i>
                            <h4 class="text-primary">Missão</h4>
                            <p class="card-text">
                                Promover saúde e bem-estar através de atendimento médico de qualidade, 
                                com foco na prevenção, diagnóstico preciso e tratamento humanizado.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-eye text-success mb-3" style="font-size: 3rem;"></i>
                            <h4 class="text-success">Visão</h4>
                            <p class="card-text">
                                Ser reconhecida como referência em cuidados médicos na região, 
                                destacando-se pela excelência técnica e atendimento diferenciado.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-heart text-danger mb-3" style="font-size: 3rem;"></i>
                            <h4 class="text-danger">Valores</h4>
                            <p class="card-text">
                                Ética profissional, respeito ao paciente, compromisso com a qualidade, 
                                atualização constante e responsabilidade social.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nossa Equipe -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 text-primary">Nossa Equipe Médica</h2>
                    <p class="lead">Profissionais altamente qualificados dedicados ao seu bem-estar</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-user-md text-primary mb-3" style="font-size: 4rem;"></i>
                            <h5 class="card-title">Dra. Gabriela Pasqualotto</h5>
                            <p class="text-muted">Cardiologista</p>
                            <p class="card-text">CRM 12345 - PR</p>
                            <p class="small">Especialista em cardiologia com mais de 15 anos de experiência.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-user-md text-success mb-3" style="font-size: 4rem;"></i>
                            <h5 class="card-title">Dra. Nicole Azevedo</h5>
                            <p class="text-muted">Pediatra</p>
                            <p class="card-text">CRM 23456 - PR</p>
                            <p class="small">Especialista em pediatria com foco em desenvolvimento infantil.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-user-md text-info mb-3" style="font-size: 4rem;"></i>
                            <h5 class="card-title">Dr. Carlos Lima</h5>
                            <p class="text-muted">Clínico Geral</p>
                            <p class="card-text">CRM 34567 - PR</p>
                            <p class="small">Médico generalista com ampla experiência em medicina preventiva.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-user-md text-warning mb-3" style="font-size: 4rem;"></i>
                            <h5 class="card-title">Dra. Ana Costa</h5>
                            <p class="text-muted">Ginecologista</p>
                            <p class="card-text">CRM 45678 - PR</p>
                            <p class="small">Especialista em saúde da mulher com foco em prevenção.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Infraestrutura -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 text-primary">Infraestrutura</h2>
                    <p class="lead">Instalações modernas e equipamentos de última geração</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center">
                    <i class="fas fa-procedures text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5>Consultórios Modernos</h5>
                    <p>Ambientes climatizados e equipados para seu conforto.</p>
                </div>
                
                <div class="col-md-6 col-lg-3 text-center">
                    <i class="fas fa-microscope text-success mb-3" style="font-size: 3rem;"></i>
                    <h5>Laboratório Próprio</h5>
                    <p>Exames laboratoriais com resultados rápidos e precisos.</p>
                </div>
                
                <div class="col-md-6 col-lg-3 text-center">
                    <i class="fas fa-x-ray text-info mb-3" style="font-size: 3rem;"></i>
                    <h5>Equipamentos Digitais</h5>
                    <p>Tecnologia avançada para diagnósticos precisos.</p>
                </div>
                
                <div class="col-md-6 col-lg-3 text-center">
                    <i class="fas fa-wheelchair text-warning mb-3" style="font-size: 3rem;"></i>
                    <h5>Acessibilidade Total</h5>
                    <p>Instalações adaptadas para pessoas com mobilidade reduzida.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Certificações de Qualidade -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 text-primary">Certificações e Qualidade</h2>
                    <p class="lead">Compromisso com a excelência e qualidade reconhecida</p>
                </div>
            </div>
            
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <i class="fas fa-certificate text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5>ISO 9001</h5>
                    <p>Certificação de qualidade em gestão e atendimento.</p>
                </div>
                
                <div class="col-md-3">
                    <i class="fas fa-shield-alt text-success mb-3" style="font-size: 3rem;"></i>
                    <h5>ANVISA</h5>
                    <p>Licenciado e regulamentado pela Agência Nacional de Vigilância Sanitária.</p>
                </div>
                
                <div class="col-md-3">
                    <i class="fas fa-star text-warning mb-3" style="font-size: 3rem;"></i>
                    <h5>CRM Regional</h5>
                    <p>Todos os médicos registrados no Conselho Regional de Medicina.</p>
                </div>
                
                <div class="col-md-3">
                    <i class="fas fa-award text-info mb-3" style="font-size: 3rem;"></i>
                    <h5>Prêmio Qualidade</h5>
                    <p>Reconhecimento pela excelência em atendimento médico.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Chamada para Ação -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h3 class="mb-4">Venha conhecer nossa clínica!</h3>
            <p class="lead mb-4">
                Agende uma visita ou consulta e experimente o diferencial do nosso atendimento.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#agendamentoModal">
                    <i class="fas fa-calendar-plus"></i> Agendar Consulta
                </button>
                <a href="contato.php" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-map-marker-alt"></i> Como Chegar
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
                    <p class="mb-1"><i class="fas fa-whatsapp"></i> (41) 99874-5523</p>
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
                    <p class="mb-0">&copy; 2025 Clínica Médica VivaMed. Todos os direitos reservados.</p>
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

