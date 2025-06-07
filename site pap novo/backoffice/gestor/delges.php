<?php
// Conexão com a base de dados
include 'ligamysql.php';

// Verifique se o id está definido
if (isset($_REQUEST['id'])) {
    $id = intval($_REQUEST['id']); // Converte o id para inteiro

    // Verifique se o gestor é o administrador (id 1)
    if ($id == 1) {
        echo "Não é possível apagar o gestor administrador.";
        exit; // Para evitar continuar a execução
    }

    // Eliminar o gestor
    $sql = "DELETE FROM gestor WHERE id = $id";
    if ($lig->query($sql)) {
        echo "Gestor eliminado com sucesso.";
        echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisgest'>"; // Redireciona para a listagem de gestores
    } else {
        // Exibe erro se a eliminação falhar
        echo "Erro ao eliminar gestor<br>";
        echo "Número erro: " . $lig->errno . "<br>";
        echo "Descrição erro: " . $lig->error;
    }
} else {
    echo "Opção inválida: id não especificado."; // Mensagem de erro se o id não estiver presente
}
?>
