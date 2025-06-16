<?php
// processa_editar_medico.php
require_once 'conexao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$crm = $_POST['crm'];
$cpf = $_POST['cpf'];
$especialidade = $_POST['especialidade'];
$email = $_POST['email'];

$stmt = $conexao->prepare("UPDATE medicos SET nome = ?,crm = ?,cpf = ?, especialidade = ?, email = ? WHERE id = ?");
$stmt->bind_param("sssssi", $nome, $crm, $cpf, $especialidade, $email, $id);
if ($stmt->execute()) {
    header("Location: listar_medicos.php");
} else {
    echo "Erro ao atualizar médico: " . $stmt->error;
}
$stmt->close();
$conexao->close();
