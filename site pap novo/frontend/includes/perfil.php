
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");

require('assets/css/painelut.css');
?>
<!-- Modal para editar perfil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="POST" action="index.php?cmd=updtut">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nome de Utilizador</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telemóvel</label>
                        <input type="text" class="form-control" id="phone" name="nmr_tel" value="<?php echo $_SESSION['nmr_tel']; ?>">
                    </div>
                    <button class="btn btn-primary w-100 mt-3" type="submit">Guardar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Painel principal -->
<div class="container my-5">
    <div class="row">
        <!-- Barra lateral -->
        <div class="col-md-3 sidebar">
            <h4>Definições</h4>
            <a href="#">Editar Perfil</a>
            <a href="index.php?cmd=def_conta">Definições da Conta</a>
			<a href="index.php?cmd=pass">Alterar password</a>
            <a href="index.php?cmd=logout" class="text-danger">Logout</a>
        </div>

        <!-- Conteúdo -->
        <div class="col-md-9 settings-panel">
            <h2 class="text-center">Bem-vindo ao seu Painel de Utilizador</h2>

            <div class="settings-group">
                <h5>Informações Pessoais</h5>
                <p><strong>Nome:</strong> <?php echo $_SESSION['username']; ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
                <p><strong>Telemóvel:</strong> <?php echo $_SESSION['nmr_tel']; ?></p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Editar Perfil</button>
            </div>

            <div class="settings-group">
                <h5>Foto de Perfil</h5>
                <div class="profile-photo text-center">
                    <!-- Pré-visualização -->
                    <img id="preview" src="<?php echo $_SESSION['foto_ut']; ?>" 
                         alt="Foto do perfil" 
                         style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
                    <form enctype="multipart/form-data" method="POST" action="index.php?cmd=updtpfput">
                        <input type="file" name="foto_ut" class="form-control mt-3" onchange="previewImage(event)" accept="image/*">
                        <button type="submit"  class="btn btn-primary w-100 mt-3">Confirmar Alteração</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Scripts -->
<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var preview = document.getElementById('preview');
        preview.src = reader.result;
    };
    if (event.target.files && event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}
</script>
