<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medico_id = $_POST['medico_id'];
    $paciente_id = $_POST['paciente_id'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $status = 'Agendada';

    $stmt = $conexao->prepare("INSERT INTO consultas (medico_id, paciente_id, data, hora, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $medico_id, $paciente_id, $data, $hora, $status);

    if ($stmt->execute()) {
        header("Location: listar_consultas.php");
        exit;
    } else {
        echo "Erro ao agendar consulta: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
} else {
    echo "Requisição inválida.";
}
