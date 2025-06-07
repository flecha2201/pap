<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar Encomenda</h1>
    <form method="POST" action="index.php?cmd=insencomenda">
        <div class="mb-3">
            <label for="id_prod" class="form-label">ID Produto</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="id_prod" name="id_prod" placeholder="ID do Produto" required>
        </div>
        <div class="mb-3">
            <label for="email_comprador" class="form-label">Email Comprador</label>
            <input style="width: 50%; margin: 0 auto;" type="email" class="form-control" id="email_comprador" name="email_comprador" placeholder="Email do Comprador" required>
        </div>
        <div class="mb-3">
            <label for="email_vendedor" class="form-label">Email Vendedor</label>
            <input style="width: 50%; margin: 0 auto;" type="email" class="form-control" id="email_vendedor" name="email_vendedor" placeholder="Email do Vendedor" required>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input style="width: 50%; margin: 0 auto;" type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="Preço" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select style="width: 50%; margin: 0 auto;" class="form-select" id="estado" name="estado" required>
                <option value="Em processamento">Em processamento</option>
                <option value="A caminho">A caminho</option>
                <option value="No posto de recolha">No posto de recolha</option>
                <option value="Aguardando recolha">Aguardando recolha</option>
                <option value="Entregue">Entregue</option>
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Adicionar Encomenda</button>
        </div>
    </form>
</div>
