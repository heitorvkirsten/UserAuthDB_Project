<?php
session_start();
include('conexao.php');

$nome = isset($_POST['nome']) ? mysqli_real_escape_string($conexao, trim($_POST['nome'])) : "";
$data = isset($_POST['data']) ? date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data']))) : "";
$sexo = isset($_POST['sexo']) ? mysqli_real_escape_string($conexao, $_POST['sexo']) : "";
$cpf = isset($_POST['cpf']) ? mysqli_real_escape_string($conexao, trim($_POST['cpf'])) : "";
$nomeMae = isset($_POST['nomeMae']) ? mysqli_real_escape_string($conexao, trim($_POST['nomeMae'])) : "";
$celular = isset($_POST['celular']) ? mysqli_real_escape_string($conexao, trim($_POST['celular'])) : "";
$fixo = isset($_POST['fixo']) ? mysqli_real_escape_string($conexao, trim($_POST['fixo'])) : "";
$endereco = isset($_POST['endereco']) ? mysqli_real_escape_string($conexao, trim($_POST['endereco'])) : "";
$login = isset($_POST['login']) ? mysqli_real_escape_string($conexao, trim($_POST['login'])) : "";
$senha = isset($_POST['senha']) ? mysqli_real_escape_string($conexao, trim($_POST['senha'])) : "";
$senha_confirmacao = isset($_POST['confirma_senha']) ? mysqli_real_escape_string($conexao, trim($_POST['confirma_senha'])) : "";

// Verifica se as senhas coincidem
if ($senha !== $senha_confirmacao) {
    $_SESSION['senha_diferente'] = true;
    header('location: singin.php');
    exit;
}



$sql = "SELECT COUNT(*) AS total FROM usuario WHERE login = '$login'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['total'] == 1) {
    $_SESSION['usuario_existe'] = true;
    header('location: singin.php');
    exit;
}

$sql = "INSERT INTO usuario (nome, data_nascimento, data_cadastro, sexo, nome_materno, cpf, telefone_celular, telefone_fixo, endereco_completo, login, senha) VALUES ('$nome', '$data', NOW(), '$sexo', '$nomeMae', '$cpf', '$celular', '$fixo', '$endereco', '$login', '$senha')";

if ($conexao->query($sql) === TRUE) {
    $_SESSION['status_cadastro'] = true;
} else {
    $_SESSION['status_cadastro'] = false;
}

$conexao->close();

header('location: singin.php');
exit;

?>