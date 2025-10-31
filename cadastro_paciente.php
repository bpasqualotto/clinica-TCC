<?php
// arquivo de conexão
include "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro de Paciente - VivaMed</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #cfe9ff; /* azul bebê */
        font-family: Arial, sans-serif;
    }
    .card {
        border-radius: 18px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border: none;
    }
    .btn-primary {
        background-color: #73b9ff;
        border: none;
        font-weight: bold;
    }
    .btn-primary:hover {
        background-color: #4ea4ff;
    }
    h2 {
        color: #005c99;
        font-weight: bold;
    }
</style>

</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card p-4" style="width: 420px;">
    <h2 class="text-center mb-4">Cadastro de Paciente</h2>

    <form action="salvar_paciente.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Nome completo</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" placeholder="(xx) xxxxx-xxxx" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Cadastrar Paciente</button>
    </form>
</div>

</body>
</html>
