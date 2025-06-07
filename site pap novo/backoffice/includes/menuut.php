<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid w-100">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="index.php?cmd=home">Início</a>
        </li>

        <!-- Menu Tipo Gestor -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Tipo Gestor</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?cmd=addtg">Inserir Tipo Gestor</a></li>
            <li><a class="dropdown-item" href="index.php?cmd=listg">Listar Tipo Gestor</a></li>
          </ul>
        </li>

        <!-- Menu Gestores -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Gestores</a>
          <ul class="dropdown-menu">
           
            <li><a class="dropdown-item" href="index.php?cmd=lisgest">Listar Gestores</a></li>
          </ul>
        </li>

        <!-- Menu Produtos -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Produtos</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?cmd=addprod">Inserir Produto</a></li>
            <li><a class="dropdown-item" href="index.php?cmd=lisprod">Listar Produtos</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Utilizadores</a>
          <ul class="dropdown-menu">
           
            <li><a class="dropdown-item" href="index.php?cmd=lisut">Listar Utilizador</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Faturas</a>
    <ul class="dropdown-menu">
   
        <li><a class="dropdown-item" href="index.php?cmd=lisfat">Listar Faturas</a></li>
    </ul>
</li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Categorias</a>
          <ul class="dropdown-menu">

            <li><a class="dropdown-item" href="index.php?cmd=liscat">Listar Categorias</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Categorias Produtos</a>
          <ul class="dropdown-menu">
          
            <li><a class="dropdown-item" href="index.php?cmd=liscatprod">Listar Categorias de Produtos</a></li>
          </ul>
        </li>

        <!-- Menu Mensagens 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Mensagens</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?cmd=addmsg">Adicionar Mensagem</a></li>
            <li><a class="dropdown-item" href="index.php?cmd=lismsg">Listar Mensagens</a></li>
          </ul>
        </li>-->

        <!-- Menu Carrinho
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Carrinho</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?cmd=addcar">Adicionar ao Carrinho</a></li>
            <li><a class="dropdown-item" href="index.php?cmd=liscar">Listar Carrinho</a></li>
          </ul>
        </li>-->

  

        <!-- Menu Favoritos -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Favoritos</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?cmd=addfav">Adicionar Favorito</a></li>
            <li><a class="dropdown-item" href="index.php?cmd=lisfav">Listar Favoritos</a></li>
          </ul>
        </li>

      </ul>
    </div>
	
		<div class="d-flex ms-auto align-items-center" style="flex-grow: 1; justify-content: flex-end;">
    <span class="navbar-text me-3">Olá <?php echo $_SESSION['nome']; ?></span>
    <a class="nav-link" href="index.php?cmd=logout" title="Logout">
    <i class="bi bi-door-open" style="font-size: 1.5rem; color:white;"></i>
    </a>
    </div>
	
  </div>
</nav>
