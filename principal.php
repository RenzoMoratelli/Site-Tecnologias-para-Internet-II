
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
                <div class="_nome">
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
                    Conteúdo Principal
                </div>
            </div>
        </div>
    </body>
    </html>
