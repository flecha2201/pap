<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");

require('assets/css/painelut.css');
?>

<!-- Mensagem de erro -->
<div id="error-message" class="alert alert-danger" style="display: none;"></div>
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="container my-5">
    <div class="row">
        <!-- Barra lateral -->
        <div class="col-md-3 sidebar">
            <h4>Definições</h4>
            <a href="index.php?cmd=perfil">Editar Perfil</a>
            <a href="index.php?cmd=def_conta">Definições da Conta</a>
            <a href="index.php?cmd=pass">Alterar Password</a>
            <a href="index.php?cmd=logout" class="text-danger">Logout</a>
        </div>

        <!-- Conteúdo principal -->
        <div class="col-md-9 settings-panel">
            <h2 class="text-center">Alterar Password</h2>
            <div class="card p-4 shadow">
                <form id="passwordForm" method="POST" action="index.php?cmd=updatepass">
                    <div class="mb-3 input-wrapper">
    <label for="currentPassword" class="form-label">Password Atual</label>
    <div class="password-field">
        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
        <i class="fas fa-eye toggle-password" data-target="currentPassword"></i>
    </div>
</div>
<div class="mb-3 input-wrapper">
    <label for="newPassword" class="form-label">Nova Password</label>
    <div class="password-field">
        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
        <i class="fas fa-eye toggle-password" data-target="newPassword"></i>
    </div>
</div>
<div class="mb-3 input-wrapper">
    <label for="confirmPassword" class="form-label">Confirmar Password</label>
    <div class="password-field">
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        <i class="fas fa-eye toggle-password" data-target="confirmPassword"></i>
    </div>
</div>
<div class="d-grid">
    <button type="submit" class="btn btn-primary">Alterar Palavra-Passe</button>
</div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const currentPassword = document.getElementById('currentPassword');
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        const alterarButton = document.getElementById('alterarButton');
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');

        function validatePasswords() {
            const isFilled = currentPassword.value.trim() !== '' && newPassword.value.trim() !== '' && confirmPassword.value.trim() !== '';
            const isMatch = newPassword.value === confirmPassword.value;
            alterarButton.disabled = !(isFilled && isMatch);
        }

        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const targetInput = document.getElementById(targetId);
                const type = targetInput.type === 'password' ? 'text' : 'password';
                targetInput.type = type;
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });

        currentPassword.addEventListener('input', validatePasswords);
        newPassword.addEventListener('input', validatePasswords);
        confirmPassword.addEventListener('input', validatePasswords);
    });
</script>

<script>
//--------------------------- Validação de Passwords ---------------------------

function validarPasswords() {
    const pass1 = document.getElementById("newPassword").value;
    const pass2 = document.getElementById("confirmPassword").value;
    const regex = /^(?=.*\d)(?=.*[-_!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;  // Requer 8 caracteres, 1 maiúscula, 1 minúscula, 1 número ou símbolo

    // Mensagem de erro
    const erroPasswords = document.getElementById("passwordError");

    // Limpar mensagens anteriores
    erroPasswords.innerHTML = "";
    erroPasswords.style.display = "none";

    if (pass1 === "" || pass2 === "") {
        erroPasswords.innerHTML = "Preencha todos os campos.";
        erroPasswords.style.display = "block";
        return false;
    }

    if (pass1 !== pass2) {
        erroPasswords.innerHTML = "As passwords não coincidem.";
        erroPasswords.style.display = "block";
        return false;
    }

    // Verificação de requisitos de senha
    if (!regex.test(pass1)) {
        erroPasswords.innerHTML =
            "A password deve ter no mínimo 8 caracteres, com pelo menos uma letra maiúscula, uma letra minúscula e um número ou símbolo.";
        erroPasswords.style.display = "block";
        return false;
    }

    return true; // Tudo está válido
}

//--------------------------- Validação de Campos ---------------------------

function validarFormulario(e) {
    const passAtual = document.getElementById("currentPassword").value;
    const passNova = document.getElementById("newPassword").value;
    const passConfirm = document.getElementById("confirmPassword").value;

    const erroCampos = document.querySelector(".error-message");

    // Limpar mensagens anteriores
    erroCampos.innerHTML = "";
    erroCampos.style.display = "none";

    if (passAtual === "" || passNova === "" || passConfirm === "") {
        erroCampos.innerHTML = "Preencha todos os campos.";
        erroCampos.style.display = "block";
        e.preventDefault(); // Impede o envio do formulário
        return false;
    }

    if (!validarPasswords()) {
        e.preventDefault(); // Impede o envio do formulário
        return false;
    }

    return true; // Tudo está válido
}

//--------------------------- Atribuir Eventos ---------------------------

document.getElementById("passwordForm").addEventListener("submit", validarFormulario);

document.getElementById("confirmPassword").addEventListener("input", validarPasswords);
document.getElementById("newPassword").addEventListener("input", validarPasswords);

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("passwordForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Impede o envio do formulário por padrão
        
        let currentPassword = document.getElementById("currentPassword").value.trim();
        let newPassword = document.getElementById("newPassword").value.trim();
        let confirmPassword = document.getElementById("confirmPassword").value.trim();
        let errorMessage = document.getElementById("error-message");

        errorMessage.innerHTML = ""; // Limpa mensagens anteriores
        errorMessage.style.display = "none";

        // Validação dos campos
        if (currentPassword === "" || newPassword === "" || confirmPassword === "") {
            errorMessage.innerHTML = "Preencha todos os campos.";
            errorMessage.style.display = "block";
            return;
        }

        if (newPassword !== confirmPassword) {
            errorMessage.innerHTML = "As novas passwords não coincidem.";
            errorMessage.style.display = "block";
            return;
        }

        if (!/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/.test(newPassword)) {
            errorMessage.innerHTML = "A password deve ter pelo menos 8 caracteres, incluindo uma maiúscula, uma minúscula e um símbolo.";
            errorMessage.style.display = "block";
            return;
        }

        // Se passou na validação, envia o formulário manualmente
        this.submit();
    });
});
</script>

<!-- Mensagem de erro -->
<div id="error-message" class="alert alert-danger" style="display: none;"></div>
