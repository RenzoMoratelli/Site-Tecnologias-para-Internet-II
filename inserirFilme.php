<?php
include("valida.php");
include("conexao.php");

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $ano = trim($_POST['ano']);
    $genero = trim($_POST['genero']);
    $descricao = trim($_POST['descricao']);

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
        $sqlCheck = $conn->prepare("SELECT * FROM filmes WHERE nome = ?");
        $sqlCheck->bind_param("s", $nome);
        $sqlCheck->execute();
        $resultCheck = $sqlCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $mensagem = "Filme com este nome já existe!";
        } else {
            $sql = $conn->prepare("INSERT INTO filmes (nome, ano, genero, descricao) VALUES (?, ?, ?, ?)");
            $sql->bind_param("ssis", $nome, $ano, $genero, $descricao);

            if ($sql->execute()) {
                $_SESSION['mensagem_sucesso'] = "Filme cadastrado com sucesso!";
                header("Location: cadastroFilmes.php");
                exit();
            } else {
                $mensagem = "Erro ao cadastrar filme: " . $conn->error;
            }
        }
    }
}

if (!empty($mensagem)) {
    echo "<script>alert('$mensagem'); window.history.back();</script>";
}
?>