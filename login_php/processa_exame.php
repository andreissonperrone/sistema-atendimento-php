<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente_id = $_POST['paciente_id'];
    $tipo_exame = $_POST['tipo_exame'];
    $data_exame = $_POST['data_exame'];
    $resultado = $_POST['resultado'];
    $arquivo_nome = null;

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
        $arquivo_original = basename($_FILES['arquivo']['name']);
        $extensao = pathinfo($arquivo_original, PATHINFO_EXTENSION);
        $arquivo_nome = uniqid() . '.' . $extensao;
        $caminho_destino = 'uploads/' . $arquivo_nome;

        move_uploaded_file($arquivo_tmp, $caminho_destino);
    }

    // Inserção no banco de dados
    $stmt = $conexao->prepare("INSERT INTO exames (paciente_id, tipo_exame, data_exame, resultado, arquivo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $paciente_id, $tipo_exame, $data_exame, $resultado, $arquivo_nome);

    if ($stmt->execute()) {
        header("Location: listar_exames.php?sucesso=1");
        exit;
    } else {
        echo "Erro ao salvar exame: " . $conexao->error;
    }
}
?>
