<?php
include 'conexao.php';

$query = "
SELECT e.*, p.nome AS paciente_nome
FROM exames e
JOIN pacientes p ON e.paciente_id = p.id
ORDER BY e.data_exame DESC
";
$result = mysqli_query($conexao, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Exames</title>
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

        a.btn-link {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="dashboard.php" class="btn btn-secondary btn-voltar">🔙 Voltar para o painel</a>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📋 Lista de Exames</h2>
        <a href="cadastro_exame.php" class="btn btn-primary">➕ Novo Exame</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Tipo de Exame</th>
                <th>Data</th>
                <th>Resultado</th>
                <th>Arquivo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($exame = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($exame['paciente_nome']) ?></td>
                    <td><?= htmlspecialchars($exame['tipo_exame']) ?></td>
                    <td><?= htmlspecialchars($exame['data_exame']) ?></td>
                    <td><?= nl2br(htmlspecialchars($exame['resultado'])) ?></td>
                    <td>
                        <?php if (!empty($exame['arquivo'])): ?>
                            <a href="uploads/<?= htmlspecialchars($exame['arquivo']) ?>" target="_blank" class="btn btn-sm btn-info">📎 Ver Arquivo</a>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
