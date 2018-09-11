<?php
    session_start();
    if((!isset($_SESSION['successfulRegistration'])))
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        unset($_SESSION['successfulRegistration']);
    }
    // delete remembered session variables from form
    if(isset($_SESSION['registrationForm_nick'])) unset($_SESSION['registrationForm_nick']);
    if(isset($_SESSION['registrationForm_email'])) unset($_SESSION['registrationForm_email']);
    if(isset($_SESSION['registrationForm_password1'])) unset($_SESSION['registrationForm_password1']);
    if(isset($_SESSION['registrationForm_password2'])) unset($_SESSION['registrationForm_password2']);
    if(isset($_SESSION['registrationForm_rules'])) unset($_SESSION['registrationForm_rules']);

    // delete registration error
    if(isset($_SESSION['error_nick'])) unset($_SESSION['error_nick']);
    if(isset($_SESSION['error_email'])) unset($_SESSION['error_email']);
    if(isset($_SESSION['error_password'])) unset($_SESSION['error_password']);
    if(isset($_SESSION['error_rules'])) unset($_SESSION['error_rules']);
    if(isset($_SESSION['error_captcha'])) unset($_SESSION['error_captcha']);
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