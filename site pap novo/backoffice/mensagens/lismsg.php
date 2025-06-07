<?php
    // Selecionar todas as mensagens
    $sql = "SELECT * FROM mensagens";
    $res = $lig->query($sql);
?>
<div class="container">
  <h1 align="center" class="text-center mt-5 mb-3">Listagem de Mensagens</h1> <br><br>      
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Emissor</th>
        <th>Recetor</th>
        <th>Conteúdo</th>
        <th>Data</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
        <?php while ($lin=$res->fetch_array()){ ?>
            <tr>
                <td><?php echo $lin['id']; ?></td>
                <td><?php echo $lin['emissor']; ?></td>
                <td><?php echo $lin['recetor']; ?></td>
                <td><?php echo $lin['conteudo']; ?></td>
                <td><?php echo $lin['data']; ?></td>
                <td><?php echo $lin['email']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
