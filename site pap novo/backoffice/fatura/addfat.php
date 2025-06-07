<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar Fatura</h1>
    <form method="POST" action="index.php?cmd=insfat">
    <div class="mb-3">
            <label for="emailC" class="form-label">Email Comprador</label>
            <select style="width: 50%; margin: 0 auto;" class="form-control" id="emailC" name="emailC" required>
                <option value="" disabled selected>Selecione o Email do Vendedor</option>
                <?php
                // Código PHP para buscar os tipos de utilizador da base de dados
                $sql = "SELECT email FROM utilizador";
                $res = $lig->query($sql);
                while ($lin = $res->fetch_assoc()) {
                    echo "<option value='{$lin['email']}'>{$lin['email']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input style="width: 50%; margin: 0 auto;" type="number" step="0.01" class="form-control" id="valor" name="valor" placeholder="Valor" required>
        </div>
        <div class="mb-3">
            <label for="Nome" class="form-label">Nome</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="Nome" name="Nome" placeholder="Nome" required>
        </div>
        <div class="mb-3">
            <label for="Telefone" class="form-label">Telefone</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="Telefone" name="Telefone" placeholder="Telefone" required>
        </div>
        <div class="mb-3">
            <label for="Morada" class="form-label">Morada</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="Morada" name="Morada" placeholder="Morada" required>
        </div>
        <div class="mb-3">
            <label for="CPostal" class="form-label">Código Postal</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="CPostal" name="CPostal" placeholder="Código Postal" required>
        </div>
        <div class="mb-3">
            <label for="NIF" class="form-label">NIF</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="NIF" name="NIF" placeholder="NIF" required>
        </div>
        <div class="mb-3">
            <label for="emailV" class="form-label">Email Vendedor</label>
            <select style="width: 50%; margin: 0 auto;" class="form-control" id="emailV" name="emailV" required>
                <option value="" disabled selected>Selecione o Email do Vendedor</option>
                <?php
                // Código PHP para buscar os tipos de utilizador da base de dados
                $sql = "SELECT email FROM utilizador";
                $res = $lig->query($sql);
                while ($lin = $res->fetch_assoc()) {
                    echo "<option value='{$lin['email']}'>{$lin['email']}</option>";
                }
                ?>
            </select>
        </div>
		<div class="mb-3">
            <label for="idE" class="form-label">Encomenda</label>
            <select style="width: 50%; margin: 0 auto;" class="form-control" id="idE" name="idE" required>
                <option value="" disabled selected>Selecione a encomenda</option>
                <?php
                // Código PHP para buscar os tipos de utilizador da base de dados
                $sql = "SELECT id_encomenda FROM encomendas";
                $res = $lig->query($sql);
                while ($lin = $res->fetch_assoc()) {
                    echo "<option value='{$lin['id_encomenda']}'>{$lin['id_encomenda']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Adicionar Fatura</button>
        </div>
    </form>
</div>
