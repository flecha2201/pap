<footer style="background: linear-gradient(45deg, #524ae3, #938bf0); color: #fff; font-family: Poppins, position: fixed; left: 0; bottom: 0; width: 100%;sans-serif; padding: 20px 10px; text-align: center;">


    <div class="container2">
        <!-- Seções de Navegação -->
        <div class="wrapper">
            <!-- Sobre -->
			
            <div class="footer-widget">
                <h6>Sobre</h6>
                <ul>
                    <li><a href="index.php?cmd=quem_somos">Quem Somos</a></li>
                </ul>
				 <div class="social-icons">
        <?php include 'social-icons.php'; ?>
    </div>
            </div>
<div class="footer-widget"></div>
            <!-- Ajuda & Suporte -->
            <div class="footer-widget">
                <h6>Ajuda & Suporte</h6>
                <ul>
                    <li><a href="index.php?cmd=contactos">Contactos</a></li>
                    <li><a href="index.php?cmd=locs">Postos ReVibe</a></li>
                    <li><a href="index.php?cmd=faq">FAQ</a></li>
                    <li><a href="termos.php">Termos & Condições</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
         <div class="copyright-wrapper" style="text-align: center; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.2); margin-top: 100px;">
            <p>Copyright © 2024 Todos os direitos reservados | Rafael Rosado</p>
        </div>
    </div>
</footer>

<style>
    body {
    display: flex; /* Ativa Flexbox no body */
    flex-direction: column; /* Define a direção do Flexbox para coluna (vertical) */
    min-height: 100vh; /* Garante que o body ocupa pelo menos 100% da altura do viewport */
}

.container.mt-5 { /* Se o seu conteúdo principal está dentro de um container com a classe 'container mt-5' */
    flex: 1; /* Faz com que o container de conteúdo principal cresça e ocupe o espaço vertical disponível */
}

footer { /* Se o seu rodapé estiver dentro de uma tag <footer>, ajuste conforme necessário */
    margin-top: auto; /* Empurra o rodapé para a parte inferior, utilizando o espaço 'auto' de margem superior */
}

</style> 