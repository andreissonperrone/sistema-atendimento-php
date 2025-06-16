<?php
// realizar_consulta.php
require_once 'conexao.php';

if (!isset($_GET['id'])) {
    header("Location: listar_consultas.php");
    exit;
}

$id = intval($_GET['id']);
$resultado = mysqli_query($conexao, "SELECT * FROM consultas WHERE id = $id");
$consulta = mysqli_fetch_assoc($resultado);

if (!$consulta) {
    echo "Consulta não encontrada.";
    exit;
}

// Atualizar status para "Realizada"
mysqli_query($conexao, "UPDATE consultas SET status = 'Realizada' WHERE id = $id");
header("Location: registrar_atendimento.php?id=$id");
exit;