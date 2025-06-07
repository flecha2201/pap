<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar Gestor</h1>

    <form method="POST" action="index.php?cmd=insgest" onsubmit="return validatePassword()">
        <div class="mb-3">
            <label for="NomeGestor" class="form-label">Inserir nome do Gestor</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="NomeGestor" placeholder="Nome do Gestor" name="username" required>

            <label for="Password" class="form-label">Inserir a sua password</label>
            <div style="width: 50%; margin: 0 auto; position: relative;">
                <input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
                <i class="fa fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
            </div>
            <small class="form-text text-muted">
                A senha deve ter entre 8 e 15 caracteres, conter pelo menos uma letra maiúscula, um número ou símbolo especial.
            </small>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-12 text-center" for="Gestor">Selecionar tipo de Gestor</label>
            <div class="col-sm-12 d-flex justify-content-center">
                <select class="form-control" style="width: 20%; margin-bottom: 10px;" name="id_tipog" required>
                <?php
                $sql = "SELECT * FROM tipo_gestor";
                $res = $lig->query($sql);
                while ($lin = $res->fetch_array()) {
                    echo "<option value=" . $lin['id_tipog'] . ">" . $lin['nome_tipo'] . "</option>\n";
                }
                echo "</select>";
                ?>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Adicionar Gestor</button>
        </div>
    </form>
</div>

<!-- Validação em JavaScript e funcionalidade de mostrar/ocultar senha -->
<script>
function validatePassword() {
    var password = document.getElementById('Password').value;
    var passwordPattern = /^(?=.*[A-Z])(?=.*[0_-9!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,15}$/;

    if (!passwordPattern.test(password)) {
        alert('A senha deve ter entre 8 e 15 caracteres, conter pelo menos uma letra maiúscula e um número ou símbolo especial.');
        return false;
    }

    return true;
}

// Alternar entre mostrar/ocultar senha
const togglePassword = document.querySelector('#togglePassword');
const passwordField = document.querySelector('#Password');

togglePassword.addEventListener('click', function () {
    // Alternar o tipo de input entre password e text
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    
    // Alternar o ícone
    this.classList.toggle('fa-eye-slash');
});
</script>

<!-- Link para o Font Awesome para ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
