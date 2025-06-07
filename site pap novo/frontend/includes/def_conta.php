<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");

require('assets/css/painelut.css');

require('assets/css/def_conta.css');
?>

<div class="container my-5">
    <div class="row">
        <!-- Barra lateral -->
        <div class="col-md-3 sidebar">
            <h4>Definições</h4>
            <a href="index.php?cmd=perfil">Editar Perfil</a>
			<a href="index.php?cmd=def_conta">Definições da Conta</a>
			<a href="index.php?cmd=pass">Alterar password</a>
            <a href="index.php?cmd=logout" class="text-danger">Logout</a>
        </div>

        <!-- Conteúdo -->
        <div class="col-md-9 settings-panel">
            <h2 class="text-center">Definições da Conta</h2>
            <form method="POST" action="index.php?cmd=updt_conta">
                <div class="mb-3">
                    <label for="nome_completo" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome_completo" name="nome_completo" value="<?php echo $_SESSION['nome_completo']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="morada" class="form-label">Morada</label>
                    <input type="text" class="form-control" id="morada" name="morada" value="<?php echo $_SESSION['morada']; ?>">
                </div>
                <div class="mb-3">
                    <label for="cod_postal" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="cod_postal" name="cod_postal" value="<?php echo $_SESSION['cod_postal']; ?>">
                </div>
                <div class="mb-3">
                    <label for="data_nasc" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nasc" name="data_nasc" value="<?php echo $_SESSION['data_nasc']; ?>">
                </div>
                <div class="mb-3">
                    <label for="nmr_tel" class="form-label">Número de Telefone</label>
                    <input type="tel" class="form-control" id="nmr_tel" name="nmr_tel" value="<?php echo $_SESSION['nmr_tel']; ?>">
                </div>
				<div class="mb-3">
                    <label for="NIF" class="form-label">NIF/Numero de contribuinte</label>
                    <input type="number" class="form-control" id="NIF" name="NIF" value="<?php echo $_SESSION['NIF']; ?>">
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Guardar Alterações</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
