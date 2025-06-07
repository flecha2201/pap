<?php

// Receber dados do formulário
$nome_completo = $_REQUEST['nome_completo'];
$username = $_REQUEST['username'];
$email = $_REQUEST['email'];
$password = md5 ($_REQUEST['password']);
$data_nasc = $_REQUEST['data_nasc'];
$nmr_tel = $_REQUEST['nmr_tel'];
$morada = $_REQUEST['morada'];
$cod_postal = $_REQUEST['cod_postal'];

// Receber o CodTipoUt a partir do formulário, sem valor padrão
$CodTipoUt = $_REQUEST['cod_tipo_ut']; // O valor é recebido diretamente

// Verifica se o email já existe
$sql_check_email = "SELECT email FROM utilizador WHERE email = '$email'";
$result_check_email = $lig->query($sql_check_email);

if ($result_check_email->num_rows > 0) {
    die("ERRO: O email '$email' já está registado. Tente com outro email.");
}

// Verifica se o número de telefone já existe
$sql_check_tel = "SELECT nmr_tel FROM utilizador WHERE nmr_tel = '$nmr_tel'";
$result_check_tel = $lig->query($sql_check_tel);

if ($result_check_tel->num_rows > 0) {
    die("ERRO: O número de telefone '$nmr_tel' já está registado. Tente com outro número.");
}

// Verifica se a foto foi enviada e não houve erro
if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
    $fo = $_FILES['foto']['tmp_name'];
    $foto = $_FILES['foto']['name'];
    $dest = "../comum/images/ut/" . $foto;

    if (copy($fo, $dest)) {
        // Inserir utilizador com foto
        $sql = "INSERT INTO utilizador (nome_completo, username, email, password, data_nasc, nmr_tel, morada, cod_postal, foto_ut, CodTipoUt)
                VALUES ('$nome_completo', '$username', '$email', '$password', '$data_nasc', '$nmr_tel', '$morada', '$cod_postal', '$dest', '$CodTipoUt')";
        $lig->query($sql) or die("ERRO: Inserção na tabela Utilizadores");
        echo "Utilizador inserido com sucesso";
        echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisut'>";
    } else {
        echo "Erro ao carregar a foto. O utilizador não foi registado.";
        echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisut'>";
    }
} else {
    // Inserir utilizador sem foto
    $sql = "INSERT INTO utilizador (nome_completo, username, email, password, data_nasc, nmr_tel, morada, cod_postal, CodTipoUt)
            VALUES ('$nome_completo', '$username', '$email', '$password', '$data_nasc', '$nmr_tel', '$morada', '$cod_postal', '$CodTipoUt')";
    $lig->query($sql) or die("ERRO: Inserção na tabela Utilizadores");
    echo "Utilizador inserido com sucesso";
    echo "<meta http-equiv='refresh' content='1;URL=index.php?cmd=lisut'>";
}
?>
