<?php
session_start();
require '../model/Database.php';
require '../model/User.php';

$error = "";
$valid = true;
$email = "";
$password = "";

if(isset($_SESSION["userID"])){
    header("Location: dashboard.php");
}
else{
    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $valid=false;
            $error = $error. "Please enter a valid email.";
        }
        else if(strlen($password)<4){
            $valid=false;
            $error = $error. "Password must be atleast 4 characters.";
        }
        else{
            $user = User::getUser();
            $userMatch = $user->findUser($email,$password);
            if($userMatch){
                $_SESSION["userID"] = $user->getId();
                $user->fetchUser($user->getId());
                $_SESSION["userName"] = $user->getFirstName() . " " . $user->getLastName();
                header("Location: dashboard.php");
                exit();
            }
            else{
                $error = "Incorrect Email or Password.";
            }

        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Cabin:700' rel='stylesheet' type='text/css'>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.php">Family Time</a>
        </div>
    </nav>
    <div class="container">

        <form id="loginForm" action="" method="post">
            <div class="form-group">
                <?php if(isset($_SESSION["userCreated"])){ echo $_SESSION["userCreated"];}?>
            </div>
            <div class="form-group">
                <p style="color:red;"><?php if(isset($error)){ echo $error;} ?></p>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="genericButton" id="submit" name="login">Submit</button>
        </form>
    </div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<?php $_SESSION["loginError"] = "";
$_SESSION["userCreated"] = "";?>
</body>
</html>
