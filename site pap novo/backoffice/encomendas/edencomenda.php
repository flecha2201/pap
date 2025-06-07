<?php
// editencomenda.php
$id_encomenda = $_REQUEST['id_encomenda'];
$sql = "SELECT * FROM encomendas WHERE id_encomenda = '$id_encomenda'";
$res = $lig->query($sql);
$lin = $res->fetch_array();
?>
<head>
    <title>Editar Encomenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<h1 align="center" class="text-center mt-5 mb-3">Editar Encomenda</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="index.php?cmd=updtencomenda&id_encomenda=<?php echo $id_encomenda; ?>">
                <div class="mb-3">
                    <label for="id_prod" class="form-label">ID Produto</label>
                    <input type="text" class="form-control" id="id_prod" name="id_prod" value="<?php echo $lin['id_prod']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email_comprador" class="form-label">Email Comprador</label>
                    <input type="email" class="form-control" id="email_comprador" name="email_comprador" value="<?php echo $lin['email_comprador']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email_vendedor" class="form-label">Email Vendedor</label>
                    <input type="email" class="form-control" id="email_vendedor" name="email_vendedor" value="<?php echo $lin['email_vendedor']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo $lin['preco']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <?php
                        $estados = ['Em processamento', 'A caminho', 'No posto de recolha', 'Aguardando recolha do vendedor', 'Entregue'];
                        foreach ($estados as $estadoOption) {
                            $selected = ($lin['estado'] == $estadoOption) ? "selected" : "";
                            echo "<option value='$estadoOption' $selected>$estadoOption</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Modificar Encomenda</button>
                </div>
            </form>
        </div>
    </div>
</div>
