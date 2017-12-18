<?php

function retrieveUsers(){
    if(isset($_POST["userSearch"])){
        $user = $_POST["userSearch"];
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetch = "select * from users where firstname like '%' || :user || '%'";
            $stmt = $conn->prepare($fetch);
            $stmt->bindValue(":user",$user, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount()>0){
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }
        catch(PDOException $ex){
            return $ex->getMessage();
        }

    }
    return null;
}

?>
