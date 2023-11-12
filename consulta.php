<?php
include('conexao.php');

// Aqui você faria sua consulta ao banco de dados
$sql_code = "SELECT * FROM usuario";
$sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

// Obtendo os resultados da consulta
$usuarios = [];
while ($row = $sql_query->fetch_assoc()) {
    $usuarios[] = $row;
}

// Convertendo os resultados para JSON e enviando de volta para o cliente
header('Content-Type: application/json');
echo json_encode($usuarios);
?>
