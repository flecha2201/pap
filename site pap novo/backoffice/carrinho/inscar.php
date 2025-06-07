<?php
$email = $_SESSION['email']; // Assumindo que o email do utilizador está guardado na sessão
$id_prod = $_REQUEST['id_prod'];
$quantidade = $_REQUEST['quantidade'];
$data_adicao = date('Y-m-d H:i:s');

// Inserir produto no carrinho
$sql = "INSERT INTO carrinho (email, id_prod, quantidade, data_adicao) 
        VALUES ('$email', '$id_prod', '$quantidade', '$data_adicao')";
$lig->query($sql) or die("Erro ao inserir no carrinho: " . $lig->error);

echo "Produto adicionado ao carrinho!";
echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=liscar'>";
?>
