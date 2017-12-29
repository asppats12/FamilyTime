<?php
/**
 * Created by PhpStorm.
 * User: Akshay
 * Date: 2017-12-26
 * Time: 12:28 AM
 */

class ChatGroup
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    public function __construct()
    {
    }

    public function createChat(){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $setChat = "insert into chat(groupid) values(:groupid)";
            $stmt = $conn->prepare($setChat);
            $stmt->bindValue(":groupid", $_SESSION["groupID"]);
            if($stmt->execute()>0){
                $fetchChatID = "select id from chat where groupid = :groupid";
                $stmt = $conn->prepare($fetchChatID);
                $stmt->bindValue(":groupid". $_SESSION["groupID"]);
                $stmt->execute();
                if($stmt->rowCount()>0){
                    $this->id = $stmt->fetch(PDO::FETCH_OBJ)->id;
                    $stmt->closeCursor();
                    return true;
                }
            }
        }
        catch (PDOException $ex){
            $ex->getMessage();
            exit();
        }
        return false;
    }
}