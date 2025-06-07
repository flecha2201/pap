<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$lig = new mysqli("localhost", "rafael40112", "Psi32425", "rafael40112") or die("Erro ao ligar ao servidor e base de dados MYSQL");

// Verificar se o ID do produto foi fornecido
if (!isset($_REQUEST['id_prod'])) {
    echo "missing_parameters";
    exit;
}

// Receber o ID do produto
$id_prod = intval($_REQUEST['id_prod']);
$email = $_SESSION['email'];

// Query para remover o produto da tabela favoritos
$sql = "DELETE FROM favoritos WHERE email = \"$email\" AND id_prod = $id_prod";

if ($lig->query($sql) === TRUE) {
    echo "remove"; // Produto removido com sucesso
} else {
    echo "error"; // Erro durante a remoção
}
?>
