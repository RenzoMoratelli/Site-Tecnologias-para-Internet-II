<?php
include("conexao.php");
session_start();

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = trim($_POST['cpf']);
    $senha = $_POST['senha'];

    if (!validarCPF($cpf)) {
        $_SESSION['mensagem_erro'] = "CPF inválido!";
        header("Location: index.php");
        exit();
    }

    if (!validarSenha($senha)) {
        $_SESSION['mensagem_erro'] = "Senha inválida! Deve ter pelo menos 6 caracteres, incluindo 1 letra maiúscula, 1 letra minúscula, 1 número e 1 caractere especial.";
        header("Location: index.php");
        exit();
    }

    $sql = "SELECT nome FROM usuarios WHERE cpf = ? AND senha = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $cpf, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();

            $_SESSION['cpf']  = $cpf;
            $_SESSION['nome'] = $row['nome'];

            header("Location: principal.php");
            exit();
        } else {
            $_SESSION['mensagem_erro'] = "CPF ou senha incorretos!";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['mensagem_erro'] = "Erro interno ao processar o login.";
        header("Location: index.php");
        exit();
    }
}
?>
