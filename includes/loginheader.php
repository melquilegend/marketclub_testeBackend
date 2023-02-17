<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/login.css">
</head>

<body>
    <div id="site">
        <figure>
            <img src="images/logo.png" alt="Logo Markt Club">
        </figure>
        <?php

if (isset($_POST['logar'])) {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    #var_dump($cpf,$senha);exit;
    $login_result = Login::login($cpf, $senha);

    if ($login_result === true) {
        header('Location: ' . INCLUDE_PATH);
        exit();
    } else {
        echo $login_result;
    }
}

        ?>