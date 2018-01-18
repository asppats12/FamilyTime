<?php
session_start();

require_once '../model/Database.php';

try{
    $conn = Database::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $fetch = "select userid, user, message, timestamp from  chatmessages where chatid=:chatid";
    $stmt = $conn->prepare($fetch);
    $stmt->bindValue(":chatid", $_SESSION["chatID"]);

    $stmt->execute();
    if($stmt->rowCount()>0){
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($messages);
    }
}
catch(PDOException $ex){
    return $ex->getMessage();
}
?>