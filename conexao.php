<?php 

#$usuario = 'root';
#$senha = '';
#$database = 'db_login';
#$host = 'localhost';

#$conexao = mysqli_connect($host, $usuario, $senha, $database);

#if($conexao ->error) {
# #  die("Falha ao conectar ao banco de dados:" . $conexao ->error);
#}
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'db_login');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');


?>