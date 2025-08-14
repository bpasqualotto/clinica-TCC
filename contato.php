<?php
require_once 'config.php';

// Processar formulário de contato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');
    
    // Validar campos obrigatórios
    if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
        definirMensagem('Por favor, preencha todos os campos obrigatórios.', 'erro');
    } else {
        try {
            $pdo = conectarBanco();
            $sql = "INSERT INTO contatos (nome, email, telefone, assunto, mensagem) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $telefone, $assunto, $mensagem]);
            
            definirMensagem('Mensagem enviada com sucesso! Entraremos em contato em breve.', 'sucesso');
            redirecionar('contato.php');
        } catch (Exception $e) {
            definirMensagem('Erro ao enviar mensagem. Tente novamente.', 'erro');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Clínica Médica VivaMed</title>
    
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
                        <i class="fas fa-envelope"></i> Entre em Contato
                    </h1>
                    <p class="lead">Estamos aqui para ajudar você a cuidar da sua saúde</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Informações de Contato -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-phone-alt text-success mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Telefone</h5>
                            <p class="card-text">
                                <strong>(11) 3456-7890</strong><br>
                                Segunda a Sexta: 7h às 19h<br>
                                Sábado: 8h às 14h
                            </p>
                            <a href="tel:+551134567890" class="btn btn-success">
                                <i class="fas fa-phone"></i> Ligar Agora
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="fab fa-whatsapp text-success mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">WhatsApp</h5>
                            <p class="card-text">
                                <strong>(11) 99999-9999</strong><br>
                                Atendimento rápido para<br>
                                agendamentos e dúvidas
                            </p>
                            <a href="https://wa.me/5511999999999" class="btn btn-success" target="_blank">
                                <i class="fab fa-whatsapp"></i> Chamar no WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-envelope text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">E-mail</h5>
                            <p class="card-text">
                                <strong>contato@clinicasp.com.br</strong><br>
                                Resposta em até 24 horas<br>
                                para suas mensagens
                            </p>
                            <a href="mailto:contato@clinicasp.com.br" class="btn btn-primary">
                                <i class="fas fa-envelope"></i> Enviar E-mail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulário de Contato -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0 text-center">
                                <i class="fas fa-paper-plane"></i> Envie sua Mensagem
                            </h4>
                        </div>
                        
                        <div class="card-body p-4">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nome" class="form-label">
                                            <i class="fas fa-user"></i> Nome Completo *
                                        </label>
                                        <input type="text" class="form-control" id="nome" name="nome" 
                                               placeholder="Digite seu nome completo" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope"></i> E-mail *
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               placeholder="Digite seu e-mail" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="telefone" class="form-label">
                                            <i class="fas fa-phone"></i> Telefone
                                        </label>
                                        <input type="tel" class="form-control" id="telefone" name="telefone" 
                                               placeholder="(11) 99999-9999">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="assunto" class="form-label">
                                            <i class="fas fa-tag"></i> Assunto *
                                        </label>
                                        <select class="form-select" id="assunto" name="assunto" required>
                                            <option value="">Selecione o assunto...</option>
                                            <option value="Agendamento">Agendamento de Consulta</option>
                                            <option value="Informações">Informações sobre Serviços</option>
                                            <option value="Resultados">Resultados de Exames</option>
                                            <option value="Sugestão">Sugestões/Reclamações</option>
                                            <option value="Outros">Outros Assuntos</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="mensagem" class="form-label">
                                        <i class="fas fa-comment"></i> Mensagem *
                                    </label>
                                    <textarea class="form-control" id="mensagem" name="mensagem" rows="5" 
                                              placeholder="Digite sua mensagem ou dúvida..." required></textarea>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-paper-plane"></i> Enviar Mensagem
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Localização -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 text-primary">
                        <i class="fas fa-map-marker-alt"></i> Nossa Localização
                    </h2>
                    <p class="lead">Venha nos visitar! Estamos bem localizados e com fácil acesso</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-building"></i> Endereço
                            </h5>
                            <p class="card-text">
                                <strong>Clínica Médica VivaMed</strong><br>
                                Rua das Flores, 123<br>
                                Avenida Vicente Machado, Curitiba - PR<br>
                                CEP: 01234-567
                            </p>
                            
                            <h5 class="card-title mt-4">
                                <i class="fas fa-bus"></i> Como Chegar
                            </h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-subway text-primary"></i> Estação Vila Mariana (Linha Azul) - 5 min a pé</li>
                                <li><i class="fas fa-bus text-success"></i> Linhas de ônibus: 4110, 5174, 6003</li>
                                <li><i class="fas fa-car text-info"></i> Estacionamento próprio disponível</li>
                            </ul>
                            
                            <a href="https://maps.google.com" class="btn btn-primary" target="_blank">
                                <i class="fas fa-route"></i> Ver no Google Maps
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-clock"></i> Horários de Funcionamento
                            </h5>
                            
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td><strong>Segunda-feira</strong></td>
                                            <td>7:00 - 19:00</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Terça-feira</strong></td>
                                            <td>7:00 - 19:00</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Quarta-feira</strong></td>
                                            <td>7:00 - 19:00</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Quinta-feira</strong></td>
                                            <td>7:00 - 19:00</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sexta-feira</strong></td>
                                            <td>7:00 - 19:00</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sábado</strong></td>
                                            <td>8:00 - 14:00</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Domingo</strong></td>
                                            <td>Emergências</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Emergências:</strong> Aos domingos e feriados, atendemos apenas casos de emergência. Entre em contato pelo telefone.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 text-primary">
                        <i class="fas fa-question-circle"></i> Perguntas Frequentes
                    </h2>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Como agendar uma consulta?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Você pode agendar pelo telefone (11) 3456-7890, WhatsApp (11) 99999-9999, 
                                    ou através do botão "Agendar Consulta" em nosso site.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Quais convênios são aceitos?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Trabalhamos com os principais convênios do mercado. Entre em contato para verificar 
                                    se seu plano de saúde é aceito em nossa clínica.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Preciso fazer jejum para exames?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Depende do tipo de exame. Nossos atendentes informarão sobre o preparo necessário 
                                    no momento do agendamento.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Posso remarcar ou cancelar consultas?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sim, pedimos apenas que nos comunique com antecedência mínima de 4 horas para 
                                    que possamos oferecer o horário para outros pacientes.
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <p class="mb-1"><i class="fas fa-phone"></i> (11) 3456-7890</p>
                    <p class="mb-1"><i class="fas fa-envelope"></i> contato@clinicasp.com.br</p>
                    <p class="mb-1"><i class="fas fa-whatsapp"></i> (11) 99999-9999</p>
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