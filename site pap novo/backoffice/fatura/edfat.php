<?php
// editfatura.php
$id_fatura = $_REQUEST['id_fatura'];
$sql = "SELECT * FROM fatura WHERE id_fatura = '$id_fatura'";
$res = $lig->query($sql);
$lin = $res->fetch_array();
?>
<head>
    <title>Editar Fatura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<h1 align="center" class="text-center mt-5 mb-3">Editar Fatura</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="index.php?cmd=updtfat&id_fatura=<?php echo $id_fatura; ?>">
                <div class="mb-3">
                    <label for="emailC" class="form-label">Email Comprador</label>
                    <input type="email" class="form-control" id="emailC" name="emailC" value="<?php echo $lin['emailC']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="number" step="0.01" class="form-control" id="valor" name="valor" value="<?php echo $lin['valor']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="Nome" name="Nome" value="<?php echo $lin['Nome']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="Telefone" name="Telefone" value="<?php echo $lin['Telefone']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Morada" class="form-label">Morada</label>
                    <input type="text" class="form-control" id="Morada" name="Morada" value="<?php echo $lin['Morada']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="CPostal" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="CPostal" name="CPostal" value="<?php echo $lin['CPostal']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="NIF" class="form-label">NIF</label>
                    <input type="text" class="form-control" id="NIF" name="NIF" value="<?php echo $lin['NIF']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="emailV" class="form-label">Email Vendedor</label>
                    <input type="email" class="form-control" id="emailV" name="emailV" value="<?php echo $lin['emailV']; ?>" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Modificar Fatura</button>
                </div>
            </form>
        </div>
    </div>
</div>
