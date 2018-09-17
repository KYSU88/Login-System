<?php
    session_start();
    if(!isset($_SESSION['loggedIn'])){
        header('Location: index.php');
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
<?php
    echo "<p>Witaj ".$_SESSION['user'].'![<a href="LogOut.php">Wyloguj się</a>]</p>';
    echo "<p><b>Drewno</b>: ".$_SESSION['drewno'];
    echo " | <b>Kamień</b>: ".$_SESSION['kamien'];
    echo " | <b>Zboże</b>: ".$_SESSION['zboze']."</p>";
    echo "<p><b>E-mail</b>: ".$_SESSION['email'];
    echo "<br /><b>Data wygaśnięcia premium</b>: ".$_SESSION['dnipremium']."</p>";

    $ServerDateTime = new DateTime();

    echo "Data i czas serwera: ".$ServerDateTime->format('Y-m-d H:i:s')."<br>";

    $endPremiumTime = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);

    $differenceServerPremiumTime = $ServerDateTime->diff($endPremiumTime);
    if($ServerDateTime<$endPremiumTime){
        echo "Pozostało premium: ".$differenceServerPremiumTime->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');
    } else{
        echo "Premium nieaktywne od: ".$differenceServerPremiumTime->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');
    }



?>
</body>
</html>
