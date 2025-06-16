<!-- Formulário de edição do paciente --><?php
include 'conexao.php';

$id = $_GET['id'];
$resultado = mysqli_query($conexao, "SELECT * FROM pacientes WHERE id = $id");
$paciente = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white rounded shadow p-4">
    <h2 class="mb-4">✏️ Editar Paciente</h2>

    <form action="processa_editar_paciente.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $paciente['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($paciente['nome']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" value="<?= htmlspecialchars($paciente['cpf']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" value="<?= $paciente['data_nascimento'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($paciente['telefone']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" name="endereco" class="form-control" value="<?= htmlspecialchars($paciente['endereco']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Atual</label><br>
            <?php if (!empty($paciente['foto'])): ?>
                <img src="uploads/<?= $paciente['foto'] ?>" width="100" class="rounded mb-2"><br>
            <?php else: ?>
                <span class="text-muted">Sem foto</span><br>
            <?php endif; ?>
            <label class="form-label mt-2">Nova Foto (opcional)</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">💾 Salvar Alterações</button>
        <a href="listar_pacientes.php" class="btn btn-secondary">🔙 Voltar</a>
    </form>
</div>

</body>
</html>
