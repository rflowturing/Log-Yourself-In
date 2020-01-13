<?php
session_start();
$dbhost = "remotemysql.com";
$dbuser = "GDwG96muIP";
$dbpass = "27HXEaCr65";
$db = "GDwG96muIP";
$pdo = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);


if (isset($_SESSION['id'])) {

    $requser = $pdo->prepare("SELECT * FROM Student WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if (isset($_POST['newpw']) and !empty($_POST['newpw']) and isset($_POST['newpw2']) and !empty($_POST['newpw2'])) {
        $pw1 = sha1($_POST['newpw']);
        $pw2 = sha1($_POST['newpw2']);
        if ($pw1 == $pw2) {
            $insertmdp = $pdo->prepare("UPDATE Student SET password = ? WHERE id = ?");
            $insertmdp->execute(array($pw1, $_SESSION['id']));
            header('Location: profil.php?id=' . $_SESSION['id']);
            if (isset($_POST['newusername']) and !empty($_POST['newusername']) and $_POST['newusername'] != $user['username']) {
                $newusername = htmlspecialchars($_POST['newusername']);
                $insertusername = $pdo->prepare("UPDATE Student SET username = ? WHERE id = ?");
                $insertusername->execute(array($newusername, $_SESSION['id']));
                header('Location: profil.php?id=' . $_SESSION['id']);
            }
            if (isset($_POST['newfirst_name']) and !empty($_POST['newfirst_name']) and $_POST['newfirst_name'] != $user['first_name']) {
                $newfirst_name = htmlspecialchars($_POST['newfirst_name']);
                $insertfirst_name = $pdo->prepare("UPDATE Student SET first_name = ? WHERE id = ?");
                $insertfirst_name->execute(array($newfirst_name, $_SESSION['id']));
                header('Location: profil.php?id=' . $_SESSION['id']);
            }
            if (isset($_POST['newlast_name']) and !empty($_POST['newlast_name']) and $_POST['newlast_name'] != $user['last_name']) {
                $newlast_name = htmlspecialchars($_POST['newlast_name']);
                $insertlast_name = $pdo->prepare("UPDATE Student SET last_name = ? WHERE id = ?");
                $insertlast_name->execute(array($newlast_name, $_SESSION['id']));
                header('Location: profil.php?id=' . $_SESSION['id']);
            }
            if (isset($_POST['newmail']) and !empty($_POST['newmail']) and $_POST['newmail'] != $user['email']) {
                $newmail = htmlspecialchars($_POST['newmail']);
                $insertmail = $pdo->prepare("UPDATE Student SET email = ? WHERE id = ?");
                $insertmail->execute(array($newmail, $_SESSION['id']));
                header('Location: profil.php?id=' . $_SESSION['id']);
            }
            if (isset($_POST['newlinkedin']) and !empty($_POST['newlinkedin']) and $_POST['newlinkedin'] != $user['linkedin']) {
                $newlinkedin = htmlspecialchars($_POST['newlinkedin']);
                $insertlinkedin = $pdo->prepare("UPDATE Student SET linkedin = ? WHERE id = ?");
                $insertlinkedin->execute(array($newlinkedin, $_SESSION['id']));
                header('Location: profil.php?id=' . $_SESSION['id']);
            }
            if (isset($_POST['newgithub']) and !empty($_POST['newgithub']) and $_POST['newgithub'] != $user['github']) {
                $newgithub = htmlspecialchars($_POST['newgithub']);
                $insertgithub = $pdo->prepare("UPDATE Student SET github = ? WHERE id = ?");
                $insertgithub->execute(array($newgithub, $_SESSION['id']));
                header('Location: profil.php?id=' . $_SESSION['id']);
            }
        } else {
            $msg = "Vos deux mdp ne correspondent pas !";
        }
    } else {

        if (isset($_POST['newusername']) and !empty($_POST['newusername']) and $_POST['newusername'] != $user['username']) {
            $newusername = htmlspecialchars($_POST['newusername']);
            $insertusername = $pdo->prepare("UPDATE Student SET username = ? WHERE id = ?");
            $insertusername->execute(array($newusername, $_SESSION['id']));
            header('Location: profil.php?id=' . $_SESSION['id']);
        }
        if (isset($_POST['newfirst_name']) and !empty($_POST['newfirst_name']) and $_POST['newfirst_name'] != $user['first_name']) {
            $newfirst_name = htmlspecialchars($_POST['newfirst_name']);
            $insertfirst_name = $pdo->prepare("UPDATE Student SET first_name = ? WHERE id = ?");
            $insertfirst_name->execute(array($newfirst_name, $_SESSION['id']));
            header('Location: profil.php?id=' . $_SESSION['id']);
        }
        if (isset($_POST['newlast_name']) and !empty($_POST['newlast_name']) and $_POST['newlast_name'] != $user['last_name']) {
            $newlast_name = htmlspecialchars($_POST['newlast_name']);
            $insertlast_name = $pdo->prepare("UPDATE Student SET last_name = ? WHERE id = ?");
            $insertlast_name->execute(array($newlast_name, $_SESSION['id']));
            header('Location: profil.php?id=' . $_SESSION['id']);
        }
        if (isset($_POST['newmail']) and !empty($_POST['newmail']) and $_POST['newmail'] != $user['email']) {
            $newmail = htmlspecialchars($_POST['newmail']);
            $insertmail = $pdo->prepare("UPDATE Student SET email = ? WHERE id = ?");
            $insertmail->execute(array($newmail, $_SESSION['id']));
            header('Location: profil.php?id=' . $_SESSION['id']);
        }
        if (isset($_POST['newlinkedin']) and !empty($_POST['newlinkedin']) and $_POST['newlinkedin'] != $user['linkedin']) {
            $newlinkedin = htmlspecialchars($_POST['newlinkedin']);
            $insertlinkedin = $pdo->prepare("UPDATE Student SET linkedin = ? WHERE id = ?");
            $insertlinkedin->execute(array($newlinkedin, $_SESSION['id']));
            header('Location: profil.php?id=' . $_SESSION['id']);
        }
        if (isset($_POST['newgithub']) and !empty($_POST['newgithub']) and $_POST['newgithub'] != $user['github']) {
            $newgithub = htmlspecialchars($_POST['newgithub']);
            $insertgithub = $pdo->prepare("UPDATE Student SET github = ? WHERE id = ?");
            $insertgithub->execute(array($newgithub, $_SESSION['id']));
            header('Location: profil.php?id=' . $_SESSION['id']);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="profil container">
        <div class="row">
            <div class="col-12">
                <div class="contentprofil offset-2 col-8">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <h1><?php echo $user['username']; ?>'s Profil</h1>
                        <div class="row">
                            <div class="labeldesc col-4">
                                <label>First name :</label>
                                <label>Last name :</label>
                                <label>Username :</label>
                                <label>Mail :</label>
                                <label>Linkedin :</label>
                                <label>Github :</label>
                                <label>Password :</label>
                                <label>Confirmation :</label>

                            </div>
                            <div class="col-6">
                                <input type="text" class="profinfo" name="newfirst_name" placeholder="First name" value="<?php echo $user['first_name']; ?>" />
                                <input type="text" class="profinfo" name="newlast_name" placeholder="Last name" value="<?php echo $user['last_name']; ?>" />
                                <input type="text" class="profinfo" name="newusername" placeholder="Username" value="<?php echo $user['username']; ?>" />
                                <input type="text" class="profinfo" name="newmail" placeholder="Mail" value="<?php echo $user['email']; ?>" />
                                <input type="text" class="profinfo" name="linkedin" placeholder="Linkedin" value="<?php echo $user['linkedin']; ?>">
                                <input type="text" class="profinfo" name="github" placeholder="Github" value="<?php echo $user['github']; ?>">
                                <input type="password" class="profinfo" name="newpw" placeholder="Password" />
                                <input type="password" class="profinfo" name="newpw2" placeholder="Password confirmation" />
                                <div class="">
                                    <?php
                                    if (isset($msg)) {
                                        echo '<p class="error">' . $msg . "</p>";
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="button-update" value="Update !" />

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>


</html>
