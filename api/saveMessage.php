<?php
session_start();

require_once '../model/Database.php';


$message = $_POST["message"];
if($message === ""){
    return 0;
}
else{
    date_default_timezone_set('America/Toronto');
    $date = new DateTime();
    try{
        $conn = Database::getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $saveMessage = "insert into chatmessages(chatid, userid, user, message, timestamp) values(:chatid, :userid, :name, :message, :timestamp)";
        $stmt = $conn->prepare($saveMessage);
        $stmt->bindValue(":chatid", $_SESSION["chatID"]);
        $stmt->bindValue(":userid", $_SESSION["userID"]);
        $stmt->bindValue(":name", $_SESSION["userName"]);
        $stmt->bindValue(":message",$message);
        $stmt->bindValue(":timestamp", $date->format("Y-m-d H:i"));
        $rowsUpdate = $stmt->execute();
        if($rowsUpdate>0){
            echo true;
        }
    }
    catch (PDOException $ex){
        $ex->getMessage();
        exit();
    }
}

?>