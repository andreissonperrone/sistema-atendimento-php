<?php
require_once 'conexao.php';

// Buscar pacientes e médicos
$pacientes = $conexao->query("SELECT id, nome FROM pacientes ORDER BY nome");
$medicos = $conexao->query("SELECT id, nome FROM medicos ORDER BY nome");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agendar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white rounded shadow p-4">
    <h2 class="mb-4">📅 Agendar Nova Consulta</h2>

    <form action="processa_consulta.php" method="POST">
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-select" required>
                <option value="">Selecione o paciente</option>
                <?php while ($pac = $pacientes->fetch_assoc()): ?>
                    <option value="<?= $pac['id'] ?>"><?= htmlspecialchars($pac['nome']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="medico_id" class="form-label">Médico</label>
            <select name="medico_id" id="medico_id" class="form-select" required>
                <option value="">Selecione o médico</option>
                <?php while ($med = $medicos->fetch_assoc()): ?>
                    <option value="<?= $med['id'] ?>"><?= htmlspecialchars($med['nome']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" id="data" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" id="hora" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">➕ Agendar Consulta</button>
        <a href="dashboard.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>
