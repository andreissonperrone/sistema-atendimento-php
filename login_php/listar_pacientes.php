<?php
require_once 'conexao.php';

$sql = "SELECT * FROM pacientes ORDER BY nome";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pacientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 30px;
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

        h2 {
            margin-bottom: 20px;
        }

        .btn-add {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #218838;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: background-color 0.3s ease;
        }

        .btn-add:hover {
            background-color: #1e7e34;
        }

        .link-voltar {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        .link-voltar:hover {
            text-decoration: underline;
        }

        .foto-paciente {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }

        .acoes a {
            margin-right: 8px;
            text-decoration: none;
        }

        .acoes .btn-info {
            color: #17a2b8;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Pacientes Cadastrados</h2>

<a href="cadastro_paciente.php" class="btn-add">➕ Adicionar Paciente</a>

<table>
    <tr>
        <th>ID</th>
        <th>Foto</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Data de Nascimento</th>
        <th>Telefone</th>
        <th>Endereço</th>
        <th>Ações</th>
    </tr>
    <?php while ($paciente = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= $paciente['id'] ?></td>
        <td>
            <?php if (!empty($paciente['foto'])): ?>
                <img src="uploads/<?= $paciente['foto'] ?>" class="foto-paciente">
            <?php else: ?>
                <span style="color: #999;">Sem foto</span>
            <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($paciente['nome']) ?></td>
        <td><?= htmlspecialchars($paciente['cpf']) ?></td>
        <td><?= htmlspecialchars($paciente['data_nascimento']) ?></td>
        <td><?= htmlspecialchars($paciente['telefone']) ?></td>
        <td><?= htmlspecialchars($paciente['endereco']) ?></td>
        <td class="acoes">
            <a href="editar_paciente.php?id=<?= $paciente['id'] ?>">✏️ Editar</a> |
            <a href="excluir_paciente.php?id=<?= $paciente['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este paciente?');">🗑️ Excluir</a> |
            <a href="detalhes_paciente.php?id=<?= $paciente['id'] ?>" class="btn-info">🔍 Ver Ficha</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a class="link-voltar" href="dashboard.php">← Voltar ao painel</a>

</body>
</html>
