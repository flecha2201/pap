<?php
$email = $_REQUEST['email'];
$sql = "SELECT * FROM utilizador WHERE email = '$email'";
$res = $lig->query($sql);
$lin = $res->fetch_array();
?>

<head>
    <title>Editar Utilizador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<h1 align="center" class="text-center mt-5 mb-3">Editar Utilizador</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="index.php?cmd=updtut&email=<?php echo $email; ?>">
                <div class="mb-3">
                    <label for="NomeCompleto" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="NomeCompleto" name="nome_completo" value="<?php echo $lin['nome_completo']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="Username" name="username" value="<?php echo $lin['username']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Morada" class="form-label">Morada</label>
                    <input type="text" class="form-control" id="Morada" name="morada" value="<?php echo $lin['morada']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="CodPostal" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="CodPostal" name="cod_postal" value="<?php echo $lin['cod_postal']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="DataNasc" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="DataNasc" name="data_nasc" value="<?php echo $lin['data_nasc']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="NmrTel" class="form-label">Número de Telefone</label>
                    <input type="text" class="form-control" id="NmrTel" name="nmr_tel" value="<?php echo $lin['nmr_tel']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="CodTipoUt" class="form-label">Tipo de Utilizador</label>
                    <select class="form-control" id="CodTipoUt" name="cod_tipo_ut" required>
                        <option value="" disabled>Selecione o tipo de utilizador</option>
                        <?php
                        // Código PHP para buscar os tipos de utilizador da base de dados
                        $sql_tipo = "SELECT CodTipoUt, Designacao FROM TipoUtilizador"; // Certifique-se de que esta tabela existe
                        $res_tipo = $lig->query($sql_tipo);
                        while ($lin_tipo = $res_tipo->fetch_assoc()) {
                            $selected = ($lin_tipo['CodTipoUt'] == $lin['CodTipoUt']) ? "selected" : "";
                            echo "<option value='{$lin_tipo['CodTipoUt']}' $selected>{$lin_tipo['Designacao']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Modificar Utilizador</button>
                </div>
            </form>
        </div>
    </div>
</div>
