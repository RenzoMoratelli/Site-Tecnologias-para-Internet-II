<?php
include("conexao.php");

$cpf   = $_POST['cpf'];
$senha = $_POST['senha'];

$sql = "SELECT nome FROM usuarios WHERE cpf = ? AND senha = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $cpf, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();

        session_start();
        $_SESSION['cpf']  = $cpf;
        $_SESSION['nome'] = $row['nome'];

        header("Location: principal.php");
        exit;
    } else {
        header("Location: index.php?erro=CPF ou senha incorretos");
        exit;
    }
} else {
    header("Location: index.php?erro=Erro na consulta");
    exit;
}
?>
