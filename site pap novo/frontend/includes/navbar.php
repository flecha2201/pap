<style>
        .custom-navbar {
            background-color: #d3d2ff;
            padding: 10px 15px;
        }
        .form-control {
            border-radius: 25px;
            width: 300px;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }
        .hero-content {
            background-color: rgba(255, 255, 255, 1);
            padding: 20px;
            max-width: 300px;
            text-align: left;
        }
        /* Estilo para animação de entrada do modal */
        .modal.fade .modal-dialog {
            transform: translateY(-100px);
            transition: transform 0.3s ease-in-out;
        }
        .modal.show .modal-dialog {
            transform: translateY(0);
        }
    </style>
<!-- Navbar -->
<nav class="navbar navbar-expand-sm custom-navbar">
  <div class="container-fluid">
    <a href="index.php?cmd=home1" class="navbar-brand">
        <img src="./assets/images/logo.png" alt="Logotipo" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php?cmd=addtg"><b>Mulher</b></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?cmd=listg"><b>Homem</b></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?cmd=listg"><b>Criança</b></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?cmd=listg"><b>Casa</b></a></li>
      </ul>
      <form class="d-flex mx-auto">
        <input class="form-control me-2" type="text" placeholder="Pesquisar artigos">
      </form>
      <img src="<?php echo $_SESSION['foto_ut']; ?>" alt="Avatar" class="avatar" data-bs-toggle="modal" data-bs-target="#profileModal">
    </div>
  </div>
</nav>