<?php
include 'conexao.php';

// Receber os dados do formulário
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$data_nascimento = $_POST['data_nascimento'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];

// Lidar com upload da foto (se houver)
$foto_nome = null;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto_nome = uniqid() . '.' . $extensao;
    move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $foto_nome);
}

// Preparar e executar a query de inserção
$stmt = $conexao->prepare("INSERT INTO pacientes (nome, cpf, data_nascimento, telefone, endereco, foto) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nome, $cpf, $data_nascimento, $telefone, $endereco, $foto_nome);

if ($stmt->execute()) {
    header("Location: listar_pacientes.php?msg=cadastrado");
} else {
    echo "Erro ao cadastrar paciente: " . $stmt->error;
}

$stmt->close();
$conexao->close();
