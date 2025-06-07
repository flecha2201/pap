<?php
// Receber dados do formulário
$nome_categoria = $_REQUEST['nome_categoria'];
$pai = isset($_REQUEST['pai']) && $_REQUEST['pai'] !== '' ? $_REQUEST['pai'] : 'NULL';

// SQL para inserir dados na tabela categorias
$sql = "INSERT INTO categorias (nome_categoria, pai) VALUES ('$nome_categoria', $pai)";

// Executar a query
$lig->query($sql) or die("ERRO: Inserção na tabela categorias");

// Exibir mensagem de sucesso e o ID da categoria inserida
echo "Categoria inserida com o ID: ", $lig->insert_id;

// Redirecionar após 1 segundo
echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=liscat'>";
?>
