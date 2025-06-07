<?php
    session_start(); 

$u = $_REQUEST['email'];
$p = md5($_REQUEST['Password']);

// Executa a query para procurar o email e o hash da password
$sql = "SELECT * FROM utilizador WHERE email = '$u' AND password = '$p'";
$res = $lig->query($sql);

if ($res->num_rows == 1) {
    $lin = $res->fetch_array();
    $_SESSION['nome_completo'] = $lin['nome_completo'];
    $_SESSION['email'] = $lin['email'];
    $_SESSION['data_nasc'] = $lin['data_nasc'];
    $_SESSION['nmr_tel'] = $lin['nmr_tel'];
    $_SESSION['morada'] = $lin['morada'];
    $_SESSION['cod_postal'] = $lin['cod_postal'];
    $_SESSION['username'] = $lin['username'];
    $_SESSION['foto_ut'] = $lin['foto_ut'];
    $_SESSION['NIF'] = $lin['NIF'];
    echo "<meta http-equiv=refresh content=0;URL=index.php?cmd=home1>";
} else {
    echo "<meta http-equiv=refresh content=0;URL=index.php?cmd=form-login>";
}
?>
