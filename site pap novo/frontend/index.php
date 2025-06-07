<?php
session_start();
include "includes/ligamysql.php";
if(isset($_REQUEST['cmd']))
	$cmd=$_REQUEST['cmd'];
else 
	$cmd="home1";
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ReVibe</title>
	<link rel="website icon" href="./assets/images/logo.png">
	<link rel="stylesheet" href="assets/css/footer.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <link rel="stylesheet" href="./assets/js/pro.min.js">
	<link rel="stylesheet" href="./assets/css/home.css"/>
	<link rel="stylesheet" href="./assets/css/pesquisa.css">
	<link rel="stylesheet" href="./assets/css/tops.css">
</head>
<body>

<button class="button-tops">
  <svg class="svgIcon" viewBox="0 0 384 512">
    <path
      d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
    ></path>
  </svg>
</button>

<style>
:root {
    --portage-dark: #6a49c2; /* Tom mais escuro de portage */
    --royal-blue-dark: #3a32a8; /* Tom mais escuro de royal blue */
    --perfume-dark: #8b69c7; /* Tom mais escuro de perfume */
    --spindle-dark: #8a89a2; /* Tom mais escuro de spindle */

    --portage: #9572f1;
    --hawkes-blue: #d3d3fb;
    --perfume: #b690f7;
    --royal-blue: #524ae3;
    --portage-light: #938bf0;
    --perfume-light: #c1b0fb;
    --link-water: #f1f1fc;
    --perano: #b0aff5;
    --selago: #ece4fc;
    --spindle: #bcbcec;
}
        #removeAlert {
            display: none;
            padding: 15px 25px;
            background-color: rgb(220, 53, 69);
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: fixed;
            top: 20px;
            right: 2%;
            transform: translateX(-50%) translateY(-100%);
            z-index: 9999;
            transition: transform 0.5s ease-out, opacity 0.5s ease-out;
            opacity: 0;
        }

        #removeAlert.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        #wishAlert {
    display: none;
    padding: 15px 25px;
    background-color: var(--perano); /* Tom claro para representar sucesso */
    color: #000; /* Texto preto para contraste */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: fixed;
    top: 20px;
    right: 2%;
    transform: translateX(-50%) translateY(-100%);
    z-index: 9999;
    transition: transform 0.5s ease-out, opacity 0.5s ease-out;
    opacity: 0;
}

#wishAlert.show {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
}

#wishAlertE {
    display: none;
    padding: 15px 25px;
    background-color: var(--royal-blue); /* Tom mais escuro e chamativo */
    color: #fff; /* Texto branco para contraste */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: fixed;
    top: 20px;
    right: -2%;
    transform: translateX(-50%) translateY(-100%);
    z-index: 9999;
    transition: transform 0.5s ease-out, opacity 0.5s ease-out;
    opacity: 0;
}

#wishAlertE.show {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
}

/* Estilização do modal */
#productModal .modal-content {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

/* Estilo da imagem no modal */
#productModal .product-image-modal img {
    width: 100%; /* Faz com que ocupe toda a largura do container */
    max-width: 400px; /* Define uma largura máxima */
    height: auto; /* Mantém a proporção da imagem */
    display: block;
    margin: 0 auto; /* Centraliza horizontalmente */
    border-radius: 10px;
    object-fit: contain; /* Garante que toda a imagem seja visível */
   

}

.modal .modal-header {
  background: linear-gradient(45deg, #524ae3, #9572f1); /* Cores mais vibrantes */
  color: #ffffff;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.modal .modal-content {
  background: #ece4fc; /* Fundo mais luminoso */
  border-radius: 15px;
  border: none;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}

.modal .btn-close {
  background-color: #ffffff;
  border: 2px solid #524ae3;
  border-radius: 50%;
  padding: 5px;
  transition: all 0.3s ease;
}

.modal .btn-close:hover {
  background-color: #9572f1;
  color: #ffffff;
  border-color: #524ae3;
}

.modal .user-info img {
  border: 4px solid #524ae3;
  border-radius: 50%;
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}

.modal .btn-outline-primary {
  background: #524ae3;
  border: 1px solid #9572f1;
  color: #ffffff;
  transition: all 0.3s ease;
}

.modal .btn-outline-primary:hover {
  background: #9572f1;
  color: #ffffff;
}

.modal .btn-outline-danger {
  background: #ff5e57;
  border: 1px solid #e63946;
  color: #ffffff;
  transition: all 0.3s ease;
}

.modal .btn-outline-danger:hover {
  background: #e63946;
  color: #ffffff;
}

/* Melhor espaçamento para as informações */
#productModal .product-details {
    flex: 1;
    padding: 20px;
    font-size: 16px;
}

