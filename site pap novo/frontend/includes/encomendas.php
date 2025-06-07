<?php
// encomendas.php
session_start();


if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$email = $_SESSION['email'];
// Consulta com join para buscar também a foto e o título do produto
$sql9 = "SELECT e.*, p.titulo, p.foto_prod 
        FROM encomendas e 
        LEFT JOIN Produtos p ON e.id_prod = p.id_prod 
        WHERE e.email_comprador = '$email'
        ORDER BY e.data_compra DESC";
$res9 = $lig->query($sql9);
?>

<head>
    <meta charset="UTF-8">
    <title>Minhas Encomendas</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .order-card {
            transition: transform 0.2s;
        }
        .order-card:hover {
            transform: scale(1.02);
        }
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
        .card-header {
            background-color:rgb(112, 0, 177);
            color: #fff;
        }
    </style>
</head>
<body>
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Minhas Encomendas</h1>
    <?php if ($res9->num_rows > 0) { ?>
        <div class="row">
            <?php while ($row = $res9->fetch_assoc()) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card order-card shadow-sm">
                        <?php if (!empty($row['foto_prod'])) { ?>
                            <img src="<?php echo $row['foto_prod']; ?>" class="card-img-top" alt="Imagem do Produto">
                        <?php } else { ?>
                            <img src="default-product.jpg" class="card-img-top" alt="Imagem Padrão">
                        <?php } ?>
                        <div class="card-header">
                            <h5 class="card-title mb-0">Encomenda #<?php echo $row['id_encomenda']; ?></h5>
                        </div>
                        <div class="card-body">
                        <p class="card-text"><strong>ID Produto:</strong> <?php echo $row['id_prod'] ?? 'Sem Produto'; ?></p>
                            <p class="card-text"><strong>Produto:</strong> <?php echo htmlspecialchars(mb_strimwidth($row['titulo'], 0, 20, '...')); ?></p>
                            <p class="card-text"><strong>Preço:</strong> <?php echo $row['preco']; ?> €</p>
                            <p class="card-text"><strong>Estado:</strong> <?php echo $row['estado']; ?></p>
                            <p class="card-text"><strong>Vendedor:</strong> <?php echo $row['email_vendedor']; ?></p>
                            <a href="./pdf/pdfav.php?id=<?php echo $row['id_prod'] ?>" target="_blank">Imprimir Fatura</a>
                        </div>
                        <div class="card-footer text-muted">
                            <?php 
                            $date = new DateTime($row['data_compra']);
                            echo "Comprado em: " . $date->format('d/m/Y H:i');
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="alert alert-info text-center">Nenhuma encomenda encontrada.</div>
    <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
