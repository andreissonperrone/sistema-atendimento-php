<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente_id = $_POST['paciente_id'];
    $nome = $_POST['nome'];
    $dosagem = $_POST['dosagem'];
    $observacoes = $_POST['observacoes'];
    $data_prescricao = $_POST['data_prescricao'];

    $stmt = $conexao->prepare("INSERT INTO medicamentos (paciente_id, nome, dosagem, observacoes, data_prescricao) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $paciente_id, $nome, $dosagem, $observacoes, $data_prescricao);

    if ($stmt->execute()) {
        header("Location: listar_medicamentos.php?sucesso=1");
    } else {
        echo "Erro ao salvar medicamento: " . $stmt->error;
    }

    $stmt->close();
}
?>
