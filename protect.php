<?php


if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id_usuario'])) {
    die("Você não pode acessar esta página pois não está logado. <p><a href=\"login.php\">Logar-se</a>  </p>");
}

?>