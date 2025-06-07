<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar Categoria de Produto</h1>

    <form method="POST" action="index.php?cmd=inscatprod">
        <div class="mb-3">
            <label for="id_categoria" class="form-label">Selecionar Categoria</label>
            <select style="width: 50%; margin: 0 auto;" class="form-control" id="id_categoria" name="id_categoria" required>
                <option value="">-- Selecione uma Categoria --</option>
                <?php
                // Conexão com a base de dados
                include 'ligamysql.php';

                // Selecionar categorias
                $sql_categoria = "SELECT * FROM categorias"; // Alterar para o nome correto da tabela de categorias
                $res_categoria = $lig->query($sql_categoria);

                while ($linha_categoria = $res_categoria->fetch_array()) {
                    echo "<option value='{$linha_categoria['id_categoria']}'>{$linha_categoria['id_categoria']} - {$linha_categoria['nome_categoria']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_produto" class="form-label">Selecionar Produto</label>
            <select style="width: 50%; margin: 0 auto;" class="form-control" id="id_produto" name="id_produto" required>
                <option value="">-- Selecione um Produto --</option>
                <?php
                // Selecionar produtos
                $sql_produto = "SELECT * FROM Produtos"; // Alterar para o nome correto da tabela de produtos
                $res_produto = $lig->query($sql_produto);

                while ($linha_produto = $res_produto->fetch_array()) {
                    echo "<option value='{$linha_produto['id_prod']}'>{$linha_produto['id_prod']} - {$linha_produto['titulo']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Adicionar Categoria de Produto</button>
        </div>
    </form>
</div>
