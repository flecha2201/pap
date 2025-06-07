<?php
// Obter o email do utilizador e o ID do produto dos parâmetros da URL
$email = $_REQUEST['email'];
$id_prod = $_REQUEST['id_prod'];

// Consulta SQL para eliminar o favorito
$sql = "DELETE FROM favoritos WHERE email = '$email' AND id_prod = '$id_prod'";

if ($lig->query($sql)) {
    // Exibe mensagem de sucesso e redireciona para a listagem de favoritos
    echo "Favorito removido com sucesso.";
    echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisfav'>";
} else {
    // Exibe mensagem de erro se houver algum problema ao eliminar o favorito
    echo "Erro ao remover favorito<br>";
    echo "Número erro: " . $lig->errno . "<br>";
    echo "Descrição erro: " . $lig->error;
}
?>
