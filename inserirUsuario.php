<?php
include("valida.php");
include("conexão.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$cpf = $_POST['senha'];

$sql = "insert into usuarios (cpf,nome,senha) values (?,?,?)";
$stmt->execute();

if($stmt) {
    $stmt->bind_param("ss",$cpf,$senha);
    $stmt->execute();
    header("Location: cadastroUsuario");
}else{
    echo 'erro ao inserir usuário';
}
