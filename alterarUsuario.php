<?php
include("valida.php");
include("conexao.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$cpfAnterior = $_POST['cpfAnterior'];

$sql = "update usuarios set cpf = ?,
                            nome = ?,
                            senha = ?
            where cpf = ?";
$stmt = $conn->prepare($sql);

if($stmt) {
    $stmt->bind_param("ssss",$cpf,$nome,$senha,$cpfAnterior);
    $stmt->execute();
    header("Location: cadastroUsuarios.php");
}else{
    echo 'erro ao alterar usuário';
}
