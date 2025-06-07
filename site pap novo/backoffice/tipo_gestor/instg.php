<?php
$nome_tipos=$_REQUEST['nome_tipo'];
$sql="insert into tipo_gestor (nome_tipo) values ('$nome_tipos')";
$lig->query($sql) or die("ERRO:Inserção na tabela tipo de gestor");
echo "Gestor inserido com o ID:",$lig->insert_id;
echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=listg>";
?>