<?php
// Verificar se o parâmetro 'id_img' foi passado (ID da imagem)
$id_img = isset($_GET['id_img']) ? intval($_GET['id_img']) : null;

if ($id_img) {
    // Obter o caminho da imagem a ser excluída
    $sql = "SELECT caminho_img FROM prod_imgs WHERE id_img = '$id_img'";
    $res = $lig->query($sql);
    
    if ($res && $res->num_rows > 0) {
        $linha = $res->fetch_array();
        $caminho_img = $linha['caminho_img'];
        
        // Verificar se a imagem existe no servidor e tentar deletá-la
        if (file_exists($caminho_img)) {
            if (unlink($caminho_img)) {
                // Imagem excluída com sucesso, agora deletar o registro no banco de dados
                $sql_delete = "DELETE FROM prod_imgs WHERE id_img = '$id_img'";
                if ($lig->query($sql_delete)) {
                    echo "Imagem excluída com sucesso!";
                } else {
                    echo "Erro ao remover o registro da tabela.";
                }
            } else {
                echo "Erro ao excluir o arquivo de imagem.";
            }
        } else {
            echo "Arquivo de imagem não encontrado no servidor.";
        }
    } else {
        echo "Imagem não encontrada no banco de dados.";
    }
} else {
    echo "ID da imagem não especificado.";
}

// Redirecionar após 2 segundos
echo "<meta http-equiv='refresh' content='2;URL=index.php?cmd=edprod&id_prod=" . $_GET['id_prod'] . "'>";
?>
