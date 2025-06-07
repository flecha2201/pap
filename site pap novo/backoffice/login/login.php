<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão apenas se não estiver já iniciada
}

$u = $_REQUEST['email'];
$p = md5($_REQUEST['Password']);

// Executa a query para procurar o email e o hash da password
$sql = "SELECT * FROM utilizador WHERE email = '$u' AND password = '$p'";
$res = $lig->query($sql);

if ($res->num_rows == 1) {
    $lin = $res->fetch_array();
    $_SESSION['nome'] = $lin['nome_completo'];
    $_SESSION['email'] = $lin['email'];
    $_SESSION['tipo'] = $lin['CodTipoUt'];
    echo "<meta http-equiv=refresh content=0;URL=index.php?cmd=home>";
} else {
    echo "<meta http-equiv=refresh content=0;URL=index.php?cmd=form-login>";
}
?>
