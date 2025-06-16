<?php
// editar_medico.php
require_once 'conexao.php';
$id = intval($_GET['id']);
$medico = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM medicos WHERE id = $id"));
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white rounded shadow p-4">
    <h2 class="mb-4">Editar Médico</h2>
    <form action="processa_editar_medico.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $medico['id'] ?>">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($medico['nome']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="crm" class="form-label">CRM:</label>
            <input type="text" name="crm" value="<?= htmlspecialchars($medico['crm']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input type="text" name="cpf" value="<?= htmlspecialchars($medico['cpf']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade:</label>
            <input type="text" class="form-control" name="especialidade" value="<?= htmlspecialchars($medico['especialidade']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($medico['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file" class="form-control" name="foto">
            <?php if (!empty($medico['foto'])): ?>
                <img src="uploads/<?= $medico['foto'] ?>" width="100" class="mt-2 rounded">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="listar_medicos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>