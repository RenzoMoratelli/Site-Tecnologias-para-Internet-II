<?php
include("valida.php");
include("conexao.php");

$id = trim($_POST['id']);

if (!empty($id)) {
    $sql = "DELETE FROM filmes WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $_SESSION['mensagem_sucesso'] = "Filme apagado com sucesso!";
        } else {
            $_SESSION['mensagem_sucesso'] = "Erro ao apagar filme!";
        }
    } else {
        $_SESSION['mensagem_sucesso'] = "Erro ao preparar exclusão de filme!";
    }
} else {
    $_SESSION['mensagem_sucesso'] = "ID inválido para exclusão!";
}

header("Location: cadastroFilmes.php");
exit();
?>
