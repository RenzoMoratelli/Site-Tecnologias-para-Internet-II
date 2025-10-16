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

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = trim($_POST['cpf']);
    $nome = trim($_POST['nome']);
    $senha = $_POST['senha'];

    if (!validarCPF($cpf)) {
        $mensagem = "CPF inválido!";
    } elseif (empty($nome)) {
        $mensagem = "O nome não pode estar vazio!";
    } elseif (!validarSenha($senha)) {
        $mensagem = "A senha deve ter pelo menos 6 caracteres, incluindo 1 letra maiúscula, 1 letra minúscula, 1 número e 1 caractere especial.";
    } else {
    
        $sqlCheck = $conn->prepare("SELECT * FROM usuarios WHERE cpf = ?");
        $sqlCheck->bind_param("s", $cpf);
        $sqlCheck->execute();
        $resultCheck = $sqlCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $mensagem = "Usuário com este CPF já existe!";
        } else {
            $sql = $conn->prepare("INSERT INTO usuarios (cpf, nome, senha) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $cpf, $nome, $senha);

            if ($sql->execute()) {
                $_SESSION['mensagem_sucesso'] = "Usuário cadastrado com sucesso!";
                header("Location: cadastroUsuarios.php");
                exit();
            } else {
                $mensagem = "Erro ao cadastrar usuário!";
            }
        }
    }
}

if (!empty($mensagem)) {
    echo "<script>alert('$mensagem'); window.history.back();</script>";
}
?>
