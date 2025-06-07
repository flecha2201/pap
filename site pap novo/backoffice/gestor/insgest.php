<?php
$user=$_REQUEST['username'];
$pass=$_REQUEST['password'];
$id_t= $_POST['id_tipog'];
$sql="insert into gestor (id_tipog, username, password) values ('$id_t', '$user','$pass')";
//echo $sql;
$lig->query($sql) or die("ERRO:Inserção na tabela gestores");
echo "Gestor com o ID:",$lig->insert_id;
echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=lisgest>";
?> 