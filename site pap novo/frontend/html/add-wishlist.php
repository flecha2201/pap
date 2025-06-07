<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$lig = new mysqli("localhost", "rafael40112", "Psi32425", "rafael40112") or die("Erro ao ligar ao servidor e base de dados MYSQL");

// Receber o ID do produto
$id_prod = $_REQUEST['id_prod'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];

// Verificar se o produto já está nos favoritos
$sql_check = "SELECT * FROM favoritos 
              WHERE email = \"$email\" 
              AND id_prod = $id_prod";
$result = $lig->query($sql_check);

if ($result->num_rows > 0) {
    echo "exists"; // Produto já está nos favoritos
    exit;
}

// Inserir o produto nos favoritos
$sql_insert = "INSERT INTO favoritos (email, id_prod, username) 
               VALUES (\"$email\", $id_prod, \"$username\")";
if ($lig->query($sql_insert)) {
    echo "add"; // Produto adicionado aos favoritos
} else {
    echo "error"; // Erro ao adicionar o produto
}
error_log("Recebido ID do produto: $id_prod e email: $email");

?>
