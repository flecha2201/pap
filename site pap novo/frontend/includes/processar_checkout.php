<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['email'])) {
    die("Erro: Utilizador não autenticado.");
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acesso inválido.");
}

$email_comprador = trim($_SESSION['email']);
$id_prod = intval($_REQUEST['id_prod']);
$nome = $_REQUEST['name'];
$tel = $_REQUEST['phone'];
$morada = $_REQUEST['address'];
$CP = $_REQUEST['zip'];
$NIF=$_REQUEST['NIF'];

$sql_produto = "SELECT email, preco, encomendado FROM Produtos WHERE id_prod = $id_prod";
$result_produto = $lig->query($sql_produto);
$produto = $result_produto->fetch_assoc();
if($produto['encomendado'] == 1){
    echo "Produto já encomendado!!";
}
else {

if ($result_produto->num_rows === 0) {
    die("Erro: Produto não encontrado.");
}
$email_vendedor = $produto['email'];
$preco = $produto['preco'];

$sql_insert = "INSERT INTO encomendas (id_prod, `email_comprador`, `email_vendedor`, preco) 
               VALUES ($id_prod, \"$email_comprador\", \"$email_vendedor\", $preco)";
$res_insert = $lig->query($sql_insert);

$sql_insert = "UPDATE Produtos SET encomendado = 1 WHERE id_prod = $id_prod";
$res_insert = $lig->query($sql_insert);

$sql_fatura = "INSERT INTO fatura (emailC, emailV, valor, Nome, Telefone, Morada, CPostal, NIF, id_encomenda)
               VALUES (\"$email_comprador\", \"$email_vendedor\", $preco, \"$nome\", $tel, \"$morada\", \"$CP\", $NIF, (SELECT id_encomenda FROM encomendas where id_prod = $id_prod AND `email_comprador` = \"$email_comprador\"))";
$res_fatura = $lig->query($sql_fatura);
}


?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;url=index.php?cmd=encomendas">
    <title>Encomenda Realizada com Sucesso</title>
    <style>
        :root {
            --portage-dark: #6a49c2;
            --royal-blue-dark: #3a32a8;
            --perfume-dark: #8b69c7;
            --spindle-dark: #8a89a2;
            --portage: #9572f1;
            --hawkes-blue: #d3d3fb;
            --perfume: #b690f7;
            --royal-blue: #524ae3;
            --portage-light: #938bf0;
            --perfume-light: #c1b0fb;
            --link-water: #f1f1fc;
            --perano: #b0aff5;
            --selago: #ece4fc;
            --spindle: #bcbcec;
        }

        body {
            background-color: var(--hawkes-blue);
            min-height: 100vh;
   
            justify-content: center;
            margin: 0;
        }

        .success-container {
            text-align: center;
            padding: 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 200px;
        }

        .success-icon {
            font-size: 5rem;
            color: var(--portage);
            margin-bottom: 1rem;
        }

        h1 {
            color: var(--royal-blue);
            margin-bottom: 1.5rem;
        }

        .message {
            color: var(--spindle);
            margin-bottom: 2rem;
        }

        .redirect {
            color: var(--royal-blue);
            font-weight: bold;
            margin-top: 2rem;
        }

        .order-number {
            color: var(--portage);
            font-size: 1.2rem;
            margin: 1rem 0;
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
    <div class="success-container">
        <div class="success-icon"></div>
        <h1>Encomenda Realizada com Sucesso!</h1>
        <div class="message">
            A sua encomenda foi processada com sucesso!<br>

        </div>
        <div class="redirect">
            Será redireccionado para a página de encomendas em 5 segundos.<br>
            Clique <a href="encomendas.php" style="color: var(--portage);">aqui</a> se não for automaticamente redireccionado.
        </div>
    </div>
</body>
</html>
