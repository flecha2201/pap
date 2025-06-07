<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar Categoria</h1>

    <form method="POST" action="index.php?cmd=inscat">
        <div class="mb-3">
            <label for="nome_categoria" class="form-label">Nome da Categoria</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="nome_categoria" placeholder="Nome da Categoria" name="nome_categoria" required>
        </div>
        
        <div class="mb-3">
            <label for="pai" class="form-label">Categoria Pai (opcional)</label>
            <select style="width: 50%; margin: 0 auto;" class="form-select" id="pai" name="pai">
                <option value="">Nenhuma (Categoria Principal)</option>
                <?php
                // Buscar categorias existentes para serem pais
                $sql_pai = "SELECT cod_categoria, nome_categoria FROM categorias WHERE pai IS NULL";
                $res_pai = $lig->query($sql_pai);
                while ($lin_pai = $res_pai->fetch_array()) {
                    echo "<option value='{$lin_pai['cod_categoria']}'>{$lin_pai['nome_categoria']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Adicionar Categoria</button>
        </div>
    </form>
</div>
