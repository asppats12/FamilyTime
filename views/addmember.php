<?php
session_start();
require "../api/users.php";
require "../model/Database.php";

if(!isset($_SESSION["userID"])){
    header("Location:login.php");
    exit();
}

if(isset($_POST["submit"])){
    $users = retrieveUsers();
}


?>
<!doctype html>
<html lang="en">
<head>
    <title>Family Time</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<?php include_once 'header.php';?>
<main>
    <form action="" method="post" id="searchBox">
        <input id="userSearch" type="text" name="userSearch" placeholder="Enter a name">
        <input type="submit" name="submit" value="Find">
    </form>
    <div id="userListContainer">
        <?php if(isset($users)){
            foreach($users as $user){
                if($user->id!=$_SESSION["userID"]){
                ?>
                <div class="listItem">
                    <p><?php echo $user->firstname . " " . $user->lastname; ?></p>
                </div>
            <?php }
        }
        } ?>
    </div>
</main>
<?php include_once 'footer.php';?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
