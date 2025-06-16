<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $consulta_id = intval($_POST['consulta_id']);
    $diagnostico = trim($_POST['diagnostico']);
    $prescricao = trim($_POST['prescricao']);

    // Atualiza a consulta com diagnóstico, prescrição e status
    $stmt = $conexao->prepare("UPDATE consultas SET diagnostico = ?, prescricao = ?, status = 'Realizada' WHERE id = ?");
    $stmt->bind_param("ssi", $diagnostico, $prescricao, $consulta_id);

    if ($stmt->execute()) {
        header("Location: listar_consultas.php");
        exit;
    } else {
        echo "Erro ao registrar atendimento: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
} else {
    echo "Acesso inválido.";
}
?>
