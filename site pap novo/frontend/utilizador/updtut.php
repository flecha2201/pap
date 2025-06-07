<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Receber dados do formulário
$email = $_REQUEST['email'];
$username = $_REQUEST['username'];
$nmr_tel = $_REQUEST['nmr_tel'];

$_SESSION['email'] = $email;
$_SESSION['username'] = $username;
$_SESSION['nmr_tel'] = $nmr_tel;

// Atualiza os dados do utilizador, incluindo CodTipoUt
$sql = "UPDATE utilizador 
        SET  
            username = '$username',  
            nmr_tel = '$nmr_tel'
        WHERE email = '$email'";

$lig->query($sql) or die("ERRO: alteração da tabela Utilizador");
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
