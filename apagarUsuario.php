<?php
include("valida.php");
include("conexao.php");

$cpf = $_POST['cpf'];

$sql = "delete from usuarios where cpf=?";
$stmt = $conn->prepare($sql);

if($stmt) {
    $stmt->bind_param("s",$cpf);
    $stmt->execute();
    header("Location: cadastroUsuarios.php");
}else{
    echo 'erro ao apagar usuário';
}
