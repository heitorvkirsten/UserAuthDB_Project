<?php

include('protect.php');





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
</head>
<body>

    <img src="img/logo.png" alt="logo" style="max-width: 150px;">

    Bem vindo, <?php echo $_SESSION['nome']; ?>


    <p>
        <a href="logout.php">Finalizar Sessão</a>
    </p>
</body>
</html>