<?php
include("valida.php");
include("conexao.php");

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

function validarSenha($senha) {
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/';
    return preg_match($regex, $senha);
}

$cpf = trim($_POST['cpf']);
$nome = trim($_POST['nome']);
$senha = $_POST['senha'];
$cpfAnterior = trim($_POST['cpfAnterior']);

$mensagem = "";

if (!validarCPF($cpf)) {
    $mensagem = "CPF inválido!";
} elseif (empty($nome)) {
    $mensagem = "O nome não pode estar vazio!";
} elseif (!validarSenha($senha)) {
    $mensagem = "A senha deve ter pelo menos 6 caracteres, incluindo 1 letra maiúscula, 1 letra minúscula, 1 número e 1 caractere especial.";
} else {
    $sqlCheck = $conn->prepare("SELECT * FROM usuarios WHERE cpf = ? AND cpf <> ?");
    $sqlCheck->bind_param("ss", $cpf, $cpfAnterior);
    $sqlCheck->execute();
    $resultCheck = $sqlCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        $mensagem = "Já existe um usuário com este CPF!";
    } else {
        $sql = "UPDATE usuarios SET cpf = ?, nome = ?, senha = ? WHERE cpf = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $cpf, $nome, $senha, $cpfAnterior);
            if ($stmt->execute()) {
                $mensagem = "Usuário alterado com sucesso!";
            } else {
                $mensagem = "Erro ao alterar usuário!";
            }
        } else {
            $mensagem = "Erro ao preparar a atualização!";
        }
    }
}

echo "<script>alert('$mensagem'); window.location.href='cadastroUsuarios.php';</script>";
exit();
?>
