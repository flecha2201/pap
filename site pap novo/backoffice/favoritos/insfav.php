<?php
// Recebe os dados do formulário
$email = $_REQUEST['email'];
$id_prod = $_REQUEST['id_prod'];

// Inserir na tabela favoritos
$sql = "INSERT INTO favoritos (email, id_prod) VALUES ('$email', '$id_prod');";
$lig->query($sql) or die("ERRO: Inserção na tabela favoritos");

// Exibe mensagem de sucesso e redireciona
echo "Favorito adicionado com sucesso!";
echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisfav'>";
?>
