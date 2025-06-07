<?php
$c = $_REQUEST['cod_categoria'];
$sql = "DELETE FROM categorias WHERE cod_categoria = $c";

if (!$lig->query($sql)) {
    echo "Erro ao apagar na tabela Categorias<br>";
    echo "Número erro:", $lig->errno, "<br>";
    echo "Descrição erro:", $lig->error;
    ?>
    <form class="form-horizontal" method="POST" action="index.php?cmd=liscat">
        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default alert-danger">Voltar</button>
            </div>
        </div>
    </form>
<?php
} else {
    echo "Categoria eliminada com sucesso.";
    echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=liscat>";
}
?>
