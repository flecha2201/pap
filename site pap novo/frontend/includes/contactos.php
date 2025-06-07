<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
    <link rel="stylesheet" href="./assets/css/contactos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1>Contactos</h1>
            <p>Estamos disponíveis para ajudar. Entre em contacto conosco!</p>
        </div>
    </header>

    <main class="main-container">
        <section class="contact-info">
            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <h2>Endereço</h2>
                <p>Rua Exemplo, 123 - Lisboa, Portugal</p>
            </div>
            <div class="info-item">
                <i class="fas fa-phone"></i>
                <h2>Telefone</h2>
                <p>+351 123 456 789</p>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <h2>Email</h2>
                <p>contacto@empresa.pt</p>
            </div>
        </section>

        <section class="map">
            <h2>Localização</h2>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3111.0302082326895!2d-9.3188287!3d38.7821773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1ece29cc75c5d1%3A0xb51072528893ed5!2sEscola%20Secund%C3%A1ria%20Leal%20da%20C%C3%A2mara!5e0!3m2!1spt-PT!2spt!4v1699937042377!5m2!1spt-PT!2spt" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>

        <section class="contact-form">
            <h2>Envie-nos uma mensagem</h2>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" placeholder="Seu nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Seu email" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea id="message" name="message" rows="5" placeholder="Sua mensagem" required></textarea>
                </div>
                <button type="submit">Enviar</button>
            </form>
        </section>
    </main>

<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Painel de Utilizador</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="user-info text-center">
         <img src="<?php echo $_SESSION['foto_ut']; ?>" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
          <h4><?php echo $_SESSION['username']; ?></h4>
          <hr>
          <a href="index.php?cmd=perfil" class="btn btn-outline-primary w-100 mb-2">Editar Perfil</a>
          <a href="index.php?cmd=logout" class="btn btn-outline-danger w-100">Logout</a>
        </div>
      </div>
    </div>
  </div>
</div>
    <footer class="footer">

    </footer>
</body>
</html>