<?php
session_start();
include "usuario.class.php";

if(isset($_POST['email'])) {
    $nome      = $_POST['nome'];
    $email     = $_POST['email'];
    $sobrenome = $_POST['sobrenome'];
    $senha     = md5( $_POST['senha'] );
    $perfil    = $_POST["perfil"];

    $usuario = new Usuario();
    $user = $usuario->insertUser($nome, $email, $senha,$sobrenome, $perfil);

    if( $user ){
        echo "<script>
                alert('Usuario cadastrado com sucesso!')
            </script>";   

            $user = $usuario->checkUser($email);
            
            $_SESSION['usuario'] = $user["nome"]; 
            header("Location: home.php"); 
    }else{
        echo "<script>
                alert('Erro ao cadastrar Usuario!')
             </script>";   
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>cadastro</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="stylo.css/estilo_cadastro.css">
</head>
<style>
    body{
        background-color: rgb(0, 0, 0);
        color:rgb(255, 255, 255);
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        font-size: 15px;
    }
</style>
<body>
    
    <body>
        <div class="login-container">
            <div class="background"></div>
            <div class="login-form">
                <h2>FAÇA SEU CADASTRO</h2>
                <form action = "" method = "post" >
                    <input type="text" placeholder="Nome"      name = "nome" required>
                    <input type="text" placeholder="Sobrenome" name = "sobrenome" required>
                    <input type="text" placeholder="Email"     name = "email" required>
                    <input type="password" placeholder="Senha" name = "senha" required>
                    
                    <select name="perfil">
                        <option value="1"> admin </option>
                        <option value="2"> comum</option>
                    </select>
                    <br><br> 
                    <input type="submit" name="acao" value = "Cadastrar"> 
    
                </form>
            </div>
        </div>
  
    <script src="script.js"></script>
</body>
</html>