<?php

require '../model/Database.php';


try{
    $conn = Database::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $fetch = "select * from users";
    $stmt = $conn->prepare($fetch);
    $stmt->execute();
    if($stmt->rowCount()>0){
        echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
    }
}
catch(PDOException $ex){
    return $ex->getMessage();
}

?>
