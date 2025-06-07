<?php
// updtencomenda.php
$id_encomenda = $_REQUEST['id_encomenda'];
$id_prod = $_REQUEST['id_prod'];
$email_comprador = $_REQUEST['email_comprador'];
$email_vendedor = $_REQUEST['email_vendedor'];
$preco = $_REQUEST['preco'];
$estado = $_REQUEST['estado'];

$sql = "UPDATE encomendas 
        SET id_prod='$id_prod', email_comprador='$email_comprador', email_vendedor='$email_vendedor', preco='$preco', estado='$estado'
        WHERE id_encomenda='$id_encomenda'";
        
if ($lig->query($sql)) {
    echo "Encomenda alterada com sucesso!";
    echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisencomenda'>";
} else {
    echo "ERRO: Alteração na tabela encomendas";
}
?>
