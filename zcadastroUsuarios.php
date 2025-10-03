<?php
include("valida.php");
include("conexao.php"); 

$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cfp = $_POST['cfp'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    // Verifica se o usuário já existe
    $sqlCheck = $conn->prepare("SELECT * FROM renzo WHERE cfp = ?");
    $sqlCheck->bind_param("s", $cfp);
    $sqlCheck->execute();
    $resultCheck = $sqlCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        $mensagem = "Usuário com este CPF já existe!";
    } else {
        $sql = $conn->prepare("INSERT INTO renzo (cfp, nome, senha) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $cfp, $nome, $senha);
        if ($sql->execute()) {
            $mensagem = "Usuário cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar usuário!";
        }
    }
}

$sqlSelect = "SELECT cfp, nome, senha FROM renzo ORDER BY nome";
$resultado = $conn->query($sqlSelect);

?>

<html>
<head>
    <link rel="stylesheet" href="style_principal.css?v=1.0">
</head>
<body>
<div class="container">
    <div class="topo">
        <div class="nome">
            <h2><?php echo "Olá " . $_SESSION['nome'] . ", seja bem vindo ao sistema!"; ?></h2>
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
            <?php if ($mensagem) { echo "<p>$mensagem</p>"; } ?>
            <form method="post">
                <label>CPF:</label><br>
                <input type="text" name="cfp" required><br><br>

                <label>Nome:</label><br>
                <input type="text" name="nome" required><br><br>

                <label>Senha:</label><br>
                <input type="password" name="senha" required><br><br>

                <input type="submit" value="Cadastrar">
            </form>

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
        while($row = $resultado->fetch_assoc()){
            ?>
            <tr>
                <form method="post" action="alterarUsuario.php">
                    <td><input type="hidden" name="cpfAnterior" value="<?=$row['cpf'];?>"></td>
                    <td><input type="text" name="nome" value="<?=$row['nome'];?>"></td>
                    <td><input type="text" name="cpf" value="<?=$row['cpf'];?>"></td>
                    <td><input type="text" name="senha" value="<?=$row['senha'];?>"></td>
                    <td><input type="submit" value="alterar"></td>
                </form>
                <form method="post" action="apagarUsuario.php">
                    <input type="hidden" name="cpf" value="<?=$row['cpf'];?>">
                    <td><input type="submit" value="apagar"></td>
                </form>
            </tr>
            <?php
        }
    ?>    
    </table>
    </div>

        </div>
    </div>
</div>
</body>
</html>


    <?php

//        $sqlUsuarios = "SELECT * FROM renzo";
//        $resultado = $conn->query($sqlUsuarios);

        /*
        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['cfp'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['senha'] . "</td>";
                echo "<td>Alterar</td>";
                echo "<td>Apagar</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum usuário cadastrado</td></tr>";
        } */
        ?>