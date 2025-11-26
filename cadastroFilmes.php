<?php
include("valida.php");
include("conexao.php"); 

$sqlSelect = "SELECT f.id, f.nome, f.ano, f.genero, g.genero as genero_nome, f.descricao 
              FROM filmes f 
              INNER JOIN generos g ON f.genero = g.id 
              ORDER BY f.nome";
$resultado = $conn->query($sqlSelect);

$sqlGeneros = "SELECT id, genero FROM generos ORDER BY genero";
$resultadoGeneros = $conn->query($sqlGeneros);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Filmes</title>
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
                <li><a href="cadastroFilmes.php">Cadastro de Filmes</a></li>
            </ul>
        </div>

        <div class="conteudo">
            <h3>Cadastro de Filmes</h3>

            <form method="post" action="inserirFilme.php">
                <label>Nome:</label><br>
                <input type="text" name="nome" required><br><br>

                <label>Ano:</label><br>
                <input type="number" name="ano" min="1900" max="2025" required><br><br>

                <label>Gênero:</label><br>
                <select name="genero" required>
                    <option value="">Selecione um gênero</option>
                    <?php
                    if ($resultadoGeneros && $resultadoGeneros->num_rows > 0) {
                        while ($genero = $resultadoGeneros->fetch_assoc()) {
                            echo "<option value='" . $genero['id'] . "'>" . $genero['genero'] . "</option>";
                        }
                    }
                    ?>
                </select><br><br>

                <label>Descrição:</label><br>
                <textarea name="descricao" rows="4" cols="50" required></textarea><br><br>

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
                <h3>Filmes Cadastrados</h3>
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ano</th>
                        <th>Gênero</th>
                        <th>Descrição</th>
                        <th>Alterar</th>
                        <th>Apagar</th>
                    </tr>
                    <?php
                    if ($resultado && $resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                            $sqlGenerosEdit = "SELECT id, genero FROM generos ORDER BY genero";
                            $resultadoGenerosEdit = $conn->query($sqlGenerosEdit);
                    ?>
                    <tr>
                        <form method="post" action="alterarFilme.php">
                            <input type="hidden" name="idAnterior" value="<?=$row['id'];?>">
                            <td><?=$row['id'];?></td>
                            <td><input type="text" name="nome" value="<?=$row['nome'];?>"></td>
                            <td><input type="number" name="ano" value="<?=$row['ano'];?>" min="1900" max="2025"></td>
                            <td>
                                <select name="genero" required>
                                    <?php
                                    if ($resultadoGenerosEdit && $resultadoGenerosEdit->num_rows > 0) {
                                        while ($generoEdit = $resultadoGenerosEdit->fetch_assoc()) {
                                            $selected = ($generoEdit['id'] == $row['genero']) ? 'selected' : '';
                                            echo "<option value='" . $generoEdit['id'] . "' $selected>" . $generoEdit['genero'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="text" name="descricao" value="<?=$row['descricao'];?>"></td>
                            <td><input type="submit" value="Alterar"></td>
                        </form>

                        <form method="post" action="apagarFilme.php">
                            <input type="hidden" name="id" value="<?=$row['id'];?>">
                            <td><input type="submit" value="Apagar" onclick="return confirm('Tem certeza que deseja apagar este filme?');"></td>
                        </form>
                    </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align: center;'>Nenhum filme cadastrado</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>