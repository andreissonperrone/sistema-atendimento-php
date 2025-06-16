<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Primeiro, exclui a foto (se existir)
    $foto = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT foto FROM pacientes WHERE id = $id"));
    if ($foto && !empty($foto['foto']) && file_exists("uploads/" . $foto['foto'])) {
        unlink("uploads/" . $foto['foto']);
    }

    // Agora, exclui o paciente
    $stmt = $conexao->prepare("DELETE FROM pacientes WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: listar_pacientes.php");
        exit;
    } else {
        echo "Erro ao excluir paciente: " . $stmt->error;
    }
} else {
    echo "ID inválido.";
}
?>
