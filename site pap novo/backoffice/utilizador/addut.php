<div class="center-content">
    <h1 class="text-center mt-5 mb-5">Adicionar Utilizador</h1>

    <form method="POST" enctype="multipart/form-data" action="index.php?cmd=insut">
        <div class="mb-3">
            <label for="nome_completo" class="form-label">Nome Completo</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="nome_completo" placeholder="Nome Completo" name="nome_completo" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="username" placeholder="Username" name="username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input style="width: 50%; margin: 0 auto;" type="email" class="form-control" id="email" placeholder="Email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div style="position: relative; width: 50%; margin: 0 auto;">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" 
                       pattern="(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9_]{8,20}"
                       title="A senha deve ter entre 8 a 20 caracteres, incluir pelo menos uma letra maiúscula e um número." 
                       required>
                <span id="togglePassword" style="position: absolute; right: 10px; top: 10px; cursor: pointer;">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
        </div>
        <small class="form-text text-muted">
            A senha deve ter entre 8 e 15 caracteres, conter pelo menos uma letra maiúscula, um número ou símbolo especial.
        </small>

        <div class="mb-3">
            <label for="data_nasc" class="form-label">Data de Nascimento</label>
            <input style="width: 50%; margin: 0 auto;" type="date" class="form-control" id="data_nasc" name="data_nasc" required>
        </div>
        
        <div class="mb-3">
            <label for="nmr_tel" class="form-label">Número de Telefone</label>
            <input style="width: 50%; margin: 0 auto;" type="number" class="form-control" id="nmr_tel" placeholder="Número de Telefone" name="nmr_tel" 
                   pattern="\d{9}" 
                   title="O número de telefone deve conter 9 dígitos." required>
        </div>
        
        <div class="mb-3">
            <label for="morada" class="form-label">Morada</label>
            <input style="width: 50%; margin: 0 auto;" type="text" class="form-control" id="morada" placeholder="Morada" name="morada" required>
        </div>

        <div class="mb-3">
            <label for="cod_postal" class="form-label">Código Postal</label>
            <input style="width: 50%; margin: 0 auto;" type="number" class="form-control" id="cod_postal" placeholder="Código Postal" name="cod_postal" 
                   pattern="\d{4}-\d{3}" 
                   title="O código postal deve seguir o formato 1234-567." required>
        </div>

		<div class="mb-3">
            <label for="cod_tipo_ut" class="form-label">Tipo de Utilizador</label>
            <select style="width: 50%; margin: 0 auto;" class="form-control" id="cod_tipo_ut" name="cod_tipo_ut" required>
                <option value="" disabled selected>Selecione o tipo de utilizador</option>
                <?php
                // Código PHP para buscar os tipos de utilizador da base de dados
                $sql = "SELECT CodTipoUt, Designacao FROM TipoUtilizador";
                $res = $lig->query($sql);
                while ($lin = $res->fetch_assoc()) {
                    echo "<option value='{$lin['CodTipoUt']}'>{$lin['Designacao']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
            <input type="file" name="foto" id="foto">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Adicionar Utilizador</button>
        </div>
    </form>
</div>

<!-- JavaScript para alternar a visibilidade da password -->
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>

<!-- Link para os ícones do FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
