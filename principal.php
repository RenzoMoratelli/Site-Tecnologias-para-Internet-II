
<?php

include("valida.php");



?>


<html>
    <head>
        <link rel="stylesheet" href="style_principal.css">
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
                    <a href="cadastroUsuarios.php">Cadastro de Usuários</a>
                </div>
                <div class="conteudo">
                    Conteúdo Principal
                </div>
            </div>
        </div>
    </body>
    </html>
