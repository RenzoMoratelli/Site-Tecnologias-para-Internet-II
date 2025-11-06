<?php
include("valida.php");
include("conexao.php");

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id']);
    $nome = trim($_POST['nome']);
    $genero = trim($_POST['genero']);
    $descricao = trim($_POST['descricao']);

    if  (empty($id)) {
        $mensagem = "O ID não pode estar vazio!";
    }  else {
    
        $sqlCheck = $conn->prepare("SELECT * FROM filmes WHERE id = ?");
        $sqlCheck->bind_param("i", $id);
        $sqlCheck->execute();
        $resultCheck = $sqlCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $mensagem = "Filme com este ID já existe!";
        } else {
            $sql = $conn->prepare("INSERT INTO filmes (id, nome, genero, descricao) VALUES (?, ?, ?, ?)");
            $sql->bind_param("isss", $id, $nome, $genero, $descricao);

            if ($sql->execute()) {
                $_SESSION['mensagem_sucesso'] = "Filme cadastrado com sucesso!";
                header("Location: cadastroFilmes.php");
                exit();
            } else {
                $mensagem = "Erro ao cadastrar filme!";
            }
        }
    }
}

if (!empty($mensagem)) {
    echo "<script>alert('$mensagem'); window.history.back();</script>";
}
?>
