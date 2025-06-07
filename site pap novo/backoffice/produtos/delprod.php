<?php
// Verifique se o id_prod está definido
if (isset($_REQUEST['id_prod'])) {
    $id_prod = intval($_REQUEST['id_prod']); // Converte o id_prod para inteiro

    // Eliminar as fotos secundárias associadas ao produto
    $sql_imgs = "SELECT caminho_img FROM prod_imgs WHERE id_produto = $id_prod";
    $res_imgs = $lig->query($sql_imgs);
    while ($row_img = $res_imgs->fetch_assoc()) {
        $caminho_img = $row_img['caminho_img'];
        if (file_exists($caminho_img)) {
            unlink($caminho_img); // Remove o arquivo físico
        }
    }
    // Depois de excluir as imagens fisicamente, remova os registos da tabela prod_imgs
    $sql_del_imgs = "DELETE FROM prod_imgs WHERE id_produto = $id_prod";
    $lig->query($sql_del_imgs);

    // Eliminar a foto principal associada ao produto
    $sql_foto_principal = "SELECT foto_prod FROM Produtos WHERE id_prod = $id_prod";
    $res_foto_principal = $lig->query($sql_foto_principal);
    if ($res_foto_principal->num_rows > 0) {
        $row_foto = $res_foto_principal->fetch_assoc();
        $foto_principal = $row_foto['foto_prod'];
        if (file_exists($foto_principal)) {
            unlink($foto_principal); // Remove o arquivo físico
        }
    }

    // Eliminar registos relacionados em outras tabelas (se necessário)
    
    $lig->query("DELETE FROM carrinho WHERE id_prod = $id_prod");
    $lig->query("DELETE FROM favoritos WHERE id_prod = $id_prod");

    // Finalmente, eliminar o produto da tabela Produtos
    $sql_del_produto = "DELETE FROM Produtos WHERE id_prod = $id_prod";
    if ($lig->query($sql_del_produto)) {
        echo "Produto eliminado com sucesso.";
        echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisprod'>"; // Redireciona para a listagem de produtos
    } else {
        // Exibe erro se a eliminação falhar
        echo "Erro ao eliminar produto<br>";
        echo "Número erro: " . $lig->errno . "<br>";
        echo "Descrição erro: " . $lig->error;
    }
} else {
    echo "Opção inválida: id_prod não especificado."; // Mensagem de erro se o id_prod não estiver presente
}
?>
