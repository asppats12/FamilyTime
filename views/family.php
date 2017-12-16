<?php
session_start();
if(!isset($_SESSION["userID"])){
    header("Location:login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Family</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/dashboard.css" type="text/css">
    <script src="../scripts/js/dashboard.js"></script>
</head>
<body>
<?php include_once 'header.php';?>
<main>
    <aside id="sideNav">
        <nav>
            <a href="#" id="events">Events</a>
            <a href="#" id="members">Members</a>
        </nav>
    </aside>
    <div id="container">
        <section id="familyEvents">
            <a href="createevent.php">Create an event</a>
        </section>
        <section id="familyMembers">
            <a href="addmember.php">Add a member</a>
        </section>
    </div>
</main>
<?php include_once 'footer.php';?>
<script type="text/javascript" src="../scripts/js/dashboard.js"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<?php function logout()
{
    session_unset();
    session_destroy();
    header('Location:../index.php');
}
?>
</body>
</html>
