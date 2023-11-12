<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SING-IN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    
    <script>
        // FORMATAR CPF
        function formatarCPF(cpf) {
            cpf = cpf.replace(/\D/g, ''); // Remove caracteres não numéricos
            cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); // Adiciona pontos e traço
            return cpf;
        }
        // FORMATAR TELEFONES
        function formatarTelefone(telefone) {
            telefone = telefone.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (telefone.length <= 10) {
                telefone = telefone.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3'); // Adiciona DDD e traço
            } else {
                telefone = telefone.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3'); // Adiciona DDD e traço
            }
            return telefone;
        }
            //FORMULAÇÂO DA DATA
        function formatarDataNascimento(input) {
            // Remove caracteres não numéricos/
            var value = input.value.replace(/\D/g, '');

            // Aplica a máscara dd/mm/yyyy
            if (value.length <= 2) {
                input.value = value;
            } else if (value.length <= 4) {
                input.value = value.substr(0, 2) + '/' + value.substr(2);
            } else if (value.length <= 8) {
                input.value = value.substr(0, 2) + '/' + value.substr(2, 2) + '/' + value.substr(4, 4);
            } else {
                // Limita o número de caracteres
                input.value = value.substr(0, 10);
            }
        }

    </script>

</head>
<body>
    <div class="text-center">
        <img src="img/logo.png" alt="logo" style="max-width: 200px;">
    </div>

<?php
//cadastro esfetuado com succeso
if(isset($_SESSION['status_cadastro']) && $_SESSION['status_cadastro']):
?>
<div>
    <p>CADASTRO EFETUDADO!</p>
    <P>FAÇA LOGIN INFORMANDO O SEU USUARIO E SENHA <a href="login.php">aqui</a></P>
</div>
<?php
endif;
unset($_SESSION['status_cadastro']);
?>

<?php
// vaidação de senhas

if (isset($_SESSION['senha_diferente']) && $_SESSION['senha_diferente']):
?>
<div>
    <p>As senhas informadas não coincidem. Por favor, tente novamente.</p>
</div>
<?php
endif;
unset($_SESSION['senha_diferente']);
?>


<?php
// valição do usuario
if(isset($_SESSION['usuario_existe']) && $_SESSION['usuario_existe']):
?>
<div>
    <p>cadastro invalido</p>
</div>
<?php
endif;
unset($_SESSION['usuario_existe']);



?>

    <h1>Realize seu cadastro</h1>
    <form action="cadastrar.php" method="POST" class="mt-4">
    <p>
        <label for="">Nome</label>
        <input name="nome" type="text" placeholder="Seu Nome" maxlength="80" minlength="15">
    </p>
    <p>
        <label for="">Data de Nascimento</label>
        <input name="data" type="text" placeholder="dd/mm/yyyy" pattern="\d{2}/\d{2}/\d{4}" title="Digite uma data no formato: dd/mm/yyyy" maxlength="10" oninput="formatarDataNascimento(this);">
    </p>
   
    <label for="">Sexo</label>
    <select name="sexo">
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
        <option value="Outro">Outro</option>
    </select>
</p>
        <label for="">Nome Materno</label>
        <input name="nomeMae" type="text" placeholder="Seu Nome" maxlength="80" minlength="15">
    </p>
    <p>
        <label for="">CPF</label>
        <input name="cpf" type="text" placeholder="xxx.xxx.xxx-xx" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF no formato: xxx.xxx.xxx-xx" maxlength="14" oninput="this.value = formatarCPF(this.value);">
    </p>
    <p>
        <label for="">Telefone Celular</label>
        <input name="celular" type="text" placeholder="(xx) xxxxx-xxxx" maxlength="15" oninput="this.value = formatarTelefone(this.value);">
    </p>
    <p>
        <label for="">Telefone Fixo</label>
        <input name="fixo" type="text" placeholder="(xx) xxxx-xxxx" maxlength="14" oninput="this.value = formatarTelefone(this.value);">
    </p>
        <label for="">Endereço Completo</label>
        <input name="endereco" type="text" placeholder="Endereço Completo">
    </p>
    <p>
        <label for="">LOGIN</label>
        <input name="login" type="text" placeholder="LOGIN" maxlength="6">
    </p>
    <p>
        <label for="">SENHA</label>
        <input name="senha" type="password" placeholder="SENHA" maxlength="8">
    </p>
    <p>
    <label for="">CONFIRMAR SENHA</label>
    <input name="confirma_senha" type="password" placeholder="CONFIRMAR SENHA" maxlength="8">
</p>
    <button type="submit">ENVIAR</button>
    <button type="button" onclick="window.location.href='login.php'">LOGAR-SE</button>

</form>
</body>
</html>