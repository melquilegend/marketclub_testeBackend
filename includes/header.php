<?php

if (isset($_GET['loggout'])) {
    Administracao::loggout();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <?php if (@$_GET['url'] == '') { ?>
        <link rel="stylesheet" href="css/index.css">
    <?php } else { ?>
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/form.css">
    <?php } ?>

</head>
<body>
<style>
        #site>header figure {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            background: #EEE url(<?php echo ($_SESSION['img'] == '') ? "images/usuario.png" : INCLUDE_PATH . "uploads/{$_SESSION['img']}"; ?>) no-repeat center center;
            background-size: cover;
            border: 1px solid #EEE;
        }
</style>
