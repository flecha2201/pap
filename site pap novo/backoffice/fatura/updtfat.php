<?php
// updtfatura.php
$id_fatura = $_REQUEST['id_fatura'];
$emailC = $_REQUEST['emailC'];
$valor = $_REQUEST['valor'];
$Nome = $_REQUEST['Nome'];
$Telefone = $_REQUEST['Telefone'];
$Morada = $_REQUEST['Morada'];
$CPostal = $_REQUEST['CPostal'];
$NIF = $_REQUEST['NIF'];
$emailV = $_REQUEST['emailV'];

$sql = "UPDATE fatura 
        SET emailC='$emailC', valor='$valor', Nome='$Nome', Telefone='$Telefone', Morada='$Morada', CPostal='$CPostal', NIF='$NIF', emailV='$emailV'
        WHERE id_fatura='$id_fatura'";
        
if ($lig->query($sql)) {
    echo "Fatura alterada com sucesso!";
    echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisfat'>";
} else {
    echo "ERRO: Alteração na tabela fatura";
}
?>
