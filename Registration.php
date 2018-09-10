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

        if(ctype_alnum($nick)==false){
            $correctValidation = false;
            $_SESSION['error_nick'] = "NIck może składać się tylko z lite i cyfr (bez polskich znaków)";
        }

        // check e-mail validation

        $email = $_POST['email'];
        $saveEmail = filter_var($email,FILTER_SANITIZE_EMAIL);

        if((filter_var($saveEmail,FILTER_VALIDATE_EMAIL)==false) || ($saveEmail != $email))
        {
            $correctValidation = false;
            $_SESSION['error_email'] = "Podaj poprawny adres email";
        }

        // check password validation

        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if((strlen($password1)<8) || (strlen($password1)>20))
        {
            $correctValidation = false;
            $_SESSION['error_password'] = "Hasło musi posiadać od 8 do 20 znaków";
        }

        if($password1 != $password2)
        {
            $correctValidation = false;
            $_SESSION['error_password'] = "Podane hasła nie są identyczne";
        }

        $hashPassword = password_hash($password1, PASSWORD_DEFAULT);

        // checkbox validation

        if(!isset($_POST['rules']))
        {
            $correctValidation = false;
            $_SESSION['error_rules'] = "Potwierdź akceptację regulaminu";
        }

        // recaptcha validation
        $secretKey = "6Le5lG4UAAAAAAAkOHBs-tK4xjIl2vo8tqw6JS3q";
        $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
        $response = json_decode($check);

        if($response->success==false)
        {
            $correctValidation = false;
            $_SESSION['error_captcha'] = "Potwierdź, że nie jesteś botem";
        }

        require_once "Connect.php";

        mysqli_report(MYSQLI_REPORT_STRICT);

        try
        {
            $connect = new mysqli($host, $db_user, $db_password, $db_name);
            if($connect->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                // if email is already reserved

                $result = $connect->query("SELECT id FROM uzytkownicy WHERE email='$email'");
                if(!$result) throw new Exception($connect->error);

                $how_many_nicks = $result->num_rows;
                if($how_many_nicks>0)
                {
                    $correctValidation = false;
                    $_SESSION['error_email'] = "Istnieje juz konto przypisane do tego adresu e-mail";
                }

                // if nick is already reserved

                $result = $connect->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
                if(!$result) throw new Exception($connect->error);

                $how_many_nicks = $result->num_rows;
                if($how_many_nicks>0)
                {
                    $correctValidation = false;
                    $_SESSION['error_nick'] = "Istnieje juz gracz o takim nicku wybierz inny";
                }

                if($correctValidation==true)
                {
                    // All validation is correct, add user to db
                    if($connect->query("INSERT INTO uzytkownicy VALUES (NULL,'$nick','$hashPassword','$email',100,100,100,14)"))
                    {
                        $_SESSION['successfulRegistration'] = true;
                        header('Location: Welcome.php');
                    }
                    else
                    {
                        throw new Exception($connect->error);
                    }
                }

                $connect->close();
            }
        }catch (Exception $e)
        {
            echo '<span style="color:red">Błąd serwera</span>';
            echo '<br /> Informacja developerska: '.$e;
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
    <style>
        .error
        {
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <form method="post">
        Nickname: <br /> <input type="text" name="nick"/><br />
        <?php
            if(isset($_SESSION['error_nick']))
            {
                echo '<div class="error">'.$_SESSION['error_nick'].'</div>';
                unset($_SESSION['error_nick']);
            }
        ?>
        E-mail: <br /> <input type="email" name="email"/><br />
        <?php
        if(isset($_SESSION['error_email']))
        {
            echo '<div class="error">'.$_SESSION['error_email'].'</div>';
            unset($_SESSION['error_email']);
        }
        ?>
        Hasło: <br /> <input type="hasło" name="password1"/><br />
        <?php
        if(isset($_SESSION['error_password']))
        {
            echo '<div class="error">'.$_SESSION['error_password'].'</div>';
            unset($_SESSION['error_password']);
        }
        ?>
        Powtórz hasło: <br /> <input type="hasło" name="password2"/><br />
        <label>
            <input type="checkbox" name="rules"/> Akceptuję regulamin
        </label>
        <?php
        if(isset($_SESSION['error_rules']))
        {
            echo '<div class="error">'.$_SESSION['error_rules'].'</div>';
            unset($_SESSION['error_rules']);
        }
        ?>
        <div class="g-recaptcha" data-sitekey="6Le5lG4UAAAAANx904pBZNhD012Sjw82Ws7m3ASx"></div>
        <?php
        if(isset($_SESSION['error_captcha']))
        {
            echo '<div class="error">'.$_SESSION['error_captcha'].'</div>';
            unset($_SESSION['error_captcha']);
        }
        ?>
        <br />
        <input type="submit" value="Zarejestruj się" />
    </form>
</body>
</html>
