<?php
include "conexao.php"; // Use o seu arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $id_usuario = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $datanasc = ($_POST['datanasc'] !== '') ? date('Y-m-d', strtotime(str_replace('/', '-', $_POST['datanasc']))) : null;
    $sexo = $_POST['sexo'];
    $nome_materno = $_POST['nomeMae'];
    $cpf = $_POST['cpf'];
    $telefone_celular = $_POST['telefone_celular'];
    $telefone_fixo = $_POST['telefone_fixo'];
    $endereco_completo = $_POST['endereco_completo'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Atualiza os dados no banco de dados
    $query = "UPDATE usuario SET 
        nome = '$nome',
        data_nascimento = '$datanasc',
        sexo = '$sexo',
        nome_materno = '$nome_materno',
        cpf = '$cpf',
        telefone_celular = '$telefone_celular',
        telefone_fixo = '$telefone_fixo',
        endereco_completo = '$endereco_completo',
        login = '$login',
        senha = '$senha'
        WHERE id_usuario = $id_usuario";

    $result = mysqli_query($conexao, $query);

    if ($result) {
        header("Location: search.php"); // Redireciona após a edição
    } else {
        echo "Erro ao editar usuário: " . mysqli_error($conexao);
    }
} else {
    echo "Método de requisição inválido.";
}
?>
