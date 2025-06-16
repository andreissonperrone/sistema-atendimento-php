<?php
include 'conexao.php';

if (!isset($_GET['id'])) {
    echo "Consulta não especificada.";
    exit;
}

$consulta_id = intval($_GET['id']);
$consulta = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT c.*, m.nome AS medico, p.nome AS paciente
    FROM consultas c
    JOIN medicos m ON c.medico_id = m.id
    JOIN pacientes p ON c.paciente_id = p.id
    WHERE c.id = $consulta_id
"));
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atendimento Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white rounded shadow p-4">
    <h2 class="mb-4">Registrar Atendimento</h2>

    <p><strong>Médico:</strong> <?= htmlspecialchars($consulta['medico']) ?></p>
    <p><strong>Paciente:</strong> <?= htmlspecialchars($consulta['paciente']) ?></p>
    <p><strong>Data:</strong> <?= $consulta['data'] ?> | <strong>Hora:</strong> <?= $consulta['hora'] ?></p>

    <form action="processa_atendimento.php" method="POST">
        <input type="hidden" name="consulta_id" value="<?= $consulta_id ?>">

        <div class="mb-3">
            <label for="diagnostico" class="form-label">Diagnóstico</label>
            <textarea name="diagnostico" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="prescricao" class="form-label">Prescrição</label>
            <textarea name="prescricao" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Atendimento</button>
        <a href="listar_consultas.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>
