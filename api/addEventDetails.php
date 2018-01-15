<?php
session_start();

require_once '../model/Database.php';

try{
    $conn = Database::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $addEvent = "insert into events(start, end, title) values(:start,:end,:title)";
    $stmt = $conn->prepare($addEvent);

    $sTime = $_POST["startDate"]." ".$_POST["startTime"];
    $datetime = DateTime::createFromFormat('d-m-Y h:i A', $sTime);
    $start = $datetime->format("Y-m-d H:i:s");

    $eTime = $_POST["endDate"]." ".$_POST["endTime"];
    $datetime = DateTime::createFromFormat('d-m-Y h:i A', $eTime);
    $end = $datetime->format("Y-m-d H:i:s");


    $stmt->bindValue(":start", $start);
    $stmt->bindValue(":end", $end);
    $stmt->bindValue(":title", $_POST["eventname"]);

    if($stmt->execute() > 0){
        $eventId = $conn->lastInsertId();
        $addLocation = "insert into location(place_id, name, lat, lng, formattedaddress) values(:id, :placename, :lat, :lng, :address)";
        $stmt =  $conn->prepare($addLocation);
        $stmt->bindValue(":id", $_POST["placeId"]);
        $stmt->bindValue(":placename", $_POST["placeName"]);
        $stmt->bindValue(":lat", $_POST["lat"]);
        $stmt->bindValue(":lng", $_POST["lng"]);
        $stmt->bindValue(":address", $_POST["address"]);
        $stmt->execute();
        $locationId = $conn->lastInsertId();
        $stmt->closeCursor();
        if(updateBridge($eventId, $locationId)){
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
