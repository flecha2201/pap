<?php
// insencomenda.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Receber dados do formulário
$id_prod = $_REQUEST['id_prod'];
$email_comprador = $_REQUEST['email_comprador'];
$email_vendedor = $_REQUEST['email_vendedor'];
$preco = $_REQUEST['preco'];
$estado = $_REQUEST['estado']; // Valores: 'Em processamento','A caminho','No posto de recolha','Aguardando recolha','Entregue'

// Inserir a encomenda com data_compra definida para NOW()
$sql = "INSERT INTO encomendas (id_prod, email_comprador, email_vendedor, preco, estado, data_compra)
        VALUES ('$id_prod', '$email_comprador', '$email_vendedor', '$preco', '$estado', NOW())";
        
if ($lig->query($sql)) {
    $id_encomenda = $lig->insert_id;
    echo "Encomenda inserida com o ID: " . $id_encomenda;
    echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisencomenda'>";
} else {
    echo "ERRO: Inserção na tabela encomendas";
}
?>
