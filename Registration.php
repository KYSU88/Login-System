<?php
    session_start();
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
