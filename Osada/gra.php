<?php
session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Osadnicy-gra przegladarkowa</title>
</head>

<body>

<?php

    echo"<p>Witaj ".$_SESSION['user'].'![ <a href="logout.php">Wyloguj!</a> ]</p>';
    echo"<p><b>Drewno</b>:".$_SESSION['drewno'];
    echo" | <b>Kamien</b>:".$_SESSION['kamien'];
    echo" | <b>Zboże</b>:".$_SESSION['zboze']."</p>";

    echo"<p><b>E-mail</b>:".$_SESSION['email']."";
    echo"<br><b>Dni premium</b>:".$_SESSION['dnipremium']."</p>";

?>

</body>

</html>
