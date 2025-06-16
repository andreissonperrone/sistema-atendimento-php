<?php
include 'conexao.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "ID de paciente inválido.";
    exit;
}

$paciente = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM pacientes WHERE id = $id"));
$exames = mysqli_query($conexao, "SELECT * FROM exames WHERE paciente_id = $id ORDER BY data_exame DESC");
$consultas = mysqli_query($conexao, "
    SELECT c.*, m.nome AS medico 
    FROM consultas c 
    JOIN medicos m ON c.medico_id = m.id 
    WHERE c.paciente_id = $id 
    ORDER BY c.data DESC
");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ficha do Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white rounded shadow p-4">
    <a href="listar_pacientes.php" class="btn btn-secondary mb-3">🔙 Voltar</a>
    <h2 class="mb-4">Ficha de <?= htmlspecialchars($paciente['nome']) ?></h2>

    <p><strong>CPF:</strong> <?= $paciente['cpf'] ?></p>
    <p><strong>Data de Nascimento:</strong> <?= $paciente['data_nascimento'] ?></p>
    <p><strong>Telefone:</strong> <?= $paciente['telefone'] ?></p>
    <p><strong>Endereço:</strong> <?= $paciente['endereco'] ?></p>

    <hr>
    <h4>📄 Histórico de Exames</h4>
    <?php if (mysqli_num_rows($exames) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Resultado</th>
                    <th>Arquivo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($exame = mysqli_fetch_assoc($exames)) : ?>
                    <tr>
                        <td><?= $exame['tipo_exame'] ?></td>
                        <td><?= $exame['data_exame'] ?></td>
                        <td><?= nl2br(htmlspecialchars($exame['resultado'])) ?></td>
                        <td>
                            <?php if ($exame['arquivo']) : ?>
                                <a href="uploads/<?= $exame['arquivo'] ?>" target="_blank">📎 Ver</a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Este paciente ainda não possui exames cadastrados.</p>
    <?php endif; ?>

    <hr>
    <h4>📅 Consultas e Atendimentos</h4>
    <?php if (mysqli_num_rows($consultas) > 0): ?>
        <ul class="list-group">
            <?php while ($consulta = mysqli_fetch_assoc($consultas)) : ?>
                <li class="list-group-item">
                    Consulta com <strong><?= $consulta['medico'] ?></strong> em 
                    <strong><?= $consulta['data'] ?></strong> às 
                    <strong><?= $consulta['hora'] ?></strong> — 
                    <span>Status: <?= $consulta['status'] ?></span>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Este paciente ainda não possui consultas cadastradas.</p>
    <?php endif; ?>
</div>

</body>
</html>
