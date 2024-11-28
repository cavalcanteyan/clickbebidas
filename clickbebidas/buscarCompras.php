<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Usuário não está logado.");
}

$host = 'localhost';
$db = 'db_cliente';
$user = 'root';
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT c.id AS compra_id, c.data_compra, ic.quantidade, p.nome, p.preco 
        FROM compras c 
        JOIN itens_compra ic ON c.id = ic.id_compra 
        JOIN produtos p ON ic.id_produto = p.id 
        WHERE c.id_usuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$compras = [];
while ($row = $result->fetch_assoc()) {
    $compras[] = $row;
}

header('Content-Type: application/json');
echo json_encode($compras);

$conn->close();
?>
