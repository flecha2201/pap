<head>
    <title>Eliminar Utilizador</title>
</head>
<?php
    $email = $_REQUEST['email'];
    
    // Iniciar a transação
    $lig->begin_transaction();

    try {
        // Primeiro, deletar todos os favoritos associados aos produtos do utilizador
        $sql_favoritos = "DELETE FROM favoritos WHERE id_prod IN (SELECT id_prod FROM Produtos WHERE email = '$email')";
        if (!$lig->query($sql_favoritos)) {
            throw new Exception("Erro ao deletar de favoritos: " . $lig->error);
        }

        // Em seguida, deletar as relações de categoria com os produtos do utilizador
        $sql_categoria_produtos = "DELETE FROM categoria_produtos WHERE id_prod IN (SELECT id_prod FROM Produtos WHERE email = '$email')";
        if (!$lig->query($sql_categoria_produtos)) {
            throw new Exception("Erro ao deletar de categoria_produtos: " . $lig->error);
        }

        // Deletar as faturas associadas ao email
        $sql_fatura = "DELETE FROM fatura WHERE email = '$email'";
        if (!$lig->query($sql_fatura)) {
            throw new Exception("Erro ao deletar de fatura: " . $lig->error);
        }

        // Finalmente, deletar os produtos associados ao email do utilizador
        $sql_produtos = "DELETE FROM Produtos WHERE email = '$email'";
        if (!$lig->query($sql_produtos)) {
            throw new Exception("Erro ao deletar produtos: " . $lig->error);
        }

        // Deletar o utilizador após deletar os registos dependentes
        $sql_utilizador = "DELETE FROM utilizador WHERE email = '$email'";
        if (!$lig->query($sql_utilizador)) {
            throw new Exception("Erro ao deletar utilizador: " . $lig->error);
        }

        // Commit da transação se tudo foi bem
        $lig->commit();
        echo "Utilizador eliminado com sucesso.";
        echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisut'>";

    } catch (Exception $e) {
        // Se ocorrer um erro, reverter a transação
        $lig->rollback();
        echo "Erro ao eliminar utilizador<br>";
        echo "Número erro: " . $lig->errno . "<br>";
        echo "Descrição erro: " . $e->getMessage() . "<br>";
        ?>
        <form class="form-horizontal" method="POST" action="index.php?cmd=lisut">
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default alert-danger">Voltar</button>
                </div>
            </div>
        </form>
        <?php
    }
?>
