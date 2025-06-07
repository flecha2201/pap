<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
$username=$_REQUEST['username'];
$email=$_REQUEST['email'];
$password=md5($_REQUEST['password']);
$foto="../comum/images/ut/default.png";
$sql="insert into utilizador (username, email, password, foto_ut) values ('$username', '$email', '$password', '$foto')";
//echo $sql;

$lig->query($sql) or die("ERRO:Inserção na tabela Utilizadores");
echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=form-login>";
?>