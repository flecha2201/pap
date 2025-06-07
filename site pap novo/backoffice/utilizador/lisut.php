<?php
$sql = "SELECT u.*, t.Designacao 
        FROM utilizador u
        JOIN TipoUtilizador t ON u.CodTipoUt = t.CodTipoUt";
$res = $lig->query($sql);
?>

<div class="container">
    <h1 align="center" class="text-center mt-5 mb-3">Listagem de Utilizadores</h1> <br><br>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome Completo</th>
                <th>Username</th>
                <th>Email</th>
                <th>Morada</th>
                <th>Código Postal</th>
                <th>Data de Nascimento</th>
                <th>Número de Telefone</th>
                <th>Tipo de Utilizador</th>
                <th>Foto</th>
                <?php if ($_SESSION['tipo'] != 3) { ?> <!-- Apenas mostra os botões para Admin e Gestor -->
                    <th></th>
                    <th></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($lin = $res->fetch_array()) { ?>
                <tr>
                    <td><?php echo $lin['nome_completo']; ?></td>
                    <td><?php echo $lin['username']; ?></td>
                    <td><?php echo $lin['email']; ?></td>
                    <td><?php echo $lin['morada']; ?></td>
                    <td><?php echo $lin['cod_postal']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($lin['data_nasc'])); ?></td>
                    <td><?php echo $lin['nmr_tel']; ?></td>
                    <td><?php echo $lin['Designacao']; ?></td>
                    <td><img src='<?php echo $lin['foto_ut']; ?>' height='50' width='50' style="cursor:pointer;" onclick="openModal('<?php echo $lin['foto_ut']; ?>')"></td>
                    
                    <?php if ($_SESSION['tipo'] != 3) { ?>
                        <td><a href="index.php?cmd=edut&email=<?php echo urlencode($lin['email']); ?>" class="btn btn-warning btn-sm">Alterar</a></td>
                        <td><a href="index.php?cmd=delut&email=<?php echo urlencode($lin['email']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem a certeza que deseja eliminar este utilizador?');">Apagar</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal para exibir a imagem em tamanho grande -->
<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="img01">
</div>

<!-- CSS para o Modal -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 60px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }
    .close {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }
    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<!-- JavaScript para abrir e fechar o modal -->
<script>
    function openModal(src) {
        document.getElementById("myModal").style.display = "block";
        document.getElementById("img01").src = src;
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
</script>
