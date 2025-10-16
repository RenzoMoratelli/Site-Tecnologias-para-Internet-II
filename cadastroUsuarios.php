<?php
include("valida.php");
include("conexao.php"); 


$sqlSelect = "SELECT cpf, nome, senha FROM usuarios ORDER BY nome";
$resultado = $conn->query($sqlSelect);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="style_principal.css?v=1.0">
</head>
<body>
<div class="container">
    <div class="topo">
        <div class="nome">
            <a href="principal.php" style="color: #ffffff; font-size: 1.25rem; font-weight: 500; text-decoration: none;">
                <?php echo "Olá " . $_SESSION['nome'] . ", seja bem-vindo ao sistema!"; ?>
            </a>
        </div>
        <div class="logout">
            <a href="logout.php" class="logout">Sair</a>
        </div>
    </div>

    <div class="corpo">
        <div class="menu">
            <ul>
                <li><a href="principal.php">Início</a></li>
                <li><a href="cadastroUsuarios.php">Cadastro de Usuários</a></li>
            </ul>
        </div>

        <div class="conteudo">
            <h3>Cadastro de Usuários</h3>

            <form method="post" action="inserirUsuario.php">
                <label>CPF:</label><br>
                <input type="text" name="cpf" required><br><br>

                <label>Nome:</label><br>
                <input type="text" name="nome" value="" required><br><br>

                <label>Senha:</label><br>
                <input type="text" name="senha" value="" required><br><br>

                <input type="submit" value="Cadastrar">
            </form>

    <?php
            if (isset($_SESSION['mensagem_sucesso'])) {
                echo "<script>alert('" . $_SESSION['mensagem_sucesso'] . "');</script>";
            unset($_SESSION['mensagem_sucesso']); 
                }
    ?>

            <hr>

            <div class="cadastrados">
                <h3>Usuários Cadastrados</h3>
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Senha</th>
                        <th>Alterar</th>
                        <th>Apagar</th>
                    </tr>
                    <?php
                    if ($resultado && $resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                    ?>
                    <tr>
                        <form method="post" action="alterarUsuario.php">
                            <input type="hidden" name="cpfAnterior" value="<?=$row['cpf'];?>">
                            <td><input type="text" name="cpf" value="<?=$row['cpf'];?>"></td>
                            <td><input type="text" name="nome" value="<?=$row['nome'];?>"></td>
                            <td><input type="text" name="senha" value="<?=$row['senha'];?>"></td>
                            <td><input type="submit" value="Alterar"></td>
                        </form>

                        <form method="post" action="apagarUsuario.php">
                            <input type="hidden" name="cpf" value="<?=$row['cpf'];?>">
                            <td><input type="submit" value="Apagar"></td>
                        </form>
                    </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align: center;'>Nenhum usuário cadastrado</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
