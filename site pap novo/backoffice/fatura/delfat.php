<?php
// delfatura.php
if (isset($_REQUEST['id_fatura'])) {
    $id_fatura = intval($_REQUEST['id_fatura']);
    
    $sql_del = "DELETE FROM fatura WHERE id_fatura = $id_fatura";
    if ($lig->query($sql_del)) {
        echo "Fatura eliminada com sucesso.";
        echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisfat'>";
    } else {
        echo "Erro ao eliminar fatura";
    }
} else {
    echo "Opção inválida: id_fatura não especificado.";
}
?>
