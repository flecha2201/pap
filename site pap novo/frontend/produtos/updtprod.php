<?php
$id_prod = $_REQUEST['id_prod'];
$titulo = $_REQUEST['titulo'];
$size = $_REQUEST['size'];
$preco = $_REQUEST['preco'];
$descricao = $_REQUEST['descricao'];
$id_categoria = $_REQUEST['id_categoria']; // Recebe o id da categoria para atualizar

// Atualizar a foto principal, se fornecida
if (!empty($_FILES['nova_foto_principal']['name'])) {
    $foto_principal = $_FILES['nova_foto_principal']['name'];
    $temp_path = $_FILES['nova_foto_principal']['tmp_name'];
    $dest = "../comum/images/prod/" . $foto_principal;

    if (move_uploaded_file($temp_path, $dest)) {
        $sql_update_foto_principal = "UPDATE Produtos SET foto_prod = '$dest' WHERE id_prod = '$id_prod'";
        $lig->query($sql_update_foto_principal) or die("ERRO: Atualização da foto principal falhou.");
    }
}

// Atualizar os outros detalhes do produto, incluindo a categoria
$sql = "UPDATE Produtos 
        SET titulo = '$titulo', 
            size = '$size', 
            preco = '$preco', 
            descricao = '$descricao', 
            id_categoria = '$id_categoria'  -- Atualizando o campo de categoria
        WHERE id_prod = '$id_prod'";
$lig->query($sql) or die("ERRO: Alteração da tabela Produtos");

// Inserir novas imagens secundárias, se fornecidas
if (!empty($_FILES['novas_imagens']['name'][0])) {
    foreach ($_FILES['novas_imagens']['tmp_name'] as $key => $tmp_name) {
        $filename = $_FILES['novas_imagens']['name'][$key];
        $temp_path = $_FILES['novas_imagens']['tmp_name'][$key];
        $dest = "../comum/images/prod/" . $filename;

        if (move_uploaded_file($temp_path, $dest)) {
            $sql_img = "INSERT INTO prod_imgs (id_produto, caminho_img) VALUES ('$id_prod', '$dest')";
            $lig->query($sql_img) or die("ERRO: Inserção na tabela prod_imgs");
        }
    }
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
    <h2>Produto editado com sucesso!</h2>
    <p>O seu produto foi editado com sucesso. Você será redirecionado em breve.</p>
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
