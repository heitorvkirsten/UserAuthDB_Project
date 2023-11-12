<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Edição</title>
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

        // FORMULAÇÃO DA DATA
        function formatarDataNascimento(input) {
            // Remove caracteres não numéricos
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

<?php
include "conexao.php"; // Use o seu arquivo de conexão

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    
    // Seleciona os dados do usuário com base no ID
    $query = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
    $result = mysqli_query($conexao, $query);

    if ($result) {
        $usuario = mysqli_fetch_assoc($result);
?>
    <h1>Formulário de Edição</h1>
    <form action="processa_edicao.php" method="post" class="mt-4">

            <!-- Linha para o ID do usuario -->
        <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

        <!-- Linha para o nome do usuario -->
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" placeholder="Seu Nome" maxlength="80" minlength="15"><br>

       <!-- Linha para a data de nascimento -->
       <label for="datanasc">Data de Nascimento:</label>
        <input type="text" id="datanasc" name="datanasc" value="<?php echo date('d/m/Y', strtotime($usuario['data_nascimento'])); ?>" placeholder="dd/mm/yyyy" pattern="\d{2}/\d{2}/\d{4}" title="Digite uma data no formato: dd/mm/yyyy" maxlength="10" oninput="formatarDataNascimento(this);"><br>

        <!-- Linha para o sexo -->
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo">
            <option value="Masculino" <?php if ($usuario['sexo'] === 'Masculino') echo 'selected'; ?>>Masculino</option>
            <option value="Feminino" <?php if ($usuario['sexo'] === 'Feminino') echo 'selected'; ?>>Feminino</option>
            <option value="Outro" <?php if ($usuario['sexo'] === 'Outro') echo 'selected'; ?>>Outro</option>
        </select><br>

        <!-- Linha para o nome da ma~e do usuario -->
        <label for="nomeMae">Nome Materno:</label>
        <input type="text" id="nomeMae" name="nomeMae" value="<?php echo $usuario['nome_materno']; ?>" placeholder="Nome Materno" maxlength="80" minlength="15"><br>

        <!-- Linha para o cpf do usuario -->        
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo $usuario['cpf']; ?>" placeholder="xxx.xxx.xxx-xx" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF no formato: xxx.xxx.xxx-xx" maxlength="14" oninput="this.value = formatarCPF(this.value);"><br>

        <!-- Linha para o telefone celular-->        
        <label for="telefone_celular">Telefone Celular:</label>
        <input type="text" id="telefone_celular" name="telefone_celular" value="<?php echo $usuario['telefone_celular']; ?>" placeholder="(xx) xxxxx-xxxx" maxlength="15" oninput="this.value = formatarTelefone(this.value);"><br>

        <!-- Linha para o telefone fixo -->        
        <label for="telefone_fixo">Telefone Fixo:</label>
        <input type="text" id="telefone_fixo" name="telefone_fixo" value="<?php echo $usuario['telefone_fixo']; ?>" placeholder="(xx) xxxx-xxxx" maxlength="14" oninput="this.value = formatarTelefone(this.value);"><br>

                <!-- Linha para o endereço-->
        <label for="endereco_completo">Endereço Completo:</label>
        <input type="text" id="endereco_completo" name="endereco_completo" value="<?php echo $usuario['endereco_completo']; ?>" placeholder="Endereço Completo"><br>

        <!-- Linha para o Login-->        
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" value="<?php echo $usuario['login']; ?>" placeholder="LOGIN" maxlength="6"><br>

        <!-- Linha para a senha -->
        <label for="senha">Senha:</label>
        <input type="text" id="senha" name="senha" value="<?php echo $usuario['senha']; ?>" placeholder="SENHA" maxlength="8"><br>

        
        <button type="submit">Salvar</button>

</form>

<!-- Botão de deletar usuario -->
<form action="processa_exclusao.php" method="post">
    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir Usuário</button>
</form>

<?php
    } else {
        echo "Erro ao buscar usuário.";
    }
} else {
    echo "ID de usuário não fornecido.";
}
?>

</body>
</html>
