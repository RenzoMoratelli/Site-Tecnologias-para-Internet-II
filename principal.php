
<?php

include("valida.php");



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
                    Conteúdo Principal
                </div>
            </div>
        </div>
    </body>
    </html>
