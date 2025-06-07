<?php
// Obter os dados do formulário
$email = $_REQUEST['email']; // Email do utilizador cujo favorito será atualizado
$id_prod_antigo = $_REQUEST['id_prod_antigo']; // ID do produto antigo (o favorito atual)
$id_prod_novo = $_REQUEST['id_prod_novo']; // Novo ID do produto

// Atualizar o produto favorito para o utilizador
$sql = "UPDATE favoritos SET id_prod = '$id_prod_novo' WHERE email = '$email' AND id_prod = '$id_prod_antigo'";
echo $sql;
if ($lig->query($sql)) {
    // Exibe mensagem de sucesso e redireciona para a listagem de favoritos
    echo "Favorito atualizado com sucesso.";
    echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisfav'>";
} else {
    // Exibe mensagem de erro se a atualização falhar
    echo "Erro ao atualizar favorito<br>";
    echo "Número erro: " . $lig->errno . "<br>";
    echo "Descrição erro: " . $lig->error;
}
?>
