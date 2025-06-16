<?php
include 'conexao.php';

// Buscar pacientes para seleção
$pacientes = mysqli_query($conexao, "SELECT id, nome FROM pacientes ORDER BY nome");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container bg-white rounded shadow p-4">
        <a href="dashboard.php" class="btn btn-secondary mb-3">🔙 Voltar</a>
        <h2 class="mb-4">Cadastrar Medicamento</h2>

        <form action="processa_medicamento.php" method="POST">
            <div class="mb-3">
                <label for="paciente_id" class="form-label">Paciente</label>
                <select name="paciente_id" id="paciente_id" class="form-control" required>
                    <option value="">Selecione um paciente</option>
                    <?php while ($p = mysqli_fetch_assoc($pacientes)) : ?>
                        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label">Medicamento</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="dosagem" class="form-label">Dosagem</label>
                <input type="text" name="dosagem" id="dosagem" class="form-control">
            </div>

            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea name="observacoes" id="observacoes" rows="4" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="data_prescricao" class="form-label">Data da Prescrição</label>
                <input type="date" name="data_prescricao" id="data_prescricao" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">💊 Salvar Medicamento</button>
        </form>
    </div>
</body>
</html>
