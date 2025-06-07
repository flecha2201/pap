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
        
        // Gerar nome único para a foto principal
        $foto_unica = uniqid('prod_', true) . '.' . pathinfo($foto, PATHINFO_EXTENSION);
        $dest = "../comum/images/prod/" . $foto_unica;

        // Verificar se o arquivo já existe, caso em que gerar um novo nome único
        while (file_exists($dest)) {
            $foto_unica = uniqid('prod_', true) . '.' . pathinfo($foto, PATHINFO_EXTENSION);
            $dest = "../comum/images/prod/" . $foto_unica;
        }

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
                    
                    // Gerar nome único para as fotos secundárias
                    $nome_foto_sec_unico = uniqid('prod_', true) . '.' . pathinfo($nome_foto_sec, PATHINFO_EXTENSION);
                    $dest_sec = "../comum/images/prod/" . $nome_foto_sec_unico;

                    // Verificar se o arquivo já existe
                    while (file_exists($dest_sec)) {
                        $nome_foto_sec_unico = uniqid('prod_', true) . '.' . pathinfo($nome_foto_sec, PATHINFO_EXTENSION);
                        $dest_sec = "../comum/images/prod/" . $nome_foto_sec_unico;
                    }

                    if (copy($tmp_name, $dest_sec)) {
                        $sqlImg = "INSERT INTO prod_imgs (id_produto, caminho_img) VALUES ('$id_produto', '$dest_sec')";
                        $lig->query($sqlImg) or die("ERRO: Inserção na tabela prod_imgs");
                    }
                }
            }

        } else {
            echo "Foto principal não carregada e produto não registado.";
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
                
                // Gerar nome único para as fotos secundárias
                $nome_foto_sec_unico = uniqid('prod_', true) . '.' . pathinfo($nome_foto_sec, PATHINFO_EXTENSION);
                $dest_sec = "../comum/images/prod/" . $nome_foto_sec_unico;

                // Verificar se o arquivo já existe
                while (file_exists($dest_sec)) {
                    $nome_foto_sec_unico = uniqid('prod_', true) . '.' . pathinfo($nome_foto_sec, PATHINFO_EXTENSION);
                    $dest_sec = "../comum/images/prod/" . $nome_foto_sec_unico;
                }

                if (copy($tmp_name, $dest_sec)) {
                    $sqlImg = "INSERT INTO prod_imgs (id_produto, caminho_img) VALUES ('$id_produto', '$dest_sec')";
                    $lig->query($sqlImg) or die("ERRO: Inserção na tabela prod_imgs");
                }
            }
        }

    }
} else {
    echo "Categoria não encontrada. Produto não registrado.";
}
?>



<?php
    if(isset($_SESSION['email']))
        require("./assets/html/menulogado.php");
    else
        require("./assets/html/menusemlogin.php");
?>


<br><br>
<div class="sucesso-container">
    <h2>Produto inserido com sucesso!</h2>
    <p>O seu produto foi inserido na ReVibe com sucesso. Você será redirecionado em breve.</p>
</div>
<br><br>




<script>
    setTimeout(function() {
        window.location.href = 'index.php?cmd=armario';
    }, 3000);
</script>

</body>
</html>

<style>
   

    /* Container de Sucesso */
    .sucesso-container {
        text-align: center;
        margin-top: 50px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .sucesso-container h2 {
        color: #2d8e4e;
    }

    .sucesso-container p {
        color: #555;
        font-size: 1.1em;
    }

  
</style>
