<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar Favorito</h1>
    <?php if($_SESSION['tipo'] != '3') { ?>
        <form method="POST" action="index.php?cmd=insfav">
            <div class="mb-3">
                <label for="id_prod" class="form-label">Selecionar Produto</label>
                <select style="width: 50%; margin: 0 auto;" class="form-control" id="id_prod" name="id_prod" required>
                    <option value="">-- Selecione um Produto --</option>
                    <?php
                    // Conexão com a base de dados
                    include 'ligamysql.php';

                    // Selecionar produtos
                    $sql_produto = "SELECT * FROM Produtos"; 
                    $res_produto = $lig->query($sql_produto);

                    while ($linha_produto = $res_produto->fetch_array()) {
                        echo "<option value='{$linha_produto['id_prod']}'>{$linha_produto['id_prod']} - {$linha_produto['titulo']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email do Utilizador</label>
                <input style="width: 50%; margin: 0 auto;" type="text" readonly class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Adicionar Favorito</button>
            </div>
        </form>
    <?php } else { ?>
        <form method="POST" action="index.php?cmd=insfav">
            <div class="mb-3">
                <label for="id_prod" class="form-label">Selecionar Produto</label>
                <select style="width: 50%; margin: 0 auto;" class="form-control" id="id_prod" name="id_prod" required>
                    <option value="">-- Selecione um Produto --</option>
                    <?php
                    // Conexão com a base de dados
                    include 'ligamysql.php';

                    // Selecionar produtos
                    $sql_produto = "SELECT * FROM Produtos"; 
                    $res_produto = $lig->query($sql_produto);

                    while ($linha_produto = $res_produto->fetch_array()) {
                        echo "<option value='{$linha_produto['id_prod']}'>{$linha_produto['id_prod']} - {$linha_produto['titulo']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email do Utilizador</label>
                <input style="width: 50%; margin: 0 auto;" type="text" readonly class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Adicionar Favorito</button>
            </div>
        </form>
    <?php } ?>
</div>
