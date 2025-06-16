<?php
include 'conexao.php';

$result = mysqli_query($conexao, "
    SELECT c.*, m.nome AS medico, p.nome AS paciente
    FROM consultas c
    JOIN medicos m ON c.medico_id = m.id
    JOIN pacientes p ON c.paciente_id = p.id
    ORDER BY c.data DESC, c.hora DESC
");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultas Agendadas</title>
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
        <h2>📋 Consultas Agendadas</h2>
        <a href="cadastro_consulta.php" class="btn btn-primary">➕ Nova Consulta</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Médico</th>
                <th>Paciente</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['medico']) ?></td>
                <td><?= htmlspecialchars($row['paciente']) ?></td>
                <td><?= htmlspecialchars($row['data']) ?></td>
                <td><?= htmlspecialchars($row['hora']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <a href="editar_consulta.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    
                    <?php if ($row['status'] === 'Realizada'): ?>
                        <a href="registrar_atendimento.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">📄 Atendimento</a>
                    <?php else: ?>
                        <a href="realizar_consulta.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Realizar</a>
                    <?php endif; ?>

                    <a href="cancelar_consulta.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja cancelar esta consulta?');">Cancelar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
