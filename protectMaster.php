<?php


if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id_usuario'])== 1 ) {
    die("Você não pode acessar esta página pois não é ADEMIR. <p><a href=\"login.php\">Logar-se</a>  </p>");
}

?>