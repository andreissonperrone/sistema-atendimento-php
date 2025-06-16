<?php
include 'conexao.php';

$query = "
SELECT m.*, p.nome AS paciente_nome
FROM medicamentos m
JOIN pacientes p ON m.paciente_id = p.id
ORDER BY m.data_prescricao DESC
";
$result = mysqli_query($conexao, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Medicamentos Prescritos</title>
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
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .btn-voltar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="dashboard.php" class="btn btn-secondary btn-voltar">🔙 Voltar para o painel</a>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>💊 Medicamentos Prescritos</h2>
        <a href="cadastro_medicamento.php" class="btn btn-primary">➕ Novo Medicamento</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Medicamento</th>
                <th>Dosagem</th>
                <th>Observações</th>
                <th>Data da Prescrição</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($med = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($med['paciente_nome']) ?></td>
                    <td><?= htmlspecialchars($med['nome']) ?></td>
                    <td><?= htmlspecialchars($med['dosagem']) ?></td>
                    <td><?= nl2br(htmlspecialchars($med['observacoes'])) ?></td>
                    <td><?= htmlspecialchars($med['data_prescricao']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
