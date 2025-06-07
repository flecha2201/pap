<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar ao Carrinho</h1>

    <form method="POST" action="index.php?cmd=inscar">
        <div class="mb-3">
            <label for="id_prod" class="form-label">Escolher Produto</label>
            <select class="form-select" id="id_prod" name="id_prod" required>
                <?php
                // Consulta para listar os produtos disponíveis
                $sql = "SELECT id_prod, nome_prod FROM produtos";
                $res = $lig->query($sql);
                while ($produto = $res->fetch_array()) {
                    echo "<option value='{$produto['id_prod']}'>{$produto['nome_prod']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
        </div>
    </form>
</div>
