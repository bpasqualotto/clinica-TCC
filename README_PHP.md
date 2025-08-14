# Sistema de Clínica Médica - PHP

Sistema completo para clínicas médicas desenvolvido em PHP com MySQL, Bootstrap 5 e JavaScript.

## 📋 Características

- **4 páginas principais**: Início, Serviços, Sobre e Contato
- **Sistema de login** para funcionários da clínica  
- **Dashboard administrativo** para gerenciar agendamentos e mensagens
- **Formulários funcionais** para contato e agendamento
- **Design responsivo** com Bootstrap 5
- **Menu reutilizável** em todas as páginas
- **Validação de formulários** com JavaScript
- **Sistema de mensagens flash** para feedback do usuário

## 📁 Estrutura de Arquivos

```
clinica-medica-php/
├── config.php              # Configurações do banco e funções globais
├── database.sql             # Script SQL para criar banco e tabelas
├── menu.php                 # Menu de navegação reutilizável
├── index.php                # Página inicial
├── servicos.php             # Página de serviços médicos
├── sobre.php                # Página sobre a clínica
├── contato.php              # Página de contato com formulário
├── login.php                # Página de login para funcionários
├── dashboard.php            # Dashboard administrativo
├── agendar.php              # Processamento de agendamentos
├── logout.php               # Processamento de logout
├── alterar_status.php       # Alteração de status de agendamentos
├── estilo.css               # Estilos CSS personalizados
└── script.js                # JavaScript personalizado
```

## 🚀 Instalação

### 1. Configurar Servidor
- **XAMPP/WAMP/LAMP**: Instale um servidor local com PHP e MySQL
- **PHP**: Versão 7.4 ou superior
- **MySQL**: Versão 5.7 ou superior

### 2. Configurar Banco de Dados
1. Abra o phpMyAdmin ou seu cliente MySQL
2. Execute o script `database.sql` para criar:
   - Banco de dados `clinica_medica`
   - Tabelas: `usuarios`, `agendamentos`, `contatos`
   - Usuário admin padrão

### 3. Configurar Conexão
Edite o arquivo `config.php` com suas configurações:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'clinica_medica');
define('DB_USER', 'root');        // Seu usuário MySQL
define('DB_PASS', '');            // Sua senha MySQL
```

### 4. Upload dos Arquivos
1. Copie todos os arquivos para a pasta do servidor web
2. Certifique-se que os arquivos estão na pasta correta (ex: `htdocs` no XAMPP)

## 🔑 Login Administrativo

**Credenciais padrão:**
- **Usuário**: admin
- **Senha**: admin123

## 📝 Funcionalidades

### Para Visitantes:
- ✅ Visualizar informações da clínica
- ✅ Conhecer serviços médicos oferecidos
- ✅ Entrar em contato via formulário
- ✅ Solicitar agendamento de consultas
- ✅ Ver informações de localização e horários

### Para Administradores:
- ✅ Fazer login no sistema
- ✅ Visualizar dashboard com estatísticas
- ✅ Gerenciar agendamentos (confirmar/cancelar)
- ✅ Ver mensagens de contato
- ✅ Alterar status de consultas

## 🎨 Design e Layout

- **Framework CSS**: Bootstrap 5.3.0
- **Ícones**: Font Awesome 6.4.0
- **Cores**: Tema médico com azul e verde
- **Responsivo**: Funciona em desktop, tablet e mobile
- **Animações**: Efeitos suaves com CSS e JavaScript

## 🛠️ Personalização

### Alterar Cores
Edite as variáveis CSS no arquivo `estilo.css`:

```css
:root {
    --primary-color: #007bff;    /* Azul principal */
    --success-color: #28a745;    /* Verde de sucesso */
    --medical-blue: #0056b3;     /* Azul médico */
}
```

### Adicionar Especialidades
Edite os arquivos `index.php` e `servicos.php` para adicionar novas especialidades médicas.

### Personalizar Formulários
Modifique `menu.php` para alterar o modal de agendamento ou adicionar novos campos.

## 📊 Banco de Dados

### Tabela: usuarios
```sql
- id (INT, PRIMARY KEY)
- usuario (VARCHAR, UNIQUE)
- email (VARCHAR, UNIQUE) 
- senha_hash (VARCHAR)
- nome_completo (VARCHAR)
- cargo (ENUM: admin, medico, funcionario)
- ativo (BOOLEAN)
- criado_em (TIMESTAMP)
```

### Tabela: agendamentos
```sql
- id (INT, PRIMARY KEY)
- nome_paciente (VARCHAR)
- email_paciente (VARCHAR)
- telefone_paciente (VARCHAR)
- data_agendamento (DATE)
- hora_agendamento (TIME)
- tipo_servico (VARCHAR)
- mensagem (TEXT)
- status (ENUM: pendente, confirmado, cancelado)
- criado_em (TIMESTAMP)
```

### Tabela: contatos
```sql
- id (INT, PRIMARY KEY)
- nome (VARCHAR)
- email (VARCHAR)
- telefone (VARCHAR)
- assunto (VARCHAR)
- mensagem (TEXT)
- criado_em (TIMESTAMP)
```

## 🔒 Segurança

- ✅ **Senhas criptografadas** com `password_hash()`
- ✅ **Prepared statements** para prevenir SQL injection
- ✅ **Validação de entrada** em formulários
- ✅ **Controle de sessão** para áreas administrativas
- ✅ **Sanitização de dados** antes da exibição

## 📱 Responsividade

O sistema é totalmente responsivo e funciona em:
- 💻 **Desktop** (1200px+)
- 📱 **Tablet** (768px - 1199px)
- 📱 **Mobile** (até 767px)

## 🆘 Solução de Problemas

### Erro de Conexão com Banco
1. Verifique as configurações em `config.php`
2. Confirme se o MySQL está rodando
3. Teste a conexão com outro cliente MySQL

### Página em Branco
1. Ative exibição de erros no PHP
2. Verifique logs de erro do servidor
3. Confirme se todos os arquivos foram enviados

### Formulários Não Funcionam
1. Verifique se o método POST está configurado
2. Confirme se os nomes dos campos coincidem
3. Teste a validação JavaScript

## 📞 Suporte

Para personalizar este sistema para sua clínica médica ou resolver problemas:

1. Verifique a documentação acima
2. Revise o código comentado nos arquivos
3. Teste em ambiente local antes de publicar

## 📄 Licença

Este projeto é fornecido como exemplo educacional. Adapte conforme necessário para seu uso comercial.

---

**Desenvolvido para Clínica Médica VivaMed**  

*Sistema completo de gestão para clínicas médicas*
