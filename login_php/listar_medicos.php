<?php
require_once 'conexao.php';

$sql = "SELECT * FROM medicos ORDER BY nome";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Médicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 30px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        .foto {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }

        .btn-voltar {
            margin-top: 20px;
            display: inline-block;
        }

        .btn-novo {
            margin-bottom: 20px;
            background-color: #218838;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-novo:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>

<h2>Médicos Cadastrados</h2>

<a href="cadastro_medico.php" class="btn-novo">➕ Adicionar Médico</a>

<table>
    <tr>
        <th>ID</th>
        <th>Foto</th>
        <th>Nome</th>
        <th>Especialidade</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php while ($medico = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= $medico['id'] ?></td>
        <td>
            <?php if (!empty($medico['foto'])): ?>
                <img src="uploads/<?= $medico['foto'] ?>" class="foto">
            <?php else: ?>
                <span style="color: #999;">Sem foto</span>
            <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($medico['nome']) ?></td>
        <td><?= htmlspecialchars($medico['especialidade']) ?></td>
        <td><?= htmlspecialchars($medico['email']) ?></td>
        <td>
            <a href="editar_medico.php?id=<?= $medico['id'] ?>">✏️ Editar</a> |
            <a href="excluir_medico.php?id=<?= $medico['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este médico?');">🗑️ Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="dashboard.php" class="btn btn-secondary btn-voltar">← Voltar ao painel</a>

</body>
</html>