#productModal .product-details h4 {
    font-size: 24px;
    margin-bottom: 15px;
    color: #524ae3; /* Tom da palete do logotipo */
}

#productModal .product-details p {
    margin-bottom: 10px;
    line-height: 1.6;
}

#productModal .seller-avatar img {
    border: 2px solid #d3d3fb; /* Contorno azul claro */
    padding: 2px;
}

/* Botão de favorito */
#productModal .favorite-checkbox {
    display: none;
}

#productModal .favorite-container {
    display: left;
    cursor: pointer;
    transition: transform 0.2s;
}

#productModal .favorite-container:hover {
    transform: scale(1.2);
}

#productModal .modal-footer {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 10px;
    padding-top: 15px;
    border-top: 1px solid #ddd;
}

			</style>
<?php
if (isset($_SESSION['tipo'])) {
    // Menu para utilizadores logados
    switch ($cmd) {
        // Menu logado
		case 'home2': require('includes/menusemlogin.php');  break;
        case 'home1': require('includes/menulogado.php');  break;
		case 'login': require('login/login.php');   break;
		case 'form-login' : require('includes/form_login.php'); break;
		case 'signup': require('login/signup.php');   break;
        case 'logout': require('login/logout.php');   break;
		case 'perfil': require('includes/perfil.php');   break;
		case 'def_conta': require('includes/def_conta.php'); break;
		case 'updtut': require('utilizador/updtut.php'); break;
		case 'updt_conta': require('utilizador/updt_conta.php'); break;
		case 'updtpfput': require('utilizador/updtpfput.php'); break;
		case 'updatepass': require('utilizador/updatepass.php'); break;
		case 'pass': require('includes/pass.php'); break;
		case 'ver_mais': require('includes/ver_mais.php'); break;
        case 'lisfav': require('produtos/lisfav.php'); break;
        case 'pdfav' : require('pdf/pdfav.php');	break;
		case 'quem_somos': require('includes/quem_somos.php'); break;
		case 'contactos': require('includes/contactos.php'); break;
		case 'produto_detalhes': require('includes/produto_detalhes.php'); break;
		case 'armario': require('includes/armario.php'); break;
        case 'pesquisa': require('includes/pesquisa.php'); break;
        case 'load_more': require('includes/load_more.php'); break;
		case 'locs': require('includes/locs.php'); break;
        case 'vender': require('includes/vender.php'); break;
        case 'edprod': require('produtos/edprod.php'); break;
        case 'del_img' : require('produtos/del_img.php');   break;
        case 'conta' : require('includes/conta.php');   break;
        case 'perfis' : require('includes/perfis.php');   break;
		case 'checkout' : require('includes/checkout.php');   break;
		case 'encomendas' : require('includes/encomendas.php');   break;
		case 'processar_checkout' : require('includes/processar_checkout.php');   break;
        case 'faq' : require('includes/faq.php');   break;




		
        // Produtos
        case 'addprod': require('produtos/addprod.php'); break;
        case 'insprod': require('produtos/insprod.php'); break;
        case 'lisprod': require('produtos/lisprod.php'); break;
        case 'delprod': require('produtos/delprod.php'); break;
        case 'updtprod': require('produtos/updtprod.php'); break;
		case 'wishlist': require ('html/wishlist.php'); break;
		case 'remove-wish': require ('html/remove-wishlist.php'); break;
		case 'add-wish': require ('html/add-wishlist.php'); break;
        // Utilizadores
        case 'lisut': require('utilizador/lisut.php'); break;
        
        // Outros comandos específicos

        // Erro
        default: echo "Opção inválida 1"; break;
    }
} else {
    // Menu para utilizadores não logados
    switch ($cmd) {
        case 'home2': require('includes/menusemlogin.php');  break;
		case 'logout': require('login/logout.php');   break;
		case 'login': require('login/login.php');   break;
		case 'signup': require('login/signup.php');   break;
		case 'home1': require('includes/menulogado.php');  break;
        // Páginas de acesso
		case 'form-login': require('includes/form_login.php'); break;
        case 'paglog': require('login/login.html');   break;
        case 'signup': require('Signup/signup.php');   break;
		case 'perfil': require('includes/perfil.php');   break;
		case 'def_conta': require('includes/def_conta.php'); break;
		case 'updtut': require('utilizador/updtut.php'); break;
		case 'updt_conta': require('utilizador/updt_conta.php'); break;
		case 'updtpfput': require('utilizador/updtpfput.php'); break;
		case 'ver_mais': require('includes/ver_mais.php'); break;
		case 'lisfav': require('produtos/lisfav.php'); break;
		case 'addprod': require('produtos/addprod.php'); break;
        case 'insprod': require('produtos/insprod.php'); break;
        case 'lisprod': require('produtos/lisprod.php'); break;
        case 'delprod': require('produtos/delprod.php'); break;
		case 'quem_somos': require('includes/quem_somos.php'); break;
		case 'contactos': require('includes/contactos.php'); break;
		case 'wishlist': require ('html/wishlist.php'); break;
		case 'remove-wish': require ('html/remove-wishlist.php'); break;
		case 'add-wish': require ('html/add-wishlist.php'); break;
		case 'produto_detalhes': require('includes/produto_detalhes.php'); break;
		case 'armario': require('includes/armario.php'); break;
        case 'delprod': require('produtos/delprod.php'); break;
        case 'pesquisa': require('includes/pesquisa.php'); break;
        case 'locs': require('includes/locs.php'); break;
        case 'vender': require('includes/vender.php'); break;
        case 'edprod': require('produtos/edprod.php'); break;
        case 'updtprod': require('produtos/updtprod.php'); break;
        case 'del_img' : require('produtos/del_img.php');   break;
        case 'conta' : require('includes/conta.php');   break;
		case 'load_more': require('includes/load_more.php'); break;
        case 'perfis' : require('includes/perfis.php');   break;
        case 'checkout' : require('includes/checkout.php');   break;
        case 'encomendas' : require('includes/encomendas.php');   break;
		case 'processar_checkout' : require('includes/processar_checkout.php');   break;
        case 'faq' : require('includes/faq.php');   break;


        // Detalhes de produtos sem login
        case 'detailnologin': require('html/detailnologin.php');   break;
		
		case 'updatepass': require('utilizador/updatepass.php'); break;
		case 'pass': require('includes/pass.php'); break;
        // Páginas do site
        case 'contact': require('html/contact.php');   break;
        case 'faq': require('html/faq.html');   break;
        case 'termos': require('html/termos.html');   break;
        case 'cookies': require('html/cookies.html');   break;
		case 'pdfav' : require('pdf/pdfav.php');	break;
        // Erro
        default: echo "Opção inválida 2"; break;
    }
}
?>
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Detalhes do Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex">
                <div class="product-image-modal me-4">
                    <img src="" alt="Produto" class="img-fluid rounded" id="modalProductImage">
                </div>

                <div class="product-details">
                    <h4 id="modalProductTitle"></h4>
                    <p><strong>Descrição:</strong> <span id="modalProductDescription"></span></p>
                    <p><strong>Preço:</strong> <span id="modalProductPrice"></span></p>
                    <p><strong>Tamanho:</strong> <span id="modalProductSize"></span></p>
                    <p><strong>Categoria:</strong> <span id="modalProductCategory"></span></p>
                    <div class="seller-avatar d-flex align-items-center">
                        <img src="" alt="Vendedor" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;" id="modalSellerAvatar">
                        <span id="modalSellerName"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 

