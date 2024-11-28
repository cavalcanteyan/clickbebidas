<?php
$host = 'localhost';
$db = 'db_cliente';
$user = 'root';
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Função de exclusão de produtos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    $id = $_POST['id'];

    // Consultar a imagem do produto para remoção do diretório
    $sql = "SELECT imagem FROM produto WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagemNome = $row['imagem'];
        
        // Remover o produto do banco de dados
        $sql = "DELETE FROM produto WHERE id = $id";
        
        if ($conn->query($sql) === TRUE) {
            // Excluir a imagem do diretório
            unlink("imagens/" . $imagemNome);
            echo "<script>alert('Produto excluído com sucesso!'); window.location.href='cadastrarProduto.html';</script>";
        } else {
            echo "<script>alert('Erro ao excluir produto: " . $conn->error . "'); window.location.href='cadastrarProduto.html';</script>";
        }
    } else {
        echo "<script>alert('Produto não encontrado.'); window.location.href='cadastrarProduto.html';</script>";
    }
}

// Função de cadastro de produtos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $imagem = $_FILES['imagem'];

    // Renomeando o arquivo da imagem
    $imagemNome = time() . '-' . basename($imagem['name']);
    $imagemPath = "imagens/" . $imagemNome;

    if (move_uploaded_file($imagem['tmp_name'], $imagemPath)) {
        $sql = "INSERT INTO produto (nome, descricao, preco, categoria, imagem) VALUES ('$nome', '$descricao', '$preco', '$categoria', '$imagemNome')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href='cadastrarProduto.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar produto: " . $conn->error . "'); window.location.href='cadastrarProduto.html';</script>";
        }
    } else {
        echo "<script>alert('Erro ao fazer upload da imagem.'); window.location.href='cadastrarProduto.html';</script>";
    }
}

// Listar produtos
$sql = "SELECT * FROM produto";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
</head>
<body>

<h2>Cadastrar Produto</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nome" placeholder="Nome" required>
    <textarea name="descricao" placeholder="Descrição" required></textarea>
    <input type="text" name="preco" placeholder="Preço" required>
    <input type="text" name="categoria" placeholder="Categoria" required>
    <input type="file" name="imagem" required>
    <button type="submit" name="cadastrar">Cadastrar</button>
</form>

<h2>Produtos Cadastrados</h2>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "Nome: " . $row['nome'] . "<br>";
        echo "Descrição: " . $row['descricao'] . "<br>";
        echo "Preço: " . $row['preco'] . "<br>";
        echo "Categoria: " . $row['categoria'] . "<br>";
        echo "<img src='imagens/" . $row['imagem'] . "' alt='" . $row['nome'] . "' style='width: 100px;'><br>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='excluir'>Excluir</button>";
        echo "</form>";
        echo "</div><hr>";
    }
} else {
    echo "<p>Nenhum produto encontrado. Cadastre um novo produto!</p>";
}

$conn->close();
?>

</body>
</html>
