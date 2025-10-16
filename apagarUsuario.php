<?php
include("valida.php");
include("conexao.php");

$cpf = $_POST['cpf'] ?? '';

if (!empty($cpf)) {
    $sql = "DELETE FROM usuarios WHERE cpf = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $cpf);
        if ($stmt->execute()) {
            $_SESSION['mensagem_sucesso'] = "Usuário apagado com sucesso!";
        } else {
            $_SESSION['mensagem_sucesso'] = "Erro ao apagar usuário!";
        }
    } else {
        $_SESSION['mensagem_sucesso'] = "Erro ao preparar exclusão de usuário!";
    }
} else {
    $_SESSION['mensagem_sucesso'] = "CPF inválido para exclusão!";
}

header("Location: cadastroUsuarios.php");
exit();
?>
