<?php
include('protectMaster.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Usuários</title>

    <style>
        /* Adicione estilos de borda azul à tabela */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #3498db;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #3498db;
            color: #ffffff;
        }

        /* Estilo para o botão de editar */
        .btn-editar {
            background-color: #3498db;
            color: #ffffff;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block; /* Adicionado para manter os links em linha */
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <img src="img/logo.png" alt="logo" style="max-width: 150px;">

    <h1>Consulta de Usuários</h1>
    <form id="consultaForm">
        <?php
        include('conexao.php');
        $camposExcluidos = array('endereco_completo', 'senha', 'data_cadastro');
        $sql = "DESC usuario";
        $result = $conexao->query($sql);

        while ($row = $result->fetch_assoc()) {
            // Verifica se o campo atual está na lista de campos excluídos
            if (!in_array($row['Field'], $camposExcluidos)) {
                echo '<label for="' . $row['Field'] . '">' . ucfirst($row['Field']) . ':</label>';
                
                if ($row['Field'] == 'sexo') {
                    // Adiciona campo de seleção para sexo
                    echo '<select id="' . $row['Field'] . '" name="' . $row['Field'] . '">
                            <option value="">Selecione o Sexo</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                          </select>';
                } else {
                    // Adiciona campo de texto padrão
                    echo '<input type="text" id="' . $row['Field'] . '" name="' . $row['Field'] . '">';
                }
                
                echo '<br>'; // Adiciona uma quebra de linha após cada campo
            }
        } 
        ?>
    </form>

    <?php
    // Obtém os dados dos usuários do banco de dados
    $query = "SELECT * FROM usuario";
    $result = mysqli_query($conexao, $query);

    if ($result) {
        echo '<table>';
        echo '<tr>';
        // Adiciona os cabeçalhos das colunas
        while ($row = mysqli_fetch_field($result)) {
            echo '<th>' . ucfirst($row->name) . '</th>';
        }
        echo '<th>Editar</th>'; // Adiciona uma coluna extra para o link de edição
        echo '</tr>';
        
        // Adiciona os dados dos usuários na tabela
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            // Adiciona o link de edição com o ID do usuário como parâmetro
            echo '<td><a class="btn-editar" href="edit.php?id=' . $row['id_usuario'] . '">Editar</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Erro ao buscar usuários.";
    }
    ?>
    
    <p>
        <a href="logout.php">Finalizar Sessão</a>
    </p>

    <script src="consulta.js"></script>
</body>
</html>
