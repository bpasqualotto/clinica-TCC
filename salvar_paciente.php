<?php
include "conexao.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$data_nascimento = $_POST['data_nascimento'];

$sql = "INSERT INTO pacientes (nome, email, telefone, data_nascimento)
VALUES ('$nome', '$email', '$telefone', '$data_nascimento')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Paciente cadastrado com sucesso!');window.location='cadastro_paciente.php';</script>";
} else {
    echo "Erro: " . $conn->error;
}
$conn->close();
?>
