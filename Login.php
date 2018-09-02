<?php
    session_start();
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
                $row = $result->fetch_assoc();
                $_SESSION['user'] = $row['user'];
                $_SESSION['drewno'] = $row['drewno'];
                $_SESSION['kamien'] = $row['kamien'];
                $_SESSION['zboze'] = $row['zboze'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['dnipremium'] = $row['dnipremium'];

                $result->free_result();
                header('Location: Game.php');
            }else
            {

            }
        }

        $connection->close();
    }

?>