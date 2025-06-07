<?php
session_start();

// Verifica se o utilizador está autenticado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Recebe dados do formulário
$email = $_SESSION['email']; // Email do utilizador autenticado
$passAtual = $_POST['currentPassword'];
$passNova = $_POST['newPassword'];
$passConfirm = $_POST['confirmPassword'];

// Encriptação da password atual
$passAtualMd5 = md5($passAtual);

// Verifica se a senha atual está correta
$sqlCheck = "SELECT password FROM utilizador WHERE email = '$email'";
$resCheck = $lig->query($sqlCheck);
if ($resCheck->num_rows > 0) {
    $row = $resCheck->fetch_assoc();
    if ($row['password'] !== $passAtualMd5) {
        $_SESSION['error'] = "A password atual está incorreta.";
        header("Location: index.php?cmd=pass");
        exit();
    }
} else {
    $_SESSION['error'] = "Utilizador não encontrado.";
    header("Location: index.php?cmd=pass");
    exit();
}

// Verifica se as novas senhas coincidem
if ($passNova !== $passConfirm) {
    $_SESSION['error'] = "As novas senhas não coincidem.";
    header("Location: index.php?cmd=pass");
    exit();
}

// Encriptação da nova senha
$passNovaMd5 = md5($passNova);

// Atualiza a senha do utilizador
$sqlUpdate = "UPDATE utilizador SET password = '$passNovaMd5' WHERE email = '$email'";

if ($lig->query($sqlUpdate)) {
    $_SESSION['success'] = "Password alterada com sucesso!";
    header("Location: index.php?cmd=pass");
} else {
    $_SESSION['error'] = "Erro ao alterar a password. Tente novamente.";
    header("Location: index.php?cmd=pass");
}
?>


<?php
    if(isset($_SESSION['email']))
        require("./assets/html/menulogado.php");
    else
        require("./assets/html/menusemlogin.php");
?>


<br><br>
<div class="sucesso-container">
    <h2>Atualização feita com sucesso!</h2>
    <p>As suas definições foram efetuadas. Você será redirecionado em breve.</p>
</div>
<br><br>




<script>
    setTimeout(function() {
        window.location.href = 'index.php?cmd=perfil';
    }, 3000);
</script>

</body>
</html>

<style>
   

    /* Container de Sucesso */
    .sucesso-container {
        text-align: center;
        margin-top: 50px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .sucesso-container h2 {
        color: #2d8e4e;
    }

    .sucesso-container p {
        color: #555;
        font-size: 1.1em;
    }

  
</style>
