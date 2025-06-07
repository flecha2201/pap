<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifique se o id_prod está definido na requisição
if (!isset($_REQUEST['id_prod']) || !is_numeric($_REQUEST['id_prod'])) {
    echo "Opção inválida: id_prod não especificado ou inválido.";
    exit;
}

// Converte o id_prod para inteiro de forma segura
$id_prod = intval($_REQUEST['id_prod']);

// Mostrar o ID recebido para debugging
echo "ID do produto recebido: $id_prod<br>";

// Verificar se o ID é válido (maior que zero)
if ($id_prod > 0) {
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

    // Eliminar registos relacionados em outras tabelas
    $lig->query("DELETE FROM carrinho WHERE id_prod = $id_prod");
    $lig->query("DELETE FROM favoritos WHERE id_prod = $id_prod");

    // Finalmente, eliminar o produto da tabela Produtos
    $sql_del_produto = "DELETE FROM Produtos WHERE id_prod = $id_prod";
	echo $sql_del_produto;
    if ($lig->query($sql_del_produto)) {
        if ($lig->affected_rows > 0) {
            echo "Produto eliminado com sucesso.<br>";
			echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=armario'>"; // Redireciona para a listagem de produtos
        } else {
            echo "Nenhum registo eliminado. Verifica se o produto com id_prod = $id_prod existe.<br>";
        }
        echo $sql_del_produto;
    } else {
        echo "Erro ao eliminar produto.<br>";
        echo "Número erro: " . $lig->errno . "<br>";
        echo "Descrição erro: " . $lig->error;
    }
} else {
    echo "ID inválido: $id_prod. A eliminação foi cancelada.";
}
?>