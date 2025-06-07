<?php
// Recebe os dados do formulário
$emissor = $_REQUEST['emissor'];
$recetor = $_REQUEST['recetor'];
$conteudo = $_REQUEST['conteudo'];
$data = $_REQUEST['data'];
$email = $_REQUEST['email'];

// Inserir na tabela mensagens
$sql = "INSERT INTO mensagens (emissor, recetor, conteudo, data, email) 
        VALUES ('$emissor', '$recetor', '$conteudo', '$data', '$email');";
$lig->query($sql) or die("ERRO: Inserção na tabela mensagens");

// Exibe mensagem de sucesso e redireciona
echo "Mensagem enviada com sucesso!";
echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lismsg'>";
?>