include 'includes/footer.php'; ?>
<script>
function addWishlist(id_prod) {
    const xhttp = new XMLHttpRequest();

    xhttp.onload = function () {
        const response = this.responseText.trim();

        if (response === "add") {
            const wishAlert = document.getElementById('wishAlert');
            wishAlert.style.display = 'block';
            setTimeout(() => {
                wishAlert.classList.add('show');
            }, 10);

            setTimeout(() => {
                wishAlert.classList.remove('show');
                setTimeout(() => {
                    wishAlert.style.display = 'none';
                }, 500);
            }, 3000);
        } else if (response === "exists") {
            const wishAlertE = document.getElementById('wishAlertE');
            wishAlertE.style.display = 'block';
            setTimeout(() => {
                wishAlertE.classList.add('show');
            }, 10);

            setTimeout(() => {
                wishAlertE.classList.remove('show');
                setTimeout(() => {
                    wishAlertE.style.display = 'none';
                }, 500);
            }, 3000);
        } else /*if (response === "error")*/ {
            alert('Erro ao adicionar o item: ' + response);
        }
    };

    xhttp.open("GET", "html/add-wishlist.php?id_prod=" + id_prod, true);
    xhttp.send();
}

// Função para remover itens da wishlist
function removeWishlist(id_prod) {
    const xhttp = new XMLHttpRequest();

    xhttp.onload = function () {
        const response = this.responseText.trim();

        if (response === "remove") {
            // Exibir a mensagem de sucesso
            const removeAlert = document.getElementById('removeAlert');
            removeAlert.style.display = 'block';
            setTimeout(() => {
                removeAlert.classList.add('show');
            }, 10);

            setTimeout(() => {
                removeAlert.classList.remove('show');
                setTimeout(() => {
                    removeAlert.style.display = 'none';
                }, 500);
            }, 3000);

            const itemElement = document.getElementById(`wishlist-item-${id_prod}`);
            if (itemElement) {
                const row = itemElement.closest('tr'); // A linha da tabela
                row.remove();

                // Verificar se a tabela está vazia
                const tableBody = document.querySelector('.table-wishlist tbody');
                if (tableBody && tableBody.children.length === 0) {
                    // Substituir tabela por mensagem de lista vazia
                    const container = document.querySelector('.table-wishlist');
                    container.innerHTML = `
                        <center><h1 style="margin-top: 3%;">Não tem nenhum item nos seus favoritos!</h1></center>
                    `;
                }
            }
        } else if (response === "not_found") {
            alert('O item não foi encontrado nos seus favoritos.');
        } else {
            alert('Erro ao remover o item: ' + response);
        }
    };

    xhttp.open("GET", "html/remove-wishlist.php?id_prod=" + id_prod, true);
    xhttp.send();
}


