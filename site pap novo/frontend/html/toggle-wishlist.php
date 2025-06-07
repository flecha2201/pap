<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$lig = new mysqli("localhost", "rafael40112", "Psi32425", "rafael40112") or die("Erro ao ligar ao servidor e base de dados MYSQL");

if (!isset($_REQUEST['id_prod']) || !isset($_SESSION['email'])) {
    echo "missing_parameters";
    exit;
}

$id_prod = intval($_REQUEST['id_prod']);
$email = $_SESSION['email'];
$username = $_SESSION['username'];

// Verificar se o produto já está nos favoritos
$sql_check = "SELECT * FROM favoritos WHERE email = \"$email\" AND id_prod = $id_prod";
$result = $lig->query($sql_check);

if ($result->num_rows > 0) {
    // Produto já está nos favoritos, remover
    $sql_remove = "DELETE FROM favoritos WHERE email = \"$email\" AND id_prod = $id_prod";
    if ($lig->query($sql_remove)) {
        echo "remove"; // Produto removido com sucesso
    } else {
        echo "error"; // Erro ao remover
    }
} else {
    // Produto não está nos favoritos, adicionar
    $sql_insert = "INSERT INTO favoritos (email, id_prod, username) VALUES (\"$email\", $id_prod, \"$username\")";
    if ($lig->query($sql_insert)) {
        echo "add"; // Produto adicionado com sucesso
    } else {
        echo "error"; // Erro ao adicionar
    }
}
?>
