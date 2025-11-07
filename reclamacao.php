<?php
// reclamacao.php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Reclamação - VivaMed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'menu.php'; ?> <!-- Inclui o menu -->

    <div class="container mt-5">
        <h1><i class="fas fa-exclamation-circle"></i> Página de Reclamação</h1>
        <form>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="mensagem" class="form-label">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" class="form-control" rows="4"></textarea>
            </div>
            <button type="button" class="btn btn-primary" onclick="console.log('Reclamação enviada!')">
                <i class="fas fa-paper-plane"></i> Enviar
            </button>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/yourkey.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