function toggleWishlist(id_prod) {
    const checkbox = document.getElementById(`favorite-${id_prod}`);
    const heartIcon = checkbox.nextElementSibling.querySelector('svg');

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = this.responseText.trim();

        if (response === "add") {
            // Produto foi adicionado aos favoritos
            document.getElementById('wishAlert').style.display = 'block';
            setTimeout(() => document.getElementById('wishAlert').classList.add('show'), 10);
            setTimeout(() => {
                document.getElementById('wishAlert').classList.remove('show');
                setTimeout(() => document.getElementById('wishAlert').style.display = 'none', 500);
            }, 3000);

            // Atualizar ícone do coração
            checkbox.checked = true;
            heartIcon.setAttribute("fill", "red");

        } else if (response === "remove") {
            // Produto foi removido dos favoritos
            document.getElementById('removeAlert').style.display = 'block';
            setTimeout(() => document.getElementById('removeAlert').classList.add('show'), 10);
            setTimeout(() => {
                document.getElementById('removeAlert').classList.remove('show');
                setTimeout(() => document.getElementById('removeAlert').style.display = 'none', 500);
            }, 3000);

            // Atualizar ícone do coração
            checkbox.checked = false;
            heartIcon.setAttribute("fill", "none");
        } else {
            alert('Erro ao processar: ' + response);
        }
    };

    xhttp.open("GET", "html/toggle-wishlist.php?id_prod=" + id_prod, true);
    xhttp.send();
}


		</script>
		<script>
  document.addEventListener("DOMContentLoaded", function () {
    const btnTop = document.querySelector(".button-tops");

    btnTop.addEventListener("click", function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth" // Rolagem suave
      });
    });
  });
  
  document.querySelectorAll('.product-thumb').forEach((img, index) => {
    img.addEventListener('click', (event) => {
        event.stopPropagation();

        const card = img.closest('.card');
        const imageSrc = img.getAttribute('src');
        const title = card.querySelector('.card-title').textContent;
        const description = card.querySelector('.card-body').getAttribute('data-description');
        const cardTextElement = card.querySelector('.card-text');
        let price = 'N/D';
        let category = 'N/D';
        let size = 'N/D'; // Valor padrão para o tamanho, caso não seja encontrado

        if (cardTextElement) {
            const textContent = cardTextElement.textContent;
            const priceMatch = textContent.match(/Preço: €([\d.]+)/);
            if (priceMatch && priceMatch[1]) {
                price = priceMatch[1];
            }
            const categoryMatch = textContent.match(/Categoria: (.+)/);
            if (categoryMatch && categoryMatch[1]) {
                category = categoryMatch[1];
            }
			const sizeMatch = textContent.match(/Tamanho: (.+)/);
            if (sizeMatch && sizeMatch[1]) {
                size = sizeMatch[1];
            }
        }
        // Extrai o tamanho do elemento com a classe product-short-description


        const username = card.querySelector('.user-name').textContent;
        const userAvatar = card.querySelector('.user-info img').getAttribute('src');

        // Console log para verificar os valores extraídos
        console.log("Extracted Data:", {
            title: title,
            description: description,
            price: price,
            category: category,
            size: size,
            username: username,
            userAvatar: userAvatar,
            imageSrc: imageSrc
        });

        document.getElementById('modalProductImage').setAttribute('src', imageSrc);
        document.getElementById('modalProductTitle').textContent = title;
        document.getElementById('modalProductDescription').textContent = description;
        document.getElementById('modalProductPrice').textContent = price + '€';
        document.getElementById('modalProductCategory').textContent = category;
        document.getElementById('modalProductSize').textContent = size;
        document.getElementById('modalSellerAvatar').setAttribute('src', userAvatar);
        document.getElementById('modalSellerName').textContent = username;

        const productModal = new bootstrap.Modal(document.getElementById('productModal'));
        productModal.show();
    });
});
</script>

</body>
</html>
