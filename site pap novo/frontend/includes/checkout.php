<head>
    <link rel="stylesheet" href="./assets/css/checkout.css">

<script src="https://www.paypal.com/sdk/js?client-id=AbEwjcUGSOh7oIBSi6lfmJUZxwvHxp7oV_xRLUYgolZtFRLMKvtAb1mfro21vhUUntj-ralDCXyxSlUB"></script>
</head>
<body>
    <?php
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

 if(!isset($_SESSION['email'])) {
?>
        <div class="login-required-container">
            <h1 class="login-required-message">É necessário estar logado para finalizar a compra.</h1>
            <a href="index.php?cmd=form-login" class="login-required-link">Login</a>
        </div>
<?php
        exit;
    }

    if ($lig->connect_error) {
        die("Connection failed: " . $lig->connect_error);
    }

    if (!isset($_GET['id_prod'])) {
        echo "Produto não especificado.";
        exit;
    }

    $id_prod = intval($_GET['id_prod']);
    $sql_produto = "
        SELECT P.*, U.username, U.foto_ut
        FROM Produtos P
        JOIN utilizador U ON P.email = U.email
        WHERE P.id_prod = $id_prod
    ";
    $result_produto = $lig->query($sql_produto);

    if ($result_produto->num_rows == 0) {
        echo "Produto não encontrado.";
        exit;
    }
    $produto = $result_produto->fetch_assoc();

    $sql_imagens = "SELECT caminho_img FROM prod_imgs WHERE id_produto = $id_prod";
    $result_imagens = $lig->query($sql_imagens);

    $imagens = [];
    while ($row = $result_imagens->fetch_assoc()) {
        $imagens[] = $row['caminho_img'];
    }
    array_unshift($imagens, $produto['foto_prod']);

    $user_data = [];
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql_user = "SELECT * FROM utilizador WHERE email = '$email'";
        $result_user = $lig->query($sql_user);
        if ($result_user->num_rows > 0) {
            $user_data = $result_user->fetch_assoc();
        }
    }

    $preco_total = $produto['preco']; // Preço total é o preço do produto
    $portes = 5; // Defina um valor fixo para portes ou calcule dinamicamente
    $total_portes = $preco_total + $portes;

    ?>
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
    <div class="checkout-container">
        <div class="checkout-section">
            <h1 class="checkout-header">Checkout</h1>

            <h2>Informações de Envio</h2>

            <form method="POST" id="form-checkout" action="index.php?cmd=processar_checkout">
                <div class="form-group">
                    <label for="name">Nome Completo *</label>
                    <input class="input1"type="text" id="name" name="name" value="<?= htmlspecialchars($user_data['nome_completo'] ?? '') ?>" required placeholder="Ex: João Silva">
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input class="input1" type="email" id="email" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" required placeholder="Ex: email@exemplo.com">
                </div>

                <div class="form-group">
                    <label for="phone">Telefone *</label>
                    <input class="input1"type="text" id="tel" name="phone" value="<?= htmlspecialchars($user_data['nmr_tel'] ?? '') ?>" required placeholder="Ex: 912345678">
                </div>

                <div class="form-group">
                    <label for="address">Morada de Destino *</label>
                    <input class="input1"type="text" id="address" name="address" value="<?= htmlspecialchars($user_data['morada'] ?? '') ?>"required placeholder="Ex: Rua Exemplo, nº 123 andar 2A">
                </div>

                <div class="form-group">
                    <label for="zip">Código Postal *</label>
                    <input class="input1"type="text" id="zip" name="zip" value="<?= htmlspecialchars($user_data['cod_postal'] ?? '') ?>" required placeholder="Ex: 1234-567">
                </div>
				
				<div class="form-group">
                    <label for="NIF">NIF *</label>
                    <input class="input1"type="number" id="NIF" name="NIF" value="<?= htmlspecialchars($_SESSION['NIF'] ?? '') ?>" required placeholder="Ex: 123456789">
                </div>

                


                <hr class="my-4">
                <span class="msg-erro form-invalido"></span>
                <div id="paypal-button-container"></div>
                <br><br><br>
        </div>

        <div class="checkout-section review-section">
            <h2>Resumo da Compra</h2>
            <div class="review-item">
                <img src="<?= htmlspecialchars($produto['foto_prod']) ?>" alt="Produto">
                <div>
                    <div class="item-name"><?= htmlspecialchars($produto['titulo']) ?></div>
                    <div class="item-price"><?= number_format($produto['preco'], 2) ?> €</div>
                     <div class="item-price tooltip-portes">Portes: <?= number_format($portes, 2) ?> €
                        <span class="tooltiptext">Os portes de envio são uma taxa para cobrir os custos de manuseamento, embalagem, envio do seu produto e a segurança que chega a si.</span>
                    </div>
                </div>
            </div>
    <div class="form-group">
    <input type="hidden" name="id_prod" value="<?= $id_prod ?>">
<input type="hidden" name="preco" id="input-preco" value="<?= number_format($total_portes, 2, '.', '') ?>">



        <label for="codigo_promo">Código Promocional:</label>
        <input class="input1" type="text" id="codigo_promo" name="codigo_promo" placeholder="Insira o código">
        <button class= "button" type="button" onclick="aplicarCodigoPromo()">Aplicar</button>
    </div>

    <div class="list-group-item d-flex justify-content-between">
        <span>Total (EUR)</span>
        <strong id="total-final"><?php echo number_format($total_portes, 2); ?>€</strong>
    </div>

    <div id="paypal-button-container"></div>
    <button class= "button" type="submit" id="botao-comprar" style="display: none;">Proceder</button>
</form>
        </div>
    </div>

    <script>
 var cart_total = <?php echo $total_portes;?>;
var original_total = cart_total;
        function validateForm(){
            let isValid = true;
            const requiredFields = ['name', 'email', 'tel', 'address', 'zip', 'NIF'];

            requiredFields.forEach(function(field){
                const input = document.getElementById(field);
                if(input.value.trim() === ''){
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            return isValid;
        }

        paypal.Buttons({
            onInit: function(data, actions) {
                actions.disable();

                document.querySelectorAll('input').forEach(function(input) {
                    input.addEventListener('change', function() {
                        if(validateForm()){
                            actions.enable();
                        } else{
                            actions.disable();
                        }
                    });
                });
					if(validateForm()){
                        actions.enable();
                    }
            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: cart_total.toFixed(2)
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Pagamento bem-sucedido! Obrigado por comprar connosco.');
                    document.getElementById('form-checkout').submit();
                });
            }
        }).render('#paypal-button-container');

		window.onload = function() {
			if(validateForm()){
				paypal.Buttons.driver.find('#paypal-button-container').buttons[0].enable();
			}
		};

		function aplicarCodigoPromo() {
        let codigo = document.getElementById('codigo_promo').value.trim();
        let totalSpan = document.getElementById('total-final');
        let paypalContainer = document.getElementById('paypal-button-container');
        let btnComprar = document.getElementById('botao-comprar');

        if (codigo === "DEMO100") {
            cart_total = 0;
            totalSpan.textContent = "0.00€";
            paypalContainer.style.display = 'none'; // Esconde o botão do PayPal
            btnComprar.style.display = 'block'; // Mostra o botão "Comprar"
        } else {
            cart_total = original_total;
            totalSpan.textContent = original_total.toFixed(2) + "€";
            paypalContainer.style.display = 'block';
            btnComprar.style.display = 'none';
        }
    }
    </script>
</body>
</html>