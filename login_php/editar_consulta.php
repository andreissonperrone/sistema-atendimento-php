<?php
include 'conexao.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$consulta = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM consultas WHERE id = $id"));
$medicos = mysqli_query($conexao, "SELECT id, nome FROM medicos");
$pacientes = mysqli_query($conexao, "SELECT id, nome FROM pacientes");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white rounded shadow p-4">
    <a href="listar_consultas.php" class="btn btn-secondary mb-3">🔙 Voltar</a>
    <h2 class="mb-4">Editar Consulta</h2>

    <form action="processa_editar_consulta.php" method="POST">
        <input type="hidden" name="id" value="<?= $consulta['id'] ?>">

        <div class="mb-3">
            <label for="medico_id" class="form-label">Médico</label>
            <select name="medico_id" id="medico_id" class="form-control" required>
                <option value="">Selecione</option>
                <?php while ($m = mysqli_fetch_assoc($medicos)) : ?>
                    <option value="<?= $m['id'] ?>" <?= $consulta['medico_id'] == $m['id'] ? 'selected' : '' ?>>
                        <?= $m['nome'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-control" required>
                <option value="">Selecione</option>
                <?php while ($p = mysqli_fetch_assoc($pacientes)) : ?>
                    <option value="<?= $p['id'] ?>" <?= $consulta['paciente_id'] == $p['id'] ? 'selected' : '' ?>>
                        <?= $p['nome'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" id="data" class="form-control" value="<?= $consulta['data'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" id="hora" class="form-control" value="<?= $consulta['hora'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Agendada" <?= $consulta['status'] == 'Agendada' ? 'selected' : '' ?>>Agendada</option>
                <option value="Realizada" <?= $consulta['status'] == 'Realizada' ? 'selected' : '' ?>>Realizada</option>
                <option value="Cancelada" <?= $consulta['status'] == 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">💾 Salvar Alterações</button>
    </form>
</div>
</body>
</html>
