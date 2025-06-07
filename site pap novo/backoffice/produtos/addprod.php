<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar Produto</h1>

    <form method="POST" enctype="multipart/form-data" action="index.php?cmd=insprod">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="titulo" placeholder="Título do Produto" name="titulo" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea style="width: 50%; margin: 0 auto;" class="form-control" id="descricao" placeholder="Descrição do Produto" name="descricao" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="size" class="form-label">Tamanho</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="size" placeholder="Exemplo: XL mas pode ser um L" name="size" required>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input style="width: 50%; margin: 0 auto;" type="number" class="form-control" id="preco" placeholder="Preço" name="preco" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select style="width: 50%; margin: 0 auto;" class="form-select" id="cod_categoria" name="cod_categoria" required>
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

        <div class="mb-3">
            <label for="email" class="form-label">Email do Vendedor</label>
            <input style="width: 50%; margin: 0 auto;" type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Principal</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
            <input type="file" name="foto" id="foto" required>
        </div>

        <div class="mb-3">
            <label for="fotos_secundarias" class="form-label">Fotos Secundárias (Múltiplas)</label>
            <input type="file" name="fotos_secundarias[]" id="fotos_secundarias" multiple>
            <small class="form-text text-muted">Pode carregar várias imagens (máx. 10).</small>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Adicionar Produto</button>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
