<?php
include('protect.php');
include('conexao.php');

function formatarTelefone($telefone)
{
    // Formatar o telefone de acordo com o padrão (99) 99999-9999
    return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
}

if (isset($_POST['submit_verification'])) {
    $nome_materno_verificacao = $conexao->real_escape_string($_POST['nome_materno_verificacao']);
    $telefone_celular_verificacao = $conexao->real_escape_string($_POST['telefone_celular_verificacao']);

    // Remover caracteres não numéricos antes de formatar
    $telefone_celular_verificacao = preg_replace('/\D/', '', $telefone_celular_verificacao);

    // Formatando o telefone
    $telefone_celular_verificacao_formatado = formatarTelefone($telefone_celular_verificacao);

    $sql_code = "SELECT * FROM usuario WHERE id_usuario = " . $_SESSION['id_usuario'] . " AND nome_materno = '$nome_materno_verificacao' AND telefone_celular = '$telefone_celular_verificacao_formatado'";
    $sql_query = $conexao->query($sql_code) or die("Falha na execução do codiço SQL: " . $conexao->error);

    $quantidade = $sql_query->num_rows;

    if ($quantidade == 1) {
        // Verificação bem-sucedida - Redirecionar para index.php
        $_SESSION['verificacao'] = true;
        header("Location: index.php");
        exit();
    } else {
        echo "Verificação de dois fatores falhou. Por favor, verifique suas informações e tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

    <script>
        function formatarTelefoneInput(input) {
            // Remover caracteres não numéricos
            let numero = input.value.replace(/\D/g, '');

            // Formatar o telefone
            if (numero.length >= 2) {
                input.value = '(' + numero.substring(0, 2) + ')';
            }
            if (numero.length > 2) {
                input.value += ' ' + numero.substring(2, 7);
            }
            if (numero.length > 7) {
                input.value += '-' + numero.substring(7, 11);
            }
        }
    </script>
</head>
<body>

    <img src="logo.png" alt="">

    Bem vindo, <?php echo $_SESSION['nome']; ?>

    <form action="" method="POST" class="mt-4">
        <p>
            <label for="">Nome Materno (para verificação)</label>
            <input type="text" name="nome_materno_verificacao">
        </p>
        <p>
            <label for="">Telefone Celular (para verificação)</label>
            <input type="text" name="telefone_celular_verificacao" placeholder="(99) 99999-9999" oninput="formatarTelefoneInput(this)">
        </p>
        <button type="submit" name="submit_verification">Verificar</button>
    </form>

    <p>
        <a href="logout.php">Finalizar Sessão</a>
    </p>
</body>
</html>
