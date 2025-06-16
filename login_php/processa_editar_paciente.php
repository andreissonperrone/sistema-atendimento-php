<!-- Lógica de edição --><?php
include 'conexao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$data_nascimento = $_POST['data_nascimento'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];

// Verifica se uma nova foto foi enviada
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
    $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $novo_nome = uniqid() . '.' . $extensao;
    $caminho = 'uploads/' . $novo_nome;
    move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);

    // Atualiza com nova foto
    $stmt = $conexao->prepare("UPDATE pacientes SET nome=?, cpf=?, data_nascimento=?, telefone=?, endereco=?, foto=? WHERE id=?");
    $stmt->bind_param("ssssssi", $nome, $cpf, $data_nascimento, $telefone, $endereco, $novo_nome, $id);
} else {
    // Atualiza sem mexer na foto
    $stmt = $conexao->prepare("UPDATE pacientes SET nome=?, cpf=?, data_nascimento=?, telefone=?, endereco=? WHERE id=?");
    $stmt->bind_param("sssssi", $nome, $cpf, $data_nascimento, $telefone, $endereco, $id);
}

if ($stmt->execute()) {
    header("Location: listar_pacientes.php");
    exit;
} else {
    echo "Erro ao atualizar: " . $stmt->error;
}
?>
