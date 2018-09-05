<?php
    session_start();

    if(isset($_POST['email']))
    {
        // successful validation
        $correctValidation = true;
        // check nickname
        $nick = $_POST['nick'];
        // verification of the nick length
        if((strlen($nick)<3) || (strlen($nick)>20))
        {
            $correctValidation = false;
            $_SESSION['error_nick'] = "Nick musi posiadać od 3 do 20 znaków";
        }
        if($correctValidation==true)
        {
            // All validation is correct, add user to db
        }
    }

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Gra przeglądarkowa - załóż konto</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <form method="post">
        Nickname: <br /> <input type="text" name="nick"/><br />
        E-mail: <br /> <input type="email" name="email"/><br />
        Hasło: <br /> <input type="hasło" name="password1"/><br />
        Powtórz hasło: <br /> <input type="hasło" name="password2"/><br />
        <label>
            <input type="checkbox" name="rules"/> Akceptuję regulamin
        </label>
        <div class="g-recaptcha" data-sitekey="6Le5lG4UAAAAANx904pBZNhD012Sjw82Ws7m3ASx"></div>
        <br />
        <input type="submit" value="Zarejestruj się" />
    </form>
</body>
</html>
