<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - LAB tec</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <form action="login.php" method="post" class="bg-white p-4 shadow rounded" style="min-width: 300px;">
        <h4 class="mb-3">🔐 Acesso ao Sistema</h4>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
        <p class="mt-3 text-center"><a href="cadastro_usuario.php">Cadastrar novo usuário</a></p>
    </form>
</body>
</html>