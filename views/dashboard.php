<?php
session_start();

require '../model/Database.php';
require '../model/User.php';
require '../model/FamilyGroup.php';
require '../model/ChatGroup.php';

$family = null;
$chat = null;


if(!isset($_SESSION["userID"])){
    header("Location: login.php");
}

$family = FamilyGroup::getGroup();
$chat = ChatGroup::getChat();
if($family->findUserGroup()){
    $_SESSION["groupID"] = $family->getId();
    $family->fetchGroup();
    $_SESSION["adminID"] = $family->getAdminID();
}
if($chat->findChatGroup()){
    $_SESSION["chatID"] = $chat->getId();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../styles/dashboard.css" type="text/css"/>
    <link rel="stylesheet" href="../styles/style.css" type="text/css"/>
    <link rel='stylesheet' href="../fullcalendar/fullcalendar.css" />


</head>
<body>
<?php include_once 'header.php';?>
<main>
    <a class="genericButton" style="margin-left: 10%; text-decoration: none;" href="createevent.php">New Event</a>
    <div id="calendar">

    </div>
</main>
<?php
include_once 'chatbox.php';
include_once 'footer.php';
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="../fullcalendar/lib/jquery.min.js"></script>
<script src="../fullcalendar/lib/moment.min.js"></script>
<script src="../fullcalendar/fullcalendar.js"></script>
<script type="text/javascript" src="../scripts/js/dashboard.js"></script>
<script type="text/javascript" src="../scripts/js/chatbox.js"></script>
</body>
</html>
