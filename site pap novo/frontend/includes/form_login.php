<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<head>
  <title>Login | Signup</title>

  <!-- Link para o CSS do formulário animado -->
  <link rel="stylesheet" href="./assets/css/formulario-animado.css">

  <style>
    .error-message {
        color: #0600ff;
        font-size: 0.8em;
        text-align: center;
 
        margin-bottom: 15px;
    }
    .input-field {
        margin-bottom: 5px;
    }
    .input-field input.error {
        border-color: #d3d3fb;
    }
    .input-field input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }
    .erro {
        color: #d3d3fb;
        font-family: Poppins;
        font-size: small;
        display: none;
    }
	::placeholder{
		color: white;
	}
  </style>
</head>
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
<body>
  <div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
            <label for="reg-log"></label>

            <!-- Container para o formulário -->
            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">

                <!-- Formulário de Login -->
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="pb-3">Iniciar Sessão</h4>
                      <form action="index.php?cmd=login" method="POST">
                        <div class="form-group">
                          <input type="email" name="email" class="form-style" placeholder="Email" required>
                          <i class="input-icon uil uil-at"></i>
                        </div>

                        <div class="form-group mt-2">
                          <input type="password" name="Password" id="Password" class="form-style" placeholder="Password" required>
                          <span id="toggleLoginPassword" style="position: absolute; right: 20px; top: 11px; cursor: pointer;">
							<i class="fas fa-eye" onclick="togglePasswordVisibility('Password')"></i></span>
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>

                        <input type="submit" class="btn mt-4" value="Iniciar sessão">
                      </form>
                      <p class="mb-0 mt-4 text-center"><a href="#" class="link"></a></p>
                    </div>
                  </div>
                </div>

                <!-- Formulário de Cadastro -->
                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-3 pb-3">Criar Conta</h4>
                      <form action="index.php?cmd=signup" method="POST" onsubmit="return validarFormulario(event)">
                        <div class="form-group">
                          <input type="text" name="username" id="username" class="form-style" placeholder="Username" required onblur="return existe_nome(this);">
                          <i class="input-icon uil uil-user"></i>
                          <div class="erro" id='txtlogin'></div>
                          <div class="error-message" id="username_error"></div>
                        </div>

                        <div class="form-group mt-2">
                          <input type="email" name="email" id="email" class="form-style" placeholder="Email" required onblur="return existe_email(this);">
                          <i class="input-icon uil uil-at"></i>
                          <div class="erro" id='txtemail'></div>
                          <div class="error-message" id="email_error"></div>
                        </div>

                        <div class="form-group mt-2">
                          <input type="password" name="password" id="password" class="form-style" placeholder="Password" required>
                          <span id="togglePassword" style="position: absolute; right: 20px; top: 11px; cursor: pointer;">
                            <i class="fas fa-eye" onclick="togglePasswordVisibility('password')"></i>
                          </span>
                          <div class="error-message" id="pass_nova_error"></div>
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>

                        <div class="form-group mt-2">
                          <input type="password" name="confirm_password" id="confirm_password" class="form-style" placeholder="Confirm Password" required>
                          <span id="toggleConfirmPassword" style="position: absolute; right: 20px; top: 11px; cursor: pointer;">
                            <i class="fas fa-eye" onclick="togglePasswordVisibility('confirm_password')"></i>
                          </span>
                          <div class="error-message" id="passN2_error" ></div>
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>

                        <input type="submit" class="btn mt-4" value="Registar">
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  
<script>
    function togglePasswordVisibility(id, iconId) {
      const passwordInput = document.getElementById(id);
      const toggleIcon = document.querySelector(`#${iconId} i`);

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
      }
    }
	
	</script>
  <script>
    async function existe_nome(e) {
        const erro = document.getElementById("txtlogin");
        if (e.value.length === 0) {
            erro.style.display = "none";
            erro.innerHTML = "";
            return true;
        }

        try {
            const response = await fetch(`utilizador/validauser-r.php?q=${encodeURIComponent(e.value)}`);
            const textoResposta = await response.text();

            if (textoResposta.trim() !== "") {
                erro.style.display = "block";
                erro.innerHTML = textoResposta;
                return false;
            } else {
                erro.style.display = "none";
                erro.innerHTML = "";
                return true;
            }
        } catch (error) {
            console.error("Erro ao verificar nome de utilizador:", error);
            erro.style.display = "block";
            erro.innerHTML = "Erro ao verificar disponibilidade. Tente novamente.";
            return false;
        }
    }

    async function existe_email(e) {
        const erro = document.getElementById("txtemail");
        if (e.value.length === 0) {
            erro.style.display = "none";
            erro.innerHTML = "";
            return true;
        }

        try {
            const response = await fetch(`utilizador/validaemail-r.php?q=${encodeURIComponent(e.value)}`);
            const textoResposta = await response.text();

            if (textoResposta.trim() !== "") {
                erro.style.display = "block";
                erro.innerHTML = textoResposta;
                return false;
            } else {
                erro.style.display = "none";
                erro.innerHTML = "";
                return true;
            }
        } catch (error) {
            console.error("Erro ao verificar email:", error);
            erro.style.display = "block";
            erro.innerHTML = "Erro ao verificar disponibilidade. Tente novamente.";
            return false;
        }
    }
  </script>
  <script>
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const registerButton = document.querySelector('.card-back form input[type="submit"]');

    passwordInput.addEventListener('input', updatePasswordStrength);
    confirmPasswordInput.addEventListener('input', updateConfirmPassword);

    function evaluatePasswordComplexity(password) {
      let complexity = 0;
      if (password.length >= 8) {
        complexity++;
        if (/[0-9]/.test(password)) complexity++;
        if (/[A-Z]/.test(password)) complexity++;
        if (/[^A-Za-z0-9]/.test(password)) complexity++;
      }
      return complexity;
    }

    function updatePasswordStrength() {
      const password = passwordInput.value;
      const complexity = evaluatePasswordComplexity(password);

      // Remove existing strength classes
      passwordInput.classList.remove('password-weak', 'password-medium', 'password-strong', 'password-very-strong');

      // Add new strength class based on complexity
      if (complexity === 1) {
        passwordInput.classList.add('password-weak');
      } else if (complexity === 2) {
        passwordInput.classList.add('password-medium');
      } else if (complexity === 3) {
        passwordInput.classList.add('password-strong');
      } else if (complexity === 4) {
        passwordInput.classList.add('password-very-strong');
      }

      updateRegisterButtonState();
    }

    function updateConfirmPassword() {
      updateRegisterButtonState();
    }

    function doPasswordsMatch() {
      return passwordInput.value === confirmPasswordInput.value;
    }

    function isPasswordComplexEnough() {
      const complexity = evaluatePasswordComplexity(passwordInput.value);
      // Consider 'strong' and 'very strong' as complex enough
      return complexity >= 3;
    }

    function updateRegisterButtonState() {
      const passwordsMatch = doPasswordsMatch();
      const passwordComplexEnough = isPasswordComplexEnough();

      if (passwordsMatch && passwordComplexEnough) {
        registerButton.disabled = false;
      } else {
        registerButton.disabled = true;
      }

      // Optionally, add visual feedback for password matching
      const passN2Error = document.getElementById('passN2_error');
      if (confirmPasswordInput.value !== '' && !passwordsMatch) {
        passN2Error.textContent = 'Passwords do not match.';
      } else {
        passN2Error.textContent = '';
      }
    }
    
  </script>

</body>
