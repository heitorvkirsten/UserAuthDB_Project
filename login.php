<?php
include('conexao.php');

if (isset($_POST['login']) && isset($_POST['senha'])) {

    if (empty($_POST['login']) || empty($_POST['senha'])) {
        echo "Preencha seu Login e Senha";
    } else {

        $login = $conexao->real_escape_string($_POST['login']);
        $senha = $conexao->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do codiço SQL: " . $conexao->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];

            if ($_SESSION['id_usuario'] == 1) {
                // Usuário com id_usuario igual a 1 é considerado master
                header("Location: search.php");
                exit();
            } else {
                // Outros usuários - Redirecionar para a página de verificação
                header("Location: verificacao.php");
                exit();
            }
        } else {
            echo "Falha ao logar! Login ou senha incorretos";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

</head>
<body>


    <div class="text-center">
        <img src="img/logo.png" alt="logo" style="max-width: 200px;">
    </div>



    <h1>Acesse a sua conta</h1>
    <form action="" method="POST" class="mt-4">

    <p>
        <label for="">LOGIN</label>
        <input type="text" placeholder="LOGIN" maxlength="6" name="login">
    </p>
    <p>
        <label for="">SENHA</label>
        <input type="password" placeholder="SENHA" maxlength="8" name="senha">
    </p>
    
    <button type="submit">ENVIAR</button>


    <button type="button" onclick="window.location.href='singin.php'">IR PARA CADASTRO</button>



    </form>
</body>
</html>