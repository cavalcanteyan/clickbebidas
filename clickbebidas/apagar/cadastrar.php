<?php
include "usuario.class.php";
$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $nome      = $_POST['nome'];
    $email     = $_POST['email'];
    $sobrenome = $_POST['sobrenome'];
    $senha     = md5( $_POST['senha'] );
    $perfil    = $_POST["perfil"];

    echo "Nome: ".$nome. "<br>";
    echo "Email: ".$email. "<br>";
    echo "Sobrenome: ".$sobrenome. "<br>";
    echo "Senha: ".$senha. "<br>";
    echo "Perfil: ".$perfil;
}else{
    echo "nao tem nada";
}

exit;

$usuario -> insertUser($nome, $email, $senha, $perfil, $sobrenome);