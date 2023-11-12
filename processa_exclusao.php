<?php
include "conexao.php"; // Use o seu arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera o ID do usuário a ser excluído
    $id_usuario = $_POST['id_usuario'];

    // Exclui o usuário do banco de dados
    $query = "DELETE FROM usuario WHERE id_usuario = $id_usuario";

    $result = mysqli_query($conexao, $query);

    if ($result) {
        header("Location: search.php"); // Redireciona após a exclusão
    } else {
        echo "Erro ao excluir usuário.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
