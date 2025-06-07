<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Receber dados do formulário
$titulo = $_REQUEST['titulo'];
$descricao = $_REQUEST['descricao'];
$size = $_REQUEST['size'];
$preco = $_REQUEST['preco'];
$email = $_REQUEST['email'];
$cod_categorias = $_REQUEST['cod_categoria']; 
$data_add = date('Y-m-d');

// Obter cod_categorias baseado no cod_categorias
$sqlCategoria = "SELECT cod_categorias FROM categorias WHERE cod_categorias = '$cod_categorias'";
$resultCategoria = $lig->query($sqlCategoria);

if ($resultCategoria->num_rows > 0) {
    $categoria = $resultCategoria->fetch_assoc()['cod_categorias'];

    // Verificar se a foto principal foi enviada e se não houve erro
    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $fo = $_FILES['foto']['tmp_name'];
        $foto = $_FILES['foto']['name'];
        $dest = "../comum/images/prod/" . $foto;

        if (copy($fo, $dest)) {
            // Inserção com foto principal
            $sql = "INSERT INTO Produtos (titulo, descricao, size, preco, foto_prod, email, id_categoria, data_add)
                    VALUES ('$titulo', '$descricao', '$size', '$preco', '$dest', '$email', '$categoria', '$data_add')";
            $lig->query($sql) or die("ERRO: Inserção na tabela Produtos");
            $id_produto = $lig->insert_id; // ID do produto inserido

            // Inserir imagens adicionais na tabela prod_imgs
            if (!empty($_FILES['fotos_secundarias']['name'][0])) {
                foreach ($_FILES['fotos_secundarias']['tmp_name'] as $index => $tmp_name) {
                    $nome_foto_sec = $_FILES['fotos_secundarias']['name'][$index];
                    $dest_sec = "../comum/images/prod/" . $nome_foto_sec;

                    if (copy($tmp_name, $dest_sec)) {
                        $sqlImg = "INSERT INTO prod_imgs (id_produto, caminho_img) VALUES ('$id_produto', '$dest_sec')";
                        $lig->query($sqlImg) or die("ERRO: Inserção na tabela prod_imgs");
                    }
                }
            }

            echo "Produto inserido com o ID: " . $id_produto;
            echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisprod'>";
        } else {
            echo "Foto principal não carregada e produto não registado.";
            echo "<meta http-equiv='refresh' content='2;URL=index.php?cmd=lisprod'>";
        }
    } else {
        // Inserção sem foto principal
        $sql = "INSERT INTO Produtos (titulo, descricao, size, preco, email, id_categoria, data_add)
                VALUES ('$titulo', '$descricao', '$size', '$preco', '$email', '$categoria', '$data_add')";
        $lig->query($sql) or die("ERRO: Inserção na tabela Produtos");
        $id_produto = $lig->insert_id;

        // Inserir imagens adicionais na tabela prod_imgs (caso existam)
        if (!empty($_FILES['fotos_secundarias']['name'][0])) {
            foreach ($_FILES['fotos_secundarias']['tmp_name'] as $index => $tmp_name) {
                $nome_foto_sec = $_FILES['fotos_secundarias']['name'][$index];
                $dest_sec = "../comum/images/prod/" . $nome_foto_sec;

                if (copy($tmp_name, $dest_sec)) {
                    $sqlImg = "INSERT INTO prod_imgs (id_produto, caminho_img) VALUES ('$id_produto', '$dest_sec')";
                    $lig->query($sqlImg) or die("ERRO: Inserção na tabela prod_imgs");
                }
            }
        }

        echo "Produto inserido com o ID: " . $id_produto;
        echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisprod'>";
    }
} else {
    echo "Categoria não encontrada. Produto não registrado.";
}
?>
