<?php
include("valida.php");
include("conexao.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$cpf = $_POST['senha'];

$sql = "insert into usuarios (cpf,nome,senha) values (?,?,?)";
$stmt = $conn->prepare($sql);
//$stmt->execute();

if($stmt) {
    $stmt->bind_param("sss",$cpf,$nome,$senha);
    $stmt->execute();
    header("Location: cadastroUsuarios.php");
}else{
    echo 'erro ao inserir usuário';
}
