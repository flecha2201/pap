<?php
$id_prod = $_REQUEST['id_prod'];

// Buscar dados do produto
$sql = "SELECT * FROM Produtos WHERE id_prod = '$id_prod'";
$res = $lig->query($sql);
$lin = $res->fetch_array();

// Buscar imagens associadas ao produto (fotos secundárias)
$sql_imgs = "SELECT * FROM prod_imgs WHERE id_produto = '$id_prod'";
$res_imgs = $lig->query($sql_imgs);
?>
<head>
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<h1 align="center" class="text-center mt-5 mb-3">Editar Produto</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" enctype="multipart/form-data" action="index.php?cmd=updtprod&id_prod=<?php echo $id_prod; ?>">
                <div class="mb-3">
                    <label for="Titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="Titulo" name="titulo" value="<?php echo $lin['titulo']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="Descricao" name="descricao" rows="4" required><?php echo $lin['descricao']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="Size" class="form-label">Tamanho</label>
                    <input type="text" class="form-control" id="Size" name="size" value="<?php echo $lin['size']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Preco" class="form-label">Preço</label>
                    <input type="number" class="form-control" id="Preco" name="preco" value="<?php echo $lin['preco']; ?>" required>
                </div>
				<div class="mb-3">
                    <label for="Categoria" class="form-label">Categoria</label>
                    <select  class="form-select" id="id_categoria" name="id_categoria" required>
                <option value="">Selecione uma Categoria</option>
                <?php
                // Código PHP para buscar as categorias da base de dados
                $sql = "SELECT cod_categorias, nome_categoria FROM categorias ORDER BY cod_categorias ASC";
                $result = $lig->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['cod_categorias']}'>{$row['nome_categoria']}</option>";
                }
                ?>
            </select>
                </div>

                <!-- Mostrar e alterar a foto principal -->
                <h4>Foto Principal</h4>
                <div class="mb-3">
                    <img src="<?php echo $lin['foto_prod']; ?>" alt="Foto Principal" style="width: 150px; height: 150px; object-fit: cover; display: block; margin-bottom: 10px;">
                    <label for="nova_foto_principal" class="form-label">Alterar Foto Principal</label>
                    <input type="file" class="form-control" id="nova_foto_principal" name="nova_foto_principal">
                </div>

                <!-- Visualizar imagens secundárias existentes -->
                <h4>Fotos Secundárias</h4>
                <div class="mb-3">
                    <?php while ($img = $res_imgs->fetch_assoc()) { ?>
                        <div class="d-flex align-items-center mb-2">
                            <img src="<?php echo $img['caminho_img']; ?>" alt="Imagem Secundária" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;">
                            <a href="index.php?cmd=del_img&id_img=<?php echo $img['id_img']; ?>&id_prod=<?php echo $id_prod; ?>" class="btn btn-danger btn-sm">Remover</a>
                        </div>
                    <?php } ?>
                </div>

                <!-- Adicionar novas imagens -->
                <div class="mb-3">
                    <label for="novas_imagens" class="form-label">Adicionar Novas Imagens Secundárias</label>
                    <input type="file" class="form-control" id="novas_imagens" name="novas_imagens[]" multiple>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Modificar Produto</button>
                </div>
            </form>
        </div>
    </div>
</div>
