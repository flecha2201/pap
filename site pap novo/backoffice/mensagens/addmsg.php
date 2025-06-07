<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar Mensagem</h1>

    <form method="POST" action="index.php?cmd=insmsg">
        <div class="mb-3">
            <label for="emissor" class="form-label">Emissor</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="emissor" placeholder="Nome do Emissor" name="emissor" required>

            <label for="recetor" class="form-label">Recetor</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="recetor" placeholder="Nome do Recetor" name="recetor" required>

            <label for="conteudo" class="form-label">Conteúdo</label>
            <textarea style="width: 50%; margin: 0 auto;" class="form-control" id="conteudo" placeholder="Conteúdo da Mensagem" name="conteudo" required></textarea>

            <label for="data" class="form-label">Data</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="data" placeholder="Data" name="data" required>

            <label for="email" class="form-label">Email do Utilizador</label>
            <input style="width: 50%; margin: 0 auto;" type="email" class="form-control" id="email" placeholder="Email" name="email" required>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Adicionar Mensagem</button>
        </div>
    </form>
</div>
