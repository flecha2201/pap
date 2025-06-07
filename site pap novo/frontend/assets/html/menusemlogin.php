<link rel="stylesheet" href="./assets/css/categorias.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<?php
$icons = [
  'Homem' => 'fa-user-tie',
  'Criança' => 'fa-child',
  'Eletrónica' => 'fa-tv',
  'Mulher' => 'fa-shirt',
  'Vestuário' => 'fa-shirt',
  'Móveis e decoração' => 'fa-couch',
  'Cuidados e higiene' => 'fa-hand-sparkles',
  'Veículos para crianças' => 'fa-car-side',
  // Subcategorias principais
  'Roupa' => 'fa-tshirt',
  'Calçado' => 'fa-shoe-prints',
  'Malas' => 'fa-bag-shopping',
  "Acessórios" => "fa-gem",
  'Beleza' => 'fa-heart',
  
  // Subcategorias em Eletrónica
  'Telemóveis e Tablets' => 'fa-mobile-screen',
  'Computadores e Acessórios' => 'fa-laptop',
  'TV, Áudio e Vídeo' => 'fa-film',
  'Fotografia e Drones' => 'fa-camera-retro',
  'Consolas e Jogos' => 'fa-gamepad',
  'Pequenos Eletrodomésticos' => 'fa-blender',
  
  // Outras categorias específicas
  'Relógios' => 'fa-clock',
  'Óculos de sol' => 'fa-glasses',
  'Perfumes' => 'fa-bottle-droplet',
  'Cuidados pessoais' => 'fa-soap',
  'Material escolar' => 'fa-pencil',
  'Brinquedos' => 'fa-puzzle-piece',
];

?>


<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container-fluid">
    <a href="index.php" class="navbar-brand">
      <img src="./assets/images/logo.png" alt="Logotipo" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav">
        <?php
        // Selecionar categorias principais
        $sql2 = "SELECT * FROM categorias WHERE pai IS NULL";
        $res = $lig->query($sql2);

        while ($lin = $res->fetch_array()) {
          $categoriaNome = $lin['nome_categoria'];
          $iconClass = isset($icons[$categoriaNome]) ? $icons[$categoriaNome] : 'fa-folder'; // Default
          echo "<li class='nav-item'>";
          echo "<a class='nav-link' href='javascript:void(0);' onclick='toggleMenu(" . $lin['cod_categorias'] . ")'>"
             . "<i class='fa " . $iconClass . "'></i> <b>" . $categoriaNome . "</b></a>";

          // Obter subcategorias
          $sqlSub = "SELECT * FROM categorias WHERE pai = " . $lin['cod_categorias'];
          $resSub = $lig->query($sqlSub);

          if ($resSub->num_rows > 0) {
            echo "<ul class='dropdown-menu' id='menu-" . $lin['cod_categorias'] . "'>";
            echo "<li><a class='dropdown-item' href='index.php?cmd=ver_mais&cod=" . $lin['cod_categorias'] . "'>Tudo</a></li>";

            while ($sub = $resSub->fetch_array()) {
              $subCategoriaNome = $sub['nome_categoria'];
              $subIconClass = isset($icons[$subCategoriaNome]) ? $icons[$subCategoriaNome] : 'fa-folder-open';
              echo "<li class='nav-item'>";
              echo "<a class='dropdown-item' href='index.php?cmd=ver_mais&cod=" . $sub['cod_categorias'] . "'>"
                 . "<i class='fa " . $subIconClass . "'></i> " . $subCategoriaNome . "</a>";

              // Obter sub-subcategorias
              $sqlSubSub = "SELECT * FROM categorias WHERE pai = " . $sub['cod_categorias'];
              $resSubSub = $lig->query($sqlSubSub);

              if ($resSubSub->num_rows > 0) {
                echo "<ul class='dropdown-menu' id='menu-" . $sub['cod_categorias'] . "'>";
                echo "<table>";
                echo "<tr><td><a class='dropdown-item' href='index.php?cmd=ver_mais&cod=" . $sub['cod_categorias'] . "'>Tudo</a></td>";
                $i = 1;
                while ($subSub = $resSubSub->fetch_array()) {
                  $i++;
                  echo "<td><a class='dropdown-item' href='index.php?cmd=ver_mais&cod=" . $subSub['cod_categorias'] . "'>"
                     . $subSub['nome_categoria'] . "</a></td>";
                  if ($i == 2) {
                    $i = 0;
                    echo "</tr><tr>";
                  }
                }
                echo "</tr></table>";
                echo "</ul>";
              }
              echo "</li>";
            }
            echo "</ul>";
          }
          echo "</li>";
        }
        ?>
      </ul>

    
     
      <form class="d-flex mr-auto" action="index.php" method="get" style="margin-left: 50px;">
    <input type="hidden" name="cmd" value="pesquisa">
    <div class="control">
        <input class="input input-alt" type="search" name="pesquisa" placeholder="Encontre o seu próximo achado" required="">
        <span class="input-border input-border-alt"></span>
    </div>
</form>
      <!-- Botão de login -->
      <a href="index.php?cmd=form-login" class="gradient-button">Criar conta | Iniciar sessão</a>
    </div>
  </div>
</nav>

<div class="modal fade custom-modal" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
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
		  <a href="index.php?cmd=armario" class="btn btn-outline-primary w-100 mb-2">O meu Armário</a>
          <a href="index.php?cmd=perfil" class="btn btn-outline-primary w-100 mb-2">Definições</a>
          <a href="index.php?cmd=perfis" class="btn btn-outline-primary w-100 mb-2">Editar Perfil</a>
          <a href="index.php?cmd=logout" class="btn btn-outline-danger w-100">Logout</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
let openMenuId = null;

function toggleMenu(id) {
  const menu = document.getElementById(`menu-${id}`);

  // Fechar o menu atual se estiver aberto
  if (openMenuId && openMenuId !== id) {
    document.getElementById(`menu-${openMenuId}`).style.display = 'none';
  }

  // Alternar o estado do menu clicado
  if (menu.style.display === 'block') {
    menu.style.display = 'none';
    openMenuId = null;
  } else {
    menu.style.display = 'block';
    openMenuId = id;
  }
}

// Adicionar eventos de hover (mouseenter e mouseleave) para exibir/esconder menus
document.querySelectorAll('.nav-item').forEach((item) => {
  const menuId = item.querySelector('.dropdown-menu')?.id;

  if (menuId) {
    const menu = document.getElementById(menuId);
    let timeout;

    // Exibir menu ao passar o rato (hover)
    item.addEventListener('mouseenter', () => {
      clearTimeout(timeout);
      menu.style.display = 'block';
      menu.style.opacity = '1';
    });

    // Esconder menu ao sair do hover com atraso
    item.addEventListener('mouseleave', () => {
      timeout = setTimeout(() => {
        menu.style.opacity = '0';
        setTimeout(() => {
          menu.style.display = 'none';
        }, 200);
      }, 200);
    });
  }
});

// Fechar todos os menus ao clicar fora
document.addEventListener('click', (e) => {
  if (!e.target.closest('.nav-item')) {
    document.querySelectorAll('.dropdown-menu').forEach((menu) => {
      menu.style.display = 'none';
    });
    openMenuId = null;
  }
});
</script>
