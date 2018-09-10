<?php
session_start();
    if((isset($_SESSION['successfulRegistration'])))
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        unset($_SESSION['successfulRegistration']);
    }
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Gra przeglądarkowa</title>
</head>

<body>
    Dziękujemy za rejestrację <br /><br />

    <a href="index.php">Zaloguj się na swoje konto</a>
    <br /><br />
</body>
</html>