<?php
include("valida.php");
include("conexao.php");

$idAnterior = trim($_POST['idAnterior']);
$nome = trim($_POST['nome']);
$ano = trim($_POST['ano']);
$genero = trim($_POST['genero']);
$descricao = trim($_POST['descricao']);

$mensagem = "";

if (empty($nome)) {
    $mensagem = "O nome não pode estar vazio!";
} elseif (empty($ano)) {
    $mensagem = "O ano não pode estar vazio!";
} elseif (!is_numeric($ano) || strlen($ano) != 4) {
    $mensagem = "O ano deve ter 4 dígitos!";
} elseif ($ano < 1900 || $ano > 2025) {
    $mensagem = "O ano deve estar entre 1900 e 2025!";
} elseif (empty($genero)) {
    $mensagem = "Selecione um gênero!";
} elseif (empty($descricao)) {
    $mensagem = "A descrição não pode estar vazia!";
} else {
    $sqlCheck = $conn->prepare("SELECT * FROM filmes WHERE nome = ? AND id <> ?");
    $sqlCheck->bind_param("si", $nome, $idAnterior);
    $sqlCheck->execute();
    $resultCheck = $sqlCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        $mensagem = "Já existe outro filme com esse nome!";
    } else {
        $sql = "UPDATE filmes SET nome = ?, ano = ?, genero = ?, descricao = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssisi", $nome, $ano, $genero, $descricao, $idAnterior);
            if ($stmt->execute()) {
                $mensagem = "Filme alterado com sucesso!";
            } else {
                $mensagem = "Erro ao alterar filme: " . $conn->error;
            }
        } else {
            $mensagem = "Erro ao preparar a atualização: " . $conn->error;
        }
    }
}

echo "<script>alert('$mensagem'); window.location.href='cadastroFilmes.php';</script>";
exit();
?>