<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Receber dados do formulário
$email = $_REQUEST['email'];
$username = $_REQUEST['username'];
$nmr_tel = $_REQUEST['nmr_tel'];

// Atualiza os dados do utilizador, incluindo CodTipoUt
$sql = "UPDATE utilizador 
        SET  
            username = '$username',  
            nmr_tel = '$nmr_tel',
        WHERE email = '$email'";

$lig->query($sql) or die("ERRO: alteração da tabela Utilizador");
echo "Alteração efetuada com sucesso!";
echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisut'>";
?>
