<?php
session_start();

require '../model/Database.php';

$events = array();

try{
    $conn = Database::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $fetch = "select eventid, locationid from eventlocationbridge where groupid=:groupid";
    $stmt = $conn->prepare($fetch);
    $stmt->bindValue(":groupid", $_SESSION["groupID"]);

    $stmt->execute();
    if($stmt->rowCount()>0){
        $getEvents = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($getEvents as $event){
            $fetch = "select * from events where id=:eventid";
            $stmt = $conn->prepare($fetch);
            $stmt->bindValue(":eventid", $event->eventid);
            $stmt->execute();
            array_push($events, $stmt->fetch(PDO::FETCH_ASSOC));
        }
        echo json_encode($events);
    }


}
catch(PDOException $ex){
    return $ex->getMessage();
}


?>