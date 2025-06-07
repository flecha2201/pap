<?php
$q=$_GET["q"]; // recebe uma parâmetro por GET
$lig= new mysqli ("localhost", "rafael40112", "Psi32425", "rafael40112"); 
$s="select * from utilizador where username = '$q'";
$res=$lig->query($s); 
$l=$res->fetch_array();
if($l)
	echo "Nome já existe";
?>