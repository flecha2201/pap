<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Valida a existência dos valores no formulário
$nome_completo = isset($_POST['nome_completo']) ? $_POST['nome_completo'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$morada = isset($_POST['morada']) ? $_POST['morada'] : null;
$cod_postal = isset($_POST['cod_postal']) ? $_POST['cod_postal'] : null;
$data_nasc = isset($_POST['data_nasc']) ? $_POST['data_nasc'] : null; // Verifique o nome no formulário
$nmr_tel = isset($_POST['nmr_tel']) ? $_POST['nmr_tel'] : null;
$NIF = isset($_POST['NIF']) ? $_POST['NIF'] : null;

// Validação para campos obrigatórios
if (empty($email) || empty($nome_completo)) {
    die("Erro: Nome completo e email são obrigatórios.");
}

// Converte campos vazios para NULL (se necessário)
$data_nasc = !empty($data_nasc) ? $data_nasc : null;
$morada = !empty($morada) ? $morada : null;
$cod_postal = !empty($cod_postal) ? $cod_postal : null;
$nmr_tel = !empty($nmr_tel) ? $nmr_tel : null;
$NIF = !empty($NIF) ? $NIF : null;

// Prepara o SQL para evitar SQL Injection
$stmt = $lig->prepare("UPDATE utilizador 
        SET 
            nome_completo = ?, 
            morada = ?, 
            cod_postal = ?, 
            data_nasc = ?, 
            nmr_tel = ?, 
            NIF = ?
        WHERE email = ?");

// Liga os parâmetros
$stmt->bind_param("sssssss", $nome_completo, $morada, $cod_postal, $data_nasc, $nmr_tel, $NIF, $email);

// Executa a query
if ($stmt->execute()) {
    // Atualiza os valores na sessão
    $_SESSION['nome_completo'] = $nome_completo;
    $_SESSION['email'] = $email;
    $_SESSION['morada'] = $morada;
    $_SESSION['cod_postal'] = $cod_postal;
    $_SESSION['data_nasc'] = $data_nasc;
    $_SESSION['nmr_tel'] = $nmr_tel;
    $_SESSION['NIF'] = $NIF;

} else {
    echo "ERRO: alteração da tabela Utilizador.";
}

// Redirecionar após 1 segundo
echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=def_conta'>";
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
