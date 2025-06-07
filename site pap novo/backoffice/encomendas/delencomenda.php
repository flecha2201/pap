<?php
// delencomenda.php
if (isset($_REQUEST['id_encomenda'])) {
    $id_encomenda = intval($_REQUEST['id_encomenda']);
    
    $sql_del = "DELETE FROM encomendas WHERE id_encomenda = $id_encomenda";
    if ($lig->query($sql_del)) {
        echo "Encomenda eliminada com sucesso.";
        echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisencomenda'>";
    } else {
        echo "Erro ao eliminar encomenda";
    }
} else {
    echo "Opção inválida: id_encomenda não especificado.";
}
?>
