<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $medico_id = intval($_POST['medico_id']);
    $paciente_id = intval($_POST['paciente_id']);
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $status = $_POST['status'];

    $stmt = $conexao->prepare("UPDATE consultas SET medico_id = ?, paciente_id = ?, data = ?, hora = ?, status = ? WHERE id = ?");
    $stmt->bind_param("iisssi", $medico_id, $paciente_id, $data, $hora, $status, $id);

    if ($stmt->execute()) {
        header("Location: listar_consultas.php");
        exit;
    } else {
        echo "Erro ao atualizar consulta: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
} else {
    echo "Requisição inválida.";
}
