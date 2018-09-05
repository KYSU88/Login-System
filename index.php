<?php
    session_start();
    if((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn']==true))
    {
        header('Location: Game.php');
        exit();
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
    Gra Online<br /><br />

    <a href="Registration.php">Rejestracja - załóż konto!</a>
    <br /><br />

    <form action="Login.php" method="post">
        Login: <br /> <input type="text" name="login"/> <br />
        Hasło: <br /> <input type="password" name="password"/> <br />
        <input type="submit" value="Zaloguj się"/>
    </form>
    <?php
        if(isset($_SESSION['loginError']))	echo $_SESSION['loginError'];
    ?>
</body>
</html>
