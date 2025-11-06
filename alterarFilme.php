<?php
include("valida.php");
include("conexao.php");

$id = trim($_POST['id']);
$nome = trim($_POST['nome']);
$genero = trim($_POST['genero']);
$descricao = trim($_POST['descricao']);
$idAnterior = trim($_POST['idAnterior']);

$mensagem = "";

if (empty($id)) {
    $mensagem = "O ID não pode estar vazio!";
}  else {
    $sqlCheck = $conn->prepare("SELECT * FROM filmes WHERE id = ? AND id <> ?");
    $sqlCheck->bind_param("ii", $id, $idAnterior);
    $sqlCheck->execute();
    $resultCheck = $sqlCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        $mensagem = "Já existe um filme com esse ID";
    } else {
        $sql = "UPDATE filmes SET id = ?, nome = ?, genero = ?, descricao = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("issss", $id, $nome, $genero, $descricao , $idAnterior);
            if ($stmt->execute()) {
                $mensagem = "Filme alterado com sucesso!";
            } else {
                $mensagem = "Erro ao alterar filme!";
            }
        } else {
            $mensagem = "Erro ao preparar a atualização!";
        }
    }
}

echo "<script>alert('$mensagem'); window.location.href='cadastroFilmes.php';</script>";
exit();
?>
