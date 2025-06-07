<?php
// Conexão com a base de dados
include 'ligamysql.php';

// Receber o ID da categoria e ID do produto
$id = $_REQUEST['id'];
$id_produto = $_REQUEST['id_produto'];

// SQL para eliminar a categoria do produto
$sql = "DELETE FROM categoria_produtos WHERE id = '$id' AND id_prod = '$id_produto'";

if ($lig->query($sql)) {
    echo "Categoria de produto eliminada com sucesso.";
    echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=liscatprod'>";
} else {
    echo "Erro ao eliminar categoria de produto<br>";
    echo "Número erro: " . $lig->errno . "<br>";
    echo "Descrição erro: " . $lig->error;
}
?>
