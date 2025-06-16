<?php
// processa_medico.php
require_once 'conexao.php';

$nome = $_POST['nome'];
$crm = $_POST['crm'];
$cpf = $_POST['cpf'];
$especialidade = $_POST['especialidade'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Verifica se email já existe
$verifica = $conexao->prepare("SELECT id FROM medicos WHERE email = ?");
$verifica->bind_param("s", $email);
$verifica->execute();
$verifica->store_result();
if ($verifica->num_rows > 0) {
    header("Location: cadastro_medico.php?erro=email");
    exit;
}
$verifica->close();

$stmt = $conexao->prepare("INSERT INTO medicos (nome, crm, cpf, especialidade, email, senha) VALUES (?, ?, ?, ?, ?,? )");
$stmt->bind_param("ssssss", $nome, $crm, $cpf , $especialidade, $email, $senha);
if ($stmt->execute()) {
    header("Location: listar_medicos.php");
} else {
    echo "Erro ao cadastrar médico: " . $stmt->error;
}
$stmt->close();
$conexao->close();