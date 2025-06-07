<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
  <style>
    :root {
      --portage-dark: #6a49c2;
      --royal-blue-dark: #3a32a8;
      --perfume-dark: #8b69c7;
      --spindle-dark: #8a89a2;
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

    body {
      margin: 0;
      background: linear-gradient(135deg, var(--link-water), var(--selago));
      color: var(--royal-blue-dark);
    }

    .faq-container {
      max-width: 800px;
      margin: 60px auto;
      padding: 30px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(82, 74, 227, 0.2);
    }

    h1 {
      text-align: center;
      color: var(--royal-blue);
      margin-bottom: 30px;
    }

    .faq-item {
      border-bottom: 1px solid var(--spindle);
    }

    .faq-question {
      padding: 15px 20px;
      background-color: var(--portage-light);
      cursor: pointer;
      position: relative;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .faq-question:hover {
      background-color: var(--portage);
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      background-color: var(--link-water);
      transition: max-height 0.4s ease, padding 0.4s ease;
      padding: 0 20px;
    }

    .faq-answer.open {
      padding: 15px 20px;
      max-height: 400px;
    }

    .faq-question::after {
      content: '+';
      position: absolute;
      right: 20px;
      font-size: 22px;
    }

    .faq-question.active::after {
      content: '−';
    }
  </style>
</head>
<body>

  <div class="faq-container">
    <h1>Perguntas Frequentes (FAQ)</h1>

    <div class="faq-item">
      <div class="faq-question">Como posso vender um produto?</div>
      <div class="faq-answer">
        Basta clicar no botão "Vender" na página inicial, preencher os detalhes do seu produto, adicionar imagens e submeter. Após aprovação, o anúncio ficará visível no site.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">Os produtos são verificados antes da venda?</div>
      <div class="faq-answer">
        Sim, todos os anúncios passam por uma verificação manual para garantir que cumprem os nossos critérios de qualidade e segurança.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">Como são feitos os pagamentos?</div>
      <div class="faq-answer">
        Os pagamentos são feitos através de métodos seguros como MB Way, PayPal ou transferência bancária. O comprador efetua o pagamento e este é libertado ao vendedor após confirmação da receção.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">Posso devolver um produto comprado?</div>
      <div class="faq-answer">
        Sim, aceitamos devoluções até 14 dias após a receção, desde que o produto esteja nas mesmas condições em que foi recebido. Consulte os nossos <a href="#">termos de devolução</a> para mais detalhes.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">Como entro em contacto com o suporte?</div>
      <div class="faq-answer">
        Pode entrar em contacto connosco através da secção <a href="/contactos.php">Contactos</a>. Respondemos geralmente em menos de 24h úteis.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">Existe alguma taxa de utilização do site?</div>
      <div class="faq-answer">
        Criar conta e navegar é gratuito. Apenas cobramos uma pequena comissão em vendas concluídas com sucesso.
      </div>
    </div>

  </div>

  <script>
    const questions = document.querySelectorAll('.faq-question');
    questions.forEach(question => {
      question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        question.classList.toggle('active');
        answer.classList.toggle('open');
      });
    });
  </script>

</body>
</html>
