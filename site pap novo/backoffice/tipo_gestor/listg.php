<?php
	$sql="select * from tipo_gestor";
	$res=$lig->query($sql);
?>
<?php if($_SESSION['tipo']!='3'){ ?>
<div class="container">
  <h1 align="center" class="text-center mt-5 mb-3">Listagem dos tipos de gestores</h1> <br><br>      
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th></th>
		<th></th>
      </tr>
    </thead>
    <tbody>
        <?php while ($lin=$res->fetch_array()){ ?>
            <tr>
                <td><?php echo$lin['id_tipog']; ?></td>
                <td><?php echo$lin['nome_tipo']; ?></td>
				<td><a href="index.php?cmd=edtg&cod=<?php echo urlencode($lin['id_tipog']); ?>" class="btn btn-warning btn-sm">Alterar</a></td>
                    <td><a href="index.php?cmd=deltg&cod=<?php echo urlencode($lin['id_tipog']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem a certeza que deseja eliminar este utilizador?');">Apagar</a></td>            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
<?php } else { ?>
<div class="container">
  <h1 align="center" class="text-center mt-5 mb-3">Listagem dos tipos de gestores</h1> <br><br>      
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Código</th>
        <th>Nome</th>
      </tr>
    </thead>
    <tbody>
        <?php while ($lin=$res->fetch_array()){ ?>
            <tr>
                <td><?php echo$lin['id_tipog']; ?></td>
                <td><?php echo$lin['nome_tipo']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
<?php } ?>