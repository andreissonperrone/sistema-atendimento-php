<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "login_db";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>