<?php
session_start();
if (isset($_POST['acao'])) {
    $senha = md5( $_POST['senha'] );
    $email = $_POST['email'];
    include "usuario.class.php";
    $usuario = new Usuario();
    
    $user = $usuario->checkUserPass($email, $senha);

    if ( empty($user) ) {
        echo "
            <script>
                alert('Usuário ou Senha inválidos!');
                window.location.href='login.php'; // Redireciona para a página de login
            </script>";
    } else {
        $_SESSION['usuario'] = $user["nome"]; 
       
        header("Location: home.php"); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="stylo.css/estilo_login.css">
</head>
<body>
    <div class="login-container">
        <div class="background"></div>
        <div class="login-form">
            <h2>Acesse sua conta</h2>
            <form action="" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="hidden" name="acao" value="login"> 
                <button type="submit">ENTRAR</button>
                <a href="cadastrousuario.php">Não tem uma conta?</a>
            </form>
        </div>
    </div>
</body>
</html>
    