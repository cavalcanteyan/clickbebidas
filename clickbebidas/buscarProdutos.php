<?php
$host = 'localhost';
$db = 'db_cliente';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Erro na conexão']));
}

$query = isset($_GET['query']) ? $_GET['query'] : '';
$sql = "SELECT * FROM produto WHERE nome LIKE '%$query%'"; // Exemplo de filtro

$result = $conn->query($sql);
$produtos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($produtos);

$conn->close();
?>
