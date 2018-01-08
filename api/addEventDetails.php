<?php
session_start();

require_once '../model/Database.php';

try{
    $conn = Database::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $addEvent = "insert into events(name, details, startdate, enddate, starttime, endtime) values(:eventname,:details,:startdate,:enddate,:starttime,:endtime)";
    $stmt = $conn->prepare($addEvent);
    $stmt->bindValue(":eventname", $_POST["eventName"]);
    $stmt->bindValue(":details", $_POST["eventDetails"]);
    $stmt->bindValue(":startdate", $_POST["startDate"]);
    $stmt->bindValue(":enddate", $_POST["endDate"]);
    $stmt->bindValue(":starttime", $_POST["startTime"]);
    $stmt->bindValue(":endtime", $_POST["endTime"]);

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
