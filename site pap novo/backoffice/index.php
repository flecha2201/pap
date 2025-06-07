<?php
	session_start();
	include "includes/ligamysql.php";
  	if (isset($_REQUEST['cmd']))
		$cmd=$_REQUEST['cmd']; 
	else 
		$cmd='form-login';
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
  <title>ReVibe backoffice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<!--<MENU DE NAVEGAÇÃO-->
	<?php
	if(isset($_SESSION['tipo'])){
		switch($_SESSION['tipo']){
			case '1': require 'includes/menu.php';break;
			case '2': require 'includes/menuges.php';	break;
			case '3': require 'includes/menuut.php';break;
		}
	}
?>
<!--<ÁREA DE TRABALHO-->
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-12 text-left"> 
    <?php		
        switch($cmd) {
			case 'home': require('includes/home.php');  break;
			case 'form-login' : require('includes/form_login.php');	break;
			
			case 'login' : require('login/login.php');	break;
			case 'logout' : require('login/logout.php');	break;
			
			
			// Tipos de Gestor
			case 'addtg' : require('tipo_gestor/addtg.php');   break;
			case 'instg' : require('tipo_gestor/instg.php');   break;
			case 'listg' : require('tipo_gestor/listg.php');   break;
			case 'deltg' : require('tipo_gestor/deltg.php');   break;
			case 'edtg' : require('tipo_gestor/edtg.php'); break;

			// Gestores	
			case 'addgest' : require('gestor/addgest.php');   break;
			case 'insgest' : require('gestor/insgest.php');   break;
			case 'lisgest' : require('gestor/lisgest.php');   break;
			case 'delges' : require('gestor/delges.php');   break;

			// Produtos
			case 'addprod' : require('produtos/addprod.php');   break;
			case 'insprod' : require('produtos/insprod.php');   break;
			case 'lisprod' : require('produtos/lisprod.php'); break;
			case 'delprod' : require('produtos/delprod.php');   break;
			case 'edprod' : require('produtos/edprod.php');   break;
			case 'del_img' : require('produtos/del_img.php');   break;
			case 'updtprod' : require('produtos/updtprod.php');   break;
			// Utilizadores
			case 'addut' : require('utilizador/addut.php');   break;
			case 'insut' : require('utilizador/insut.php');   break;
			case 'lisut' : require('utilizador/lisut.php'); break;
			case 'updtut' : require('utilizador/updtut.php');   break;  
			case 'delut' : require('utilizador/delut.php');   break;
			case 'edut' : require('utilizador/edut.php');   break;

			
			//encomendas
			case 'addencomenda' : require('encomendas/addencomenda.php');   break;
			case 'insencomenda' : require('encomendas/insencomenda.php');   break;
			case 'lisencomenda' : require('encomendas/lisencomenda.php'); break;
			case 'delencomenda' : require('encomendas/delencomenda.php');   break;
			case 'edencomenda' : require('encomendas/edencomenda.php');   break;
			case 'updtencomenda' : require('encomendas/updtencomenda.php');   break;
			// Faturas
			case 'addfat' : require('fatura/addfat.php');   break;
			case 'insfat' : require('fatura/insfat.php');   break;
			case 'lisfat' : require('fatura/lisfat.php'); break;
			case 'delfat' : require('fatura/delfat.php'); break;
			case 'updtfat' : require('fatura/updtfat.php'); break;
			case 'edfat' : require('fatura/edfat.php'); break;
			// Categorias
			case 'addcat' : require('categorias/addcat.php');   break;
			case 'inscat' : require('categorias/inscat.php');   break;
			case 'liscat' : require('categorias/liscat.php'); break;
			case 'delcat' : require('categorias/delcat.php'); break;
			// Categorias de Produtos
			case 'addcatprod' : require('categoria_produtos/addcatprod.php');   break;
			case 'inscatprod' : require('categoria_produtos/inscatprod.php');   break;
			case 'liscatprod' : require('categoria_produtos/liscatprod.php'); break;
			case 'delcatprod' : require('categoria_produtos/delcatprod.php'); break;
			// Favoritos
			case 'addfav' : require('favoritos/addfav.php');   break;
			case 'insfav' : require('favoritos/insfav.php');   break;						
			case 'lisfav' : require('favoritos/lisfav.php'); break;
			case 'delfav' : require('favoritos/delfav.php'); break;

			// Carrinho
		//	case 'addcar' : require('carrinho/addcar.php');   break;
		//	case 'inscar' : require('carrinho/inscar.php');   break;
		//	case 'liscar' : require('carrinho/liscar.php'); break;

			// Item Fatura
			case 'additem' : require('item_fatura/additem.php');   break;
			case 'insitem' : require('item_fatura/insitem.php');   break;
			case 'lisitem' : require('item_fatura/lisitem.php'); break;

			// Mensagens
		//	case 'addmsg' : require('mensagens/addmsg.php');   break;
			//case 'insmsg' : require('mensagens/insmsg.php');   break;
			//case 'lismsg' : require('mensagens/lismsg.php'); break;

			default    : echo "Opção inválida"; break;
		   }
    ?>
</div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p style="text-align: center; padding: 5px; position: relative; bottom: 0; width: 100%; left: 0;">ReVibe</p>
</footer>
</body>
</html>
