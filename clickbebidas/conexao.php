<?php
$host = "localhost"
$username = "root";
$password = "";
$dbName = "db_cliente";
$conn = new mysqli($host, $username, $password, $dbName);
if ($conn->connect_error){
    die("Erro ao conectar ao banco de dados:" .$conn->connect_error);
    exit;
}