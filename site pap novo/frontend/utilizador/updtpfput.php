<?php

// Exibir erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar se o utilizador está autenticado
if (!isset($_SESSION['email']) || !isset($_SESSION['username'])) {
    die("Erro: Sessão expirada. Por favor, faça login novamente.");
}

// Obter dados do utilizador
$email = $_SESSION['email'];
$username = $_SESSION['username'];

// Verificar se o ficheiro foi enviado corretamente
if (isset($_FILES['foto_ut']) && $_FILES['foto_ut']['error'] === 0) {
    $originalName = $_FILES['foto_ut']['name']; // Nome original do ficheiro
    $extension = pathinfo($originalName, PATHINFO_EXTENSION); // Obter a extensão do ficheiro
    $path = '../comum/images/ut/'; // Caminho onde o ficheiro será armazenado
    $newFileName = $username . '.' . $extension; // Nome do ficheiro com base no username
    $dest = $path . $newFileName; // Caminho completo do destino
    $orig = $_FILES['foto_ut']['tmp_name']; // Local temporário do ficheiro

    echo "A copiar '$orig' para '$dest'<br>";

    // Tentar copiar o ficheiro para o destino
    if (copy($orig, $dest)) {
        echo "Cópia do ficheiro '$newFileName' efetuada com sucesso.<br>";

        // Atualizar o caminho da foto na base de dados
        $sql = "UPDATE utilizador SET foto_ut='$dest' WHERE email='$email'";
        echo "Query: $sql<br>";

        if ($lig->query($sql)) {
            echo "Atualização efetuada com sucesso.<br>";

            // Atualizar a sessão com o novo caminho da foto
            $_SESSION['foto_ut'] = $dest;

            // Redirecionar para a página de perfil
            echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=perfil>";
        } else {
            die("Erro ao atualizar a base de dados: " . $lig->error);
        }
    } else {
        die("Erro ao copiar o ficheiro para o destino.");
    }
} else {
    $error = $_FILES['foto_ut']['error'] ?? 'desconhecido';
    die("Erro: Nenhuma imagem foi enviada ou ocorreu um problema no upload. Código: $error");
}
?>
