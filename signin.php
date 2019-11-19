<!-- <?php
        session_start();
        $username = $_POST['username'];
        $pw = $_POST['password'];
        if (isset($_POST['submitin'])) {
            $dbhost = "remotemysql.com";
            $dbuser = "DGynRSEipT";
            $dbpass = "WezFIBGzuR";
            $db = "DGynRSEipT";
            if (!empty($username) and !empty($pw)) {
                $pdo = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
                $connectmbr = $pdo->prepare("SELECT * FROM Student WHERE username = ? AND password = ?");
                $connectmbr->execute(array($username, $pw));
                $userexist = $connectmbr->rowCount();
                if ($userexist == 1) {
                    $userinfo = $connectmbr->fetch();
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['pseudo'] = $userinfo['pseudo'];
                    $_SESSION['mail'] = $userinfo['mail'];
                    header("Location: profil.php?id=" . $_SESSION['id']);
                } else {
                    $error = "Wrong password or username!";
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
    <title>Sign in</title>
</head>

<body>
    <div class="col-4">
        <form method="post" action="signin.php" name="formulaire">
            <div class="form-group">
                <h1>Sign in</h1>
                <label for="usename">Username</label>
                <input type="text" class="form-control" name="username" id="usename" aria-describedby="emailHelp" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" name="submitin" class="btn btn-primary offset-4">Submit</button>
        </form>
        <div class="">
            <?php
            if (isset($error)) {
                echo '<p class="error">' . $error . "</p>";
            } else {
                echo '<p class="succes">' . $good . "</p>";
            }
            ?>
        </div>
    </div>

</body>

</html> -->