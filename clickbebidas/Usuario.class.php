<?php

class Usuario {
    private $email;
    private $senha;
    private $perfil;
    private $pdo;

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    public function getPerfil() {
        return $this->perfil;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    function __construct() {
        $dns = "mysql:dbname=db_cliente;host=localhost";
        $user = "root";
        $pass = "";
        
        try {
            $this->pdo = new PDO($dns, $user, $pass);
            //$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Throwable $th) {
            echo "<script>alert('Banco indisponível. Tente mais tarde.');</script>";
        }
    }

                       
    function insertUser($nome, $email, $senha, $sobrenome, $perfil) {

        $sql = "INSERT INTO usuario set nome = :n, email = :e, senha = :s, perfil = :p, sobrenome = :z";
        $sql = $this->pdo->prepare($sql);
       
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", $senha); // Usando password_hash
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":z", $sobrenome);
        $sql->bindValue(":p", $perfil);

        if( $sql->execute() ){
            return true;
        }else{
            return false;
        };
    }

    function checkUser($email) {
        $sql = "SELECT * FROM usuario WHERE email = :e";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":e", $email);
        $sql->execute(); // Executar a consulta

        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        } else {
            return array();
        }
    }

    function checkUserPass($email, $senha) {
        $sql = "SELECT * FROM usuario WHERE email = :e";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":e", $email);
        $sql->execute(); // Executar a consulta
        
        if ($sql->rowCount() > 0) {
            $user = $sql->fetch();
            return $user;
        }else{
            return array();
        }
    }
}
