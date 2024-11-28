<?php
$localhost = "127.0.0.1";
$user = "root";
$pass = "";
$instancia = "db_cliente";
$conn = new mysqli($localhost,$user,$pass,$instancia);
if($conn->connecct_error){

} else{
  $nome  = filter_input(INPUT_POST,' nome');
  $email = filter_input(INPUT_POST,'email');
  
  $sqlInsert = "INSERT INTO usuario (nome,email) values(?,?)";
  $stmt = $conn->prepare($sqlInser);
  $stmt->bind_paraam('ss',$nome, $email);
  if($stmt->execute()){
    echo $stmt->insert_id;
    }

}