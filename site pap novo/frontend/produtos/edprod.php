<?php
session_start();
include './includes/ligamysql.php';

$id_prod = $_REQUEST['id_prod'];

// Buscar dados do produto
$sql = "SELECT * FROM Produtos WHERE id_prod = '$id_prod'";
$res1 = $lig->query($sql);
$lin1 = $res1->fetch_array();

// Buscar imagens secundárias
$sql_imgs = "SELECT * FROM prod_imgs WHERE id_produto = '$id_prod'";
$res_imgs = $lig->query($sql_imgs);
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<style>
    body {
            background: linear-gradient(135deg, var(--selago), var(--perano));
            min-height: 100vh;
        }

        .form-container {
            max-width: 600px;
            background: var(--link-water);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 5% auto;
        }

        .form-label {
            font-weight: bold;
            color: var(--royal-blue);
        }

        .form-control, .form-select {
            border: 2px solid var(--perfume);
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--portage);
            box-shadow: 0px 0px 5px var(--portage);
        }

        .btn-submit {
            background: var(--royal-blue);
            color: white;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
        }

        .btn-submit:hover {
            background: var(--perfume);
            color: var(--royal-blue);
        }

        .input-group-text {
            background: var(--perfume);
            color: white;
        }

        .img-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            display: block;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .center-text {
            text-align: center;
            color: var(--royal-blue);
        }
</style>
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
<body>

<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4" style="color: var(--royal-blue);">Editar Produto</h2>

        <form method="POST" enctype="multipart/form-data" action="index.php?cmd=updtprod&id_prod=<?php echo $id_prod; ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $lin1['titulo']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" required><?php echo $lin1['descricao']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="size" class="form-label">Tamanho</label>
                <input type="text" class="form-control" id="size" name="size" value="<?php echo $lin1['size']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço (€)</label>
                <input type="number" class="form-control" id="preco" name="preco" value="<?php echo $lin1['preco']; ?>" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select select2" id="id_categoria" name="id_categoria" required>
                    <option value="">Selecione uma Categoria</option>
                    <?php
                    $sql = "SELECT cod_categorias, nome_categoria FROM categorias ORDER BY nome_categoria ASC";
                    $result = $lig->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $selected = ($row['cod_categorias'] == $lin1['id_categoria']) ? 'selected' : '';
                        echo "<option value='{$row['cod_categorias']}' $selected>{$row['nome_categoria']}</option>";
                    }
                    ?>
                </select>
            </div>

            <script>
                $(document).ready(function() {
                    $('.select2').select2({
                        placeholder: "Selecione ou pesquise uma categoria...",
                        allowClear: true
                    });
                });
            </script>

            <!-- Foto Principal -->
            <h4>Foto Principal</h4>
            <div class="mb-3">
                <img src="<?php echo $lin1['foto_prod']; ?>" alt="Foto Principal" style="width: 150px; height: 150px; object-fit: cover; display: block; margin-bottom: 10px;">
                <label for="nova_foto_principal" class="form-label">Alterar Foto Principal</label>
                <input type="file" class="form-control" id="nova_foto_principal" name="nova_foto_principal">
            </div>

            <!-- Fotos Secundárias -->
            <h4>Fotos Secundárias</h4>
            <div class="mb-3">
                <?php while ($img = $res_imgs->fetch_assoc()) { ?>
                    <div class="d-flex align-items-center mb-2">
                        <img src="<?php echo $img['caminho_img']; ?>" alt="Imagem Secundária" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;">
                        <a href="index.php?cmd=del_img&id_img=<?php echo $img['id_img']; ?>&id_prod=<?php echo $id_prod; ?>" class="btn btn-danger btn-sm">Remover</a>
                    </div>
                <?php } ?>
            </div>

            <!-- Adicionar Novas Imagens -->
            <div class="mb-3">
                <label for="novas_imagens" class="form-label">Adicionar Novas Imagens Secundárias</label>
                <input type="file" class="form-control" id="novas_imagens" name="novas_imagens[]" multiple>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-submit"><i class="fas fa-save"></i> Modificar Produto</button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
