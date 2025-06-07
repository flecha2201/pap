<?php
// Conexão com a base de dados
include './includes/ligamysql.php';

// Selecionar todos os favoritos com informações dos produtos e utilizadores, incluindo a foto do produto
$sql = "SELECT f.email, p.id_prod, p.titulo, p.preco, p.foto_prod
        FROM favoritos f
        JOIN Produtos p ON f.id_prod = p.id_prod";
$res = $lig->query($sql);
?>

<div class="container">
    <h1 align="center" class="text-center mt-5 mb-3">Listagem de Favoritos</h1> <br><br>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Email do Utilizador</th>
                <th>ID do Produto</th>
                <th>Nome do Produto</th>
                <th>Preço</th>
                <th>Foto do Produto</th> <!-- Coluna para a foto do produto -->
                <th>Ações</th> <!-- Coluna para ações -->
            </tr>
        </thead>
        <tbody>
            <?php while ($lin = $res->fetch_array()) { ?>
                <tr>
                    <td><?php echo $lin['email']; ?></td>
                    <td><?php echo $lin['id_prod']; ?></td>
                    <td><?php echo $lin['titulo']; ?></td>
                    <td><?php echo $lin['preco']; ?> €</td>
                    <td>
                        <!-- Exibe a foto do produto com um tamanho pequeno e clicável para ampliar -->
                        <img src='<?php echo $lin['foto_prod']; ?>' height='50' width='50' style="cursor:pointer;" onclick="openModal('<?php echo $lin['foto_prod']; ?>')">
                    </td>
                    <td>
                        <!-- Botão para remover favorito -->
                        <a href="index.php?cmd=delfav&email=<?php echo urlencode($lin['email']); ?>&id_prod=<?php echo urlencode($lin['id_prod']); ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Tem a certeza que deseja remover este favorito?');">
                           Remover Favorito
                        </a>
                    </td>
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

<!-- CSS para o modal -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.9);
    }

    .modal-content {
        margin: auto;
        display: block;
        max-width: 90%;
        max-height: 90%;
        object-fit: contain; /* Mantém a proporção da imagem */
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
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
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        var img = new Image();

        img.onload = function() {
            modalImg.src = src;
            modal.style.display = "block";
            modalImg.style.width = (this.width > 700) ? '90%' : this.width + 'px';
            modalImg.style.height = (this.height > 700) ? '90%' : this.height + 'px';
        };

        img.src = src; // Define o caminho da imagem
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>
