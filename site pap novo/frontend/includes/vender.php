<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<style>
    body {
        background: linear-gradient(135deg, var(--selago), var(--perano)); /* Gradiente da tua palete */
        min-height: 100vh;
        display: inline;
        align: center;
        justify-content: center;
    }

    .form-container {
        margin-top: 7%;
		max-width: 600px;
        background: var(--link-water); /* Fundo claro suave */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: bold;
        color: var(--royal-blue); /* Cor da tua palete */
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
</style>
<body>
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
<div class="container" align="center">
    <div class="form-container">
        <h2 class="text-center mb-4" style="color: var(--royal-blue);">Adicionar Produto</h2>

        <form method="POST" enctype="multipart/form-data" action="index.php?cmd=insprod">
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título do Produto" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Descrição do Produto" required></textarea>
            </div>

            <div class="mb-3">
                <label for="size" class="form-label">Tamanho</label>
                <input type="text" class="form-control" id="size" name="size" placeholder="Exemplo: XL, L, M..." required>
            </div>

            <div class="mb-3">
    <label for="preco" class="form-label">Preço (€)</label>
    <input type="number" class="form-control" id="preco" name="preco" placeholder="Preço" step="0.01" required>
</div>


            

<div class="mb-3">
    <label for="categoria" class="form-label">Categoria</label>
    <select class="form-select select2" id="cod_categoria" name="cod_categoria" required>
        <option value="">Selecione uma Categoria</option>
        <?php
        $sql = "SELECT cod_categorias, nome_categoria FROM categorias ORDER BY nome_categoria ASC";
        $result = $lig->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['cod_categorias']}'>{$row['nome_categoria']}</option>";
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


            <div class="mb-3">
                <label for="email" class="form-label">Email do Vendedor</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto Principal</label>
                <div class="input-group">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
                    <input type="file" class="form-control" name="foto" id="foto" required>
                    <label class="input-group-text" for="foto"><i class="fas fa-upload"></i></label>
                </div>
            </div>

            <div class="mb-3">
                <label for="fotos_secundarias" class="form-label">Fotos Secundárias (Múltiplas)</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="fotos_secundarias[]" id="fotos_secundarias" multiple>
                    <label class="input-group-text" for="fotos_secundarias"><i class="fas fa-images"></i></label>
                </div>
                <small class="form-text text-muted">Pode carregar várias imagens tem de ser todas de uma vez(máx. 10).</small>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-submit"><i class="fas fa-plus-circle"></i> Adicionar Produto</button>
            </div>

        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>