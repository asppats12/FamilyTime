<?php
session_start();

require '../model/Database.php';
require '../model/FamilyGroup.php';
require '../model/ChatGroup.php';
require '../model/Event.php';
require '../model/Location.php';

$famGroup = FamilyGroup::getGroup();
$chatGroup = ChatGroup::getChat();
$event = Event::getEvent();
$location = Location::getLocation();

$events = null;

if(!isset($_SESSION["userID"])){
    header("Location:login.php");
    exit();
}
else{
    $famGroup->fetchGroup();
    $famGroup->fetchMembers();

    try{
        $conn = Database::getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fetch = "select * from eventlocationbridge where groupid=:groupid";
        $stmt = $conn->prepare($fetch);
        $stmt->bindValue(":groupid", $_SESSION["groupID"]);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $events = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    } catch (PDOException $ex){
        echo $ex->getMessage();
    }
}

if(isset($_POST["createGroup"])){
    if($famGroup->createGroup($_POST["groupName"], $_SESSION["userID"])){
        $_SESSION["groupID"] = $famGroup->getId();
        if($chatGroup->createChat()){
            $_SESSION["chatID"] = $chatGroup->getId();
            if($famGroup->addToGroup($_SESSION["userID"])){
                $_SESSION["message"] = "Group successfully created.";
            }
        }
    }
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
    <link rel="stylesheet" href="../styles/family.css" type="text/css">
    <link rel="stylesheet" href="../styles/style.css" type="text/css">

</head>
<body>
<?php include_once 'header.php';?>
<main>
    <?php

    if(!isset($_SESSION["groupID"])){
        include_once "creategroup.php";
    }
    else{
        include_once "familydetails.php";
    }

    ?>
</main>
<?php include_once 'footer.php';?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="../scripts/js/family.js" type="text/javascript"></script>

</body>
</html>
