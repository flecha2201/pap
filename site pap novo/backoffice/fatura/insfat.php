<?php
// insfatura.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$emailC = $_REQUEST['emailC'];
$valor = $_REQUEST['valor'];
$Nome = $_REQUEST['Nome'];
$Telefone = $_REQUEST['Telefone'];
$Morada = $_REQUEST['Morada'];
$CPostal = $_REQUEST['CPostal'];
$NIF = $_REQUEST['NIF'];
$emailV = $_REQUEST['emailV'];
$id_encomenda = $_REQUEST['idE'];

$sql = "INSERT INTO fatura (emailC, valor, Nome, Telefone, Morada, CPostal, NIF, emailV, id_encomenda)
        VALUES ('$emailC', '$valor', '$Nome', '$Telefone', '$Morada', '$CPostal', '$NIF', '$emailV', '$id_encomenda')";
        
if ($lig->query($sql)) {
    $id_fatura = $lig->insert_id;
    echo "Fatura inserida com o ID: " . $id_fatura;
    echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisfat'>";
} else {
    echo "ERRO: Inserção na tabela fatura";
}
?>
