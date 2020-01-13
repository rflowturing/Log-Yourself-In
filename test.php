<?php


// function openConnection()
// {
// Try to figure out what these should be for you
$dbhost = "remotemysql.com";
$dbuser = "GDwG96muIP";
$dbpass = "27HXEaCr65";
$db = "GDwG96muIP";

try {
    // Try to understand what happens here
    $username = "onvayarriver";
    $mail = "djdujd@dfd.com";
    $pw = "1234";
    $pdo = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
    $insertmbr = $pdo->prepare("INSERT INTO Student (username, email, password) VALUES( ?,?,?)");
    $insertmbr->execute(array($username, $mail, $pw));
    echo "ok";
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
// Why we do this here
// return $pdo;
// }
