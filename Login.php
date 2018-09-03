<?php
    session_start();
    if((!isset($_POST['login'])) || (!isset($_POST['password']))){
        header('Location: index.php');
        exit();
    }
    require_once "Connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0)
    {
      echo "Error: ".$connection->connect_errno;
    }
    else
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM uzytkownicy WHERE user='$login' AND pass='$password'";

        if($result = @$connection->query($sql))
        {
            $howManyUsers = $result->num_rows;
            if($howManyUsers > 0)
            {
                $_SESSION['loggedIn'] = true;
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['user'];
                $_SESSION['drewno'] = $row['drewno'];
                $_SESSION['kamien'] = $row['kamien'];
                $_SESSION['zboze'] = $row['zboze'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['dnipremium'] = $row['dnipremium'];

                unset($_SESSION['loginError']);
                $result->free_result();
                header('Location: Game.php');
            } else
            {
                $_SESSION['loginError'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: index.php');
            }
        }

        $connection->close();
    }

?>