<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 30px;
        }

        .container {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-back {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="listar_pacientes.php" class="btn btn-secondary btn-back">🔙 Voltar</a>
    <h2 class="mb-4">Cadastro de Paciente</h2>

    <form action="processa_paciente.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Endereço:</label>
            <input type="text" name="endereco" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Foto (opcional):</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">💾 Cadastrar</button>
    </form>
</div>

</body>
</html>
