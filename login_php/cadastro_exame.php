<?php
include 'conexao.php';

// Buscar pacientes para preencher o select
$pacientes = mysqli_query($conexao, "SELECT id, nome FROM pacientes ORDER BY nome");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Exame</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f5;
            padding: 30px;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            max-width: 600px;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="listar_exames.php" class="btn btn-secondary mb-4">🔙 Voltar para lista</a>

    <h2 class="mb-4">➕ Cadastrar Novo Exame</h2>

    <form action="processa_exame.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-select" required>
                <option value="">Selecione um paciente</option>
                <?php while ($p = mysqli_fetch_assoc($pacientes)) : ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_exame" class="form-label">Tipo de Exame</label>
            <input type="text" name="tipo_exame" id="tipo_exame" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="data_exame" class="form-label">Data do Exame</label>
            <input type="date" name="data_exame" id="data_exame" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="resultado" class="form-label">Resultado</label>
            <textarea name="resultado" id="resultado" rows="4" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="arquivo" class="form-label">Anexo (opcional)</label>
            <input type="file" name="arquivo" id="arquivo" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">💾 Salvar Exame</button>
    </form>
</div>

</body>
</html>
