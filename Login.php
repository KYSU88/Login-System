<?php

    require_once "Connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0)
    {
      echo "Error: ".$connection->connect_errno." Opis: ".$connection->connect_error;
    }
    else
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        

        $connection->close();
    }

?>