<?php

$username = $_POST['username'];
$mail = $_POST['mail'];
$pw = $_POST['password'];
$passwordval = $_POST['passwordval'];

if (isset($_POST['submit'])) {

    $dbhost = "remotemysql.com";
    $dbuser = "GDwG96muIP";
    $dbpass = "27HXEaCr65";
    $db = "GDwG96muIP";

    if (!empty($username) and !empty($mail) and !empty($pw)) {
        $pdo = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
        $insertmbr = $pdo->prepare("INSERT INTO Student (username, email, password) VALUES( ?,?,?)");
        $insertmbr->execute(array($username, $mail, $pw));

        $good = "You have successfully created a new account!  <a href=\"connexion.php\">Me connecter</a>";
    } else {
        $error = "Missing informations! please fill all the fields.";
    }
}
