/**
 * JavaScript personalizado para Clínica Médica São Paulo
 * Funcionalidades: Validação de formulários, animações, interações
 */

// Inicializar quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    console.log('Clínica Médica SP - Website initialized successfully');
    
    // Inicializar funcionalidades
    initFormValidation();
    initPhoneMask();
    initDateValidation();
    initAnimations();
    initTooltips();
    initScrollToTop();
});

/**
 * Validação de formulários
 */
function initFormValidation() {
    // Validação do formulário de contato
    const contactForm = document.querySelector('form[action="contato.php"]');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            if (!validateContactForm(this)) {
                e.preventDefault();
            }
        });
    }
    
    // Validação do formulário de agendamento
    const appointmentForm = document.querySelector('form[action="agendar.php"]');
    if (appointmentForm) {
        appointmentForm.addEventListener('submit', function(e) {
            if (!validateAppointmentForm(this)) {
                e.preventDefault();
            }
        });
    }
    
    // Validação do formulário de login
    const loginForm = document.querySelector('form[method="POST"]');
    if (loginForm && window.location.pathname.includes('login.php')) {
        loginForm.addEventListener('submit', function(e) {
            if (!validateLoginForm(this)) {
                e.preventDefault();
            }
        });
    }
}

/**
 * Validar formulário de contato
 */
function validateContactForm(form) {
    const nome = form.querySelector('#nome');
    const email = form.querySelector('#email');
    const assunto = form.querySelector('#assunto');
    const mensagem = form.querySelector('#mensagem');
    
    let isValid = true;
    
    // Limpar erros anteriores
    clearFieldErrors(form);
    
    // Validar nome
    if (!nome.value.trim()) {
        showFieldError(nome, 'Nome é obrigatório');
        isValid = false;
    } else if (nome.value.trim().length < 2) {
        showFieldError(nome, 'Nome deve ter pelo menos 2 caracteres');
        isValid = false;
    }
    
    // Validar email
    if (!email.value.trim()) {
        showFieldError(email, 'E-mail é obrigatório');
        isValid = false;
    } else if (!isValidEmail(email.value)) {
        showFieldError(email, 'E-mail inválido');
        isValid = false;
    }
    
    // Validar assunto
    if (!assunto.value) {
        showFieldError(assunto, 'Selecione um assunto');
        isValid = false;
    }
    
    // Validar mensagem
    if (!mensagem.value.trim()) {
        showFieldError(mensagem, 'Mensagem é obrigatória');
        isValid = false;
    } else if (mensagem.value.trim().length < 10) {
        showFieldError(mensagem, 'Mensagem deve ter pelo menos 10 caracteres');
        isValid = false;
    }
    
    return isValid;
}

/**
 * Validar formulário de agendamento
 */
function validateAppointmentForm(form) {
    const nome = form.querySelector('#nome_paciente');
    const email = form.querySelector('#email_paciente');
    const telefone = form.querySelector('#telefone_paciente');
    const data = form.querySelector('#data_agendamento');
    const hora = form.querySelector('#hora_agendamento');
    const servico = form.querySelector('#tipo_servico');
    
    let isValid = true;
    
    // Limpar erros anteriores
    clearFieldErrors(form);
    
    // Validar nome
    if (!nome.value.trim()) {
        showFieldError(nome, 'Nome é obrigatório');
        isValid = false;
    }
    
    // Validar email
    if (!email.value.trim()) {
        showFieldError(email, 'E-mail é obrigatório');
        isValid = false;
    } else if (!isValidEmail(email.value)) {
        showFieldError(email, 'E-mail inválido');
        isValid = false;
    }
    
    // Validar telefone
    if (!telefone.value.trim()) {
        showFieldError(telefone, 'Telefone é obrigatório');
        isValid = false;
    }
    
    // Validar data
    if (!data.value) {
        showFieldError(data, 'Data é obrigatória');
        isValid = false;
    } else if (new Date(data.value) < new Date().setHours(0,0,0,0)) {
        showFieldError(data, 'Data deve ser hoje ou no futuro');
        isValid = false;
    }
    
    // Validar horário
    if (!hora.value) {
        showFieldError(hora, 'Horário é obrigatório');
        isValid = false;
    } else if (!isValidBusinessHour(hora.value)) {
        showFieldError(hora, 'Horário deve ser entre 7:00 e 18:00');
        isValid = false;
    }
    
    // Validar serviço
    if (!servico.value) {
        showFieldError(servico, 'Selecione um tipo de consulta');
        isValid = false;
    }
    
    return isValid;
}

/**
 * Validar formulário de login
 */
function validateLoginForm(form) {
    const usuario = form.querySelector('#usuario');
    const senha = form.querySelector('#senha');
    
    let isValid = true;
    
    // Limpar erros anteriores
    clearFieldErrors(form);
    
    // Validar usuário
    if (!usuario.value.trim()) {
        showFieldError(usuario, 'Usuário é obrigatório');
        isValid = false;
    }
    
    // Validar senha
    if (!senha.value.trim()) {
        showFieldError(senha, 'Senha é obrigatória');
        isValid = false;
    }
    
    return isValid;
}

