<?php
session_start();

require_once '../model/Database.php';

try {
    $conn = Database::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sDt = $_POST["startDate"];
    $sT = $_POST["startTime"];

    $eDt = $_POST["endDate"];
    $eT = $_POST["endTime"];

    $eventTitle = $_POST["eventName"];

   /* $start = new DateTime($sDt->format('Y-m-d') .' ' .$sT->format('H:i'));
    $end = new DateTime($eDt->format('Y-m-d'). ' '.$eT->format('H:i'));*/

    $addEvent = "insert into events(start, end, title) values(:start, :end, :title)";
    $stmt = $conn->prepare($addEvent);

    $stmt->bindValue(":start",$sDt . ' ' .$sT);
    $stmt->bindValue(":end",$eDt . ' ' . $eT);
    $stmt->bindValue(":title", $eventTitle);

    if($stmt->execute() > 0) {
        $eventId = $conn->lastInsertId();
        $addLocation = "insert into location(place_id, name, lat, lng, formattedaddress) values(:id, :placename, :lat, :lng, :address)";
        $stmt = $conn->prepare($addLocation);
        $stmt->bindValue(":id", $_POST["placeId"]);
        $stmt->bindValue(":placename", $_POST["placeName"]);
        $stmt->bindValue(":lat", $_POST["lat"]);
        $stmt->bindValue(":lng", $_POST["lng"]);
        $stmt->bindValue(":address", $_POST["address"]);
        $stmt->execute();
        $locationId = $conn->lastInsertId();
        $stmt->closeCursor();
        if (updateBridge($eventId, $locationId)) {
            echo true;
        }
    }
    exit();
}
catch(PDOException $ex){
    echo $ex->getMessage();
    exit();
}


function updateBridge($eventId, $locationId){
    try{
        $conn = Database::getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $addBridge = "insert into eventlocationbridge(eventid, locationid, userid, groupid) values(:eventid, :locationid, :userid, :groupid)";
        $stmt = $conn->prepare($addBridge);
        $stmt->bindValue(":eventid", $eventId);
        $stmt->bindValue(":locationid", $locationId);
        $stmt->bindValue(":userid", $_SESSION["userID"]);
        $stmt->bindValue(":groupid", $_SESSION["groupID"]);
        if($stmt->execute() > 0){
            return true;
        }
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
        exit();
    }
    return false;
}
