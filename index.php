<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style_index.css?v=1.0">
</head>
<body>
    <div class="retangulo">
    <h2>Sistema de Login</h2>
    <form method="POST" action="login.php">
        <label>Insira o seu CPF:</label>
        <input type="text" name="cpf" required><br><br>

        <label>Insira a sua Senha:</label>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Entrar</button>
        
    </form>
    </div>
    
</body>
</html>