/**
 * Funções auxiliares de validação
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidBusinessHour(time) {
    const [hours, minutes] = time.split(':').map(Number);
    const timeInMinutes = hours * 60 + minutes;
    const startTime = 7 * 60; // 7:00
    const endTime = 18 * 60; // 18:00
    
    return timeInMinutes >= startTime && timeInMinutes <= endTime;
}

/**
 * Mostrar erro de campo
 */
function showFieldError(field, message) {
    field.classList.add('is-invalid');
    
    // Remover erro anterior se existir
    const existingError = field.parentNode.querySelector('.invalid-feedback');
    if (existingError) {
        existingError.remove();
    }
    
    // Criar nova mensagem de erro
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.textContent = message;
    field.parentNode.appendChild(errorDiv);
}

/**
 * Limpar erros de campos
 */
function clearFieldErrors(form) {
    const invalidFields = form.querySelectorAll('.is-invalid');
    invalidFields.forEach(field => {
        field.classList.remove('is-invalid');
    });
    
    const errorMessages = form.querySelectorAll('.invalid-feedback');
    errorMessages.forEach(error => {
        error.remove();
    });
}

/**
 * Máscara para telefone
 */
function initPhoneMask() {
    const phoneFields = document.querySelectorAll('input[type="tel"]');
    
    phoneFields.forEach(field => {
        field.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            // Limitar a 11 dígitos
            if (value.length > 11) {
                value = value.slice(0, 11);
            }
            
            // Aplicar máscara
            if (value.length <= 10) {
                value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            } else {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            }
            
            e.target.value = value;
        });
    });
}

/**
 * Validação de data
 */
function initDateValidation() {
    const dateFields = document.querySelectorAll('input[type="date"]');
    
    dateFields.forEach(field => {
        // Definir data mínima como hoje
        const today = new Date().toISOString().split('T')[0];
        field.setAttribute('min', today);
        
        // Definir data máxima como 6 meses no futuro
        const maxDate = new Date();
        maxDate.setMonth(maxDate.getMonth() + 6);
        field.setAttribute('max', maxDate.toISOString().split('T')[0]);
    });
}

/**
 * Animações
 */
function initAnimations() {
    // Animação de fade-in para cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observar cards e seções
    const animatedElements = document.querySelectorAll('.card, .alert, section');
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

/**
 * Inicializar tooltips do Bootstrap
 */
function initTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

/**
 * Botão voltar ao topo
 */
function initScrollToTop() {
    // Criar botão
    const scrollButton = document.createElement('button');
    scrollButton.innerHTML = '<i class="fas fa-arrow-up"></i>';
    scrollButton.className = 'btn btn-primary position-fixed';
    scrollButton.style.cssText = `
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    `;
    scrollButton.title = 'Voltar ao topo';
    
    document.body.appendChild(scrollButton);
    
    // Mostrar/ocultar botão baseado no scroll
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollButton.style.display = 'block';
        } else {
            scrollButton.style.display = 'none';
        }
    });
    
    // Ação do botão
    scrollButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Confirmação de ações perigosas
 */
function confirmarAcao(mensagem) {
    return confirm(mensagem || 'Tem certeza que deseja realizar esta ação?');
}

/**
 * Mostrar loading
 */
function showLoading(button) {
    const originalText = button.innerHTML;
    button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Aguarde...';
    button.disabled = true;
    
    return function() {
        button.innerHTML = originalText;
        button.disabled = false;
    };
}

/**
 * Notificação toast
 */
function showToast(message, type = 'success') {
    // Criar container se não existir
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }
    
    // Criar toast
    const toastHTML = `
        <div class="toast align-items-center text-white bg-${type}" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
    
    toastContainer.insertAdjacentHTML('beforeend', toastHTML);
    
    // Inicializar e mostrar toast
    const toastElement = toastContainer.lastElementChild;
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
    
    // Remover toast após ocultar
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastElement.remove();
    });
}

/**
 * Utilitários para dashboard
 */
if (window.location.pathname.includes('dashboard.php')) {
    // Auto-refresh da página a cada 5 minutos
    setInterval(function() {
        window.location.reload();
    }, 300000);
    
    // Destacar agendamentos urgentes
    const agendamentosHoje = document.querySelectorAll('td');
    const hoje = new Date().toISOString().split('T')[0];
    
    agendamentosHoje.forEach(cell => {
        if (cell.textContent.includes(hoje.split('-').reverse().join('/'))) {
            cell.parentElement.classList.add('table-warning');
        }
    });
}

/**
 * Formatação de moeda (para futuras implementações)
 */
function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

/**
 * Formatação de data
 */
function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('pt-BR');
}

/**
 * Validação de CPF (para futuras implementações)
 */
function isValidCPF(cpf) {
    cpf = cpf.replace(/[^\d]/g, '');
    
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        return false;
    }
    
    let sum = 0;
    for (let i = 0; i < 9; i++) {
        sum += parseInt(cpf.charAt(i)) * (10 - i);
    }
    
    let digit = 11 - (sum % 11);
    if (digit > 9) digit = 0;
    
    if (parseInt(cpf.charAt(9)) !== digit) {
        return false;
    }
    
    sum = 0;
    for (let i = 0; i < 10; i++) {
        sum += parseInt(cpf.charAt(i)) * (11 - i);
    }
    
    digit = 11 - (sum % 11);
    if (digit > 9) digit = 0;
    
    return parseInt(cpf.charAt(10)) === digit;
}