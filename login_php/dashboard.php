<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
include 'conexao.php';

// Contadores
$pacientes = $conexao->query("SELECT COUNT(*) AS total FROM pacientes")->fetch_assoc()['total'];
$medicos = $conexao->query("SELECT COUNT(*) AS total FROM medicos")->fetch_assoc()['total'];
$consultas = $conexao->query("SELECT COUNT(*) AS total FROM consultas")->fetch_assoc()['total'];
$exames = $conexao->query("SELECT COUNT(*) AS total FROM exames")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f3f5;
            display: flex;
        }

        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: white;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 18px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            transition: background-color 0.2s;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .main {
            margin-left: 220px;
            padding: 40px;
            flex: 1;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h3 {
            margin: 10px 0 5px;
            font-size: 24px;
        }

        .card span {
            color: #555;
        }

        .logout {
            position: absolute;
            bottom: 30px;
            width: 100%;
        }

        .logout a {
            background-color: #dc3545;
            text-align: center;
            display: block;
            padding: 12px;
            color: white;
            text-decoration: none;
        }

        .submenu a {
            font-size: 14px;
            color: #ced4da;
            padding: 8px 20px;
            display: block;
            text-decoration: none;
        }

        .submenu a:hover {
            background-color: #495057;
            color: white;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>🕒 LAB tec</h3>

    <div class="menu-item">
        <a href="#" onclick="toggleSubmenu('cadastros')">📁 Cadastros ▾</a>
        <div id="cadastros" class="submenu" style="display: none; padding-left: 10px;">
            <a href="listar_pacientes.php">📋 Pacientes</a>
            <a href="listar_medicos.php">🩺 Médicos</a>
            <a href="listar_usuarios.php">👤 Usuários</a>
            <a href="listar_perfis.php">👥 Perfis de Usuário</a>
        </div>
    </div>

    <div class="menu-item">
        <a href="#" onclick="toggleSubmenu('consultas')">📅 Consultas ▾</a>
        <div id="consultas" class="submenu" style="display: none; padding-left: 10px;">
            <a href="listar_consultas.php">📋 Consultas</a>
            <a href="cadastro_consulta.php">➕ Agendar Consulta</a>
        </div>
    </div>

    <div class="menu-item">
        <a href="#" onclick="toggleSubmenu('exames')">🧪 Exames e Medicamentos ▾</a>
        <div id="exames" class="submenu" style="display: none; padding-left: 10px;">
            <a href="listar_exames.php">📋 Exames</a>
            <a href="listar_medicamentos.php">💊 Medicamentos</a>
        </div>
    </div>

    <div class="logout">
        <a href="logout.php">🚪 Sair</a>
    </div>
</div>

<div class="main">
    <div class="header">Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</div>

    <div class="card-container">
        <div class="card">
            <h3><?= $pacientes ?></h3>
            <span>Pacientes</span>
        </div>
        <div class="card">
            <h3><?= $medicos ?></h3>
            <span>Médicos</span>
        </div>
        <div class="card">
            <h3><?= $consultas ?></h3>
            <span>Consultas</span>
        </div>
        <div class="card">
            <h3><?= $exames ?></h3>
            <span>Exames</span>
        </div>
    </div>

    <div class="card">
        <canvas id="grafico"></canvas>
    </div>
</div>

<script>
function toggleSubmenu(id) {
    const submenu = document.getElementById(id);
    submenu.style.display = submenu.style.display === "none" ? "block" : "none";
}

// Gráfico simples
const ctx = document.getElementById('grafico').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pacientes', 'Médicos', 'Consultas', 'Exames'],
        datasets: [{
            label: 'Registros Totais',
            data: [<?= $pacientes ?>, <?= $medicos ?>, <?= $consultas ?>, <?= $exames ?>],
            borderWidth: 1,
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});
</script>

</body>
</html>
