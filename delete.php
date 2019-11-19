<?php

session_start();
$dbhost = "remotemysql.com";
$dbuser = "DGynRSEipT";
$dbpass = "WezFIBGzuR";
$db = "DGynRSEipT";

$pdo = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
$getid = $_GET['id'];
$requser = $pdo->prepare("DELETE FROM Student WHERE id = ?");
$requser->execute(array($_SESSION['id']));

header("Location: signup.php");
exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete</title>
</head>

<body>
    <h1>VAS Y PARS PAS HEIN!!!!!!!!!!!</h1>
</body>

</html>