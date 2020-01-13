<?php
session_start();
$dbhost = "remotemysql.com";
$dbuser = "GDwG96muIP";
$dbpass = "27HXEaCr65";
$db = "GDwG96muIP";
$pdo = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
$getid = intval($_GET['id']);
$requser = $pdo->prepare('SELECT * FROM Student WHERE id = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();

if (isset($_POST['submit'])) {

    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $username = htmlspecialchars($_POST['username']);
    $mail = htmlspecialchars($_POST['mail']);
    $pw = sha1($_POST['password']);
    $passwordval = sha1($_POST['passwordval']);
    $linkedin = htmlspecialchars($_POST['linkedin']);
    $github = $_POST['github'];

    if (!empty($username) and !empty($mail) and !empty($pw) and !empty($passwordval)) {
        if (preg_match('/^[a-z\d_]{3,20}$/i', $username)) {
            if ($pw == $passwordval) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $requsername = $pdo->prepare("SELECT * FROM Student WHERE username = ?");
                    $requsername->execute(array($username));
                    $usernameexist = $requsername->rowCount();
                    $reqmail = $pdo->prepare("SELECT *FROM Student WHERE email = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if ($mailexist == 0) {
                        if ($usernameexist == 0) {
                            $insertmbr = $pdo->prepare("INSERT INTO Student (first_name,last_name,username, email, password,linkedin , github) VALUES( ?,?,?,?,?,?,?)");
                            $insertmbr->execute(array($first_name, $last_name, $username, $mail, $pw, $linkedin, $github));
                            $good = "You have successfully created a new account! You can now Sign In :-) ";
                        } else {
                            $errorusername = "Username already exists";
                        }
                    } else {
                        $errordoublonmail = "Email already exists";
                    }
                } else {
                    $errormail = "Invalid Mail Adress";
                }
            } else {
                $errorpassword = "Your passwords don't match";
            }
        } else {
            $errorusername = "Invalid Username";
        }
    } else {
        $error = "Missing informations! please fill all the fields.";
    }
}

if (isset($_POST['submitin'])) {

    $usernameconnect = htmlspecialchars($_POST['usernameconnect']);
    $pwconnect = sha1($_POST['pwconnect']);

    if (!empty($usernameconnect) and !empty($pwconnect)) {
        $connectmbr = $pdo->prepare("SELECT * FROM Student WHERE username = ? AND password = ?");
        $connectmbr->execute(array($usernameconnect, $pwconnect));
        $userexist = $connectmbr->rowCount();
        if ($userexist == 1) {
            $userinfo = $connectmbr->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['username'] = $userinfo['usernameconnect'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location: profil.php?id=" . $_SESSION['id']);
        } else {
            $errorpassword2 = "Wrong password or username!";
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
    <title>Sign</title>
</head>

<body>
    <html lang="en">
    <div class="signinup container">
        <div class="col-12">
            <form method="post" action="signup.php" name="formulaire">
                <div class="bitchplease row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="usernameconnect">Username</label>
                            <input type="text" class="form-control" name="usernameconnect" id="usename" aria-describedby="emailHelp" placeholder="Enter username">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="pwconnect" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <?php
                        if (isset($errorpassword2)) {
                            echo '<p class="error">' . $errorpassword2 . "</p>";
                        }
                        ?>
                    </div>
                    <button type="submit" name="submitin" class="asshole btn btn-primary offset-4">Sign in</button>
                </div>
            </form>



        </div>
    </div>
    <div class="signup container">
        <h1>Sign <span class="up">up</span> !</h1>
        <div class="content col-12 ">
            <form method="post" action="signup.php" name="formulaire">
                <div class="row contReg">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name" value="<?php echo $_POST['first_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name" value="<?php echo $_POST['last_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="">
                            <?php
                            $username = htmlspecialchars($_POST['username']);
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="passwordVal">Password validation</label>
                            <input type="password" class="form-control" name="passwordval" id="passwordVal" placeholder="Password">
                        </div>
                        <div class="">
                            <?php
                            if (isset($errorpassword)) {
                                echo '<p class="error">' . $errorpassword . "</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="usename">Username</label>
                            <input type="text" class="form-control" name="username" id="usename" aria-describedby="emailHelp" placeholder="Enter username" value="<?php echo $_POST['username']; ?>">
                        </div>
                        <div class="">
                            <?php
                            if (isset($errorusername)) {
                                echo '<p class="error">' . $errorusername . "</p>";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="mail" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $_POST['mail']; ?>">
                        </div>
                        <div class="">
                            <?php
                            if (isset($errordoublonmail)) {
                                echo '<p class="error">' . $errordoublonmail . "</p>";
                            }
                            ?>
                            <?php
                            if (isset($errormail)) {
                                echo '<p class="error">' . $errormail . "</p>";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="linkedin">Linkedin</label>
                            <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Enter your linkedin" value="<?php echo $_POST['linkedin']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="github">Github</label>
                            <input type="text" class="form-control" name="github" id="github" placeholder="Enter your github" value="<?php echo $_POST['github']; ?>">
                        </div>
                    </div>
                </div>
                <div class="but">
                    <button align="center" type="submit" name="submit" class="btn btn-primary btnreg">Register</button>
                </div>
                <div class="missing-info">
                    <?php
                    if (isset($error)) {
                        echo '<p class="error">' . $error . "</p>";
                    }
                    if (isset($good)) {
                        echo '<p class="good">' . $good . "</p>";
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
