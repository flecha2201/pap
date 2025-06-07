<?php
// Receber dados do formulário
$id_categoria = $_REQUEST['id_categoria'];
$id_produto = $_REQUEST['id_produto'];

// SQL para inserir dados na tabela categoria_produtos
$sql = "INSERT INTO categoria_produtos (id, id_prod) VALUES ('$id_categoria', '$id_produto')";

// Executar a query

$lig->query($sql) or die("ERRO: Inserção na tabela categoria_produtos");

// Exibir mensagem de sucesso
echo "Categoria de Produto inserida com sucesso!";

// Redirecionar após 1 segundo
echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=liscatprod'>";
?>
