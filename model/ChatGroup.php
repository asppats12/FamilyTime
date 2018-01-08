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
    private static $chat;

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


    private function __construct()
    {
    }

    public static function getChat(){
        if(self::$chat == null){
            self::$chat = new ChatGroup();
            return self::$chat;
        }
        return self::$chat;
    }

    public function findChatGroup(){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetchGroup = "select * from usergroupbridge where userid=:userid";
            $stmt = $conn->prepare($fetchGroup);
            $stmt->bindValue(":userid", $_SESSION["userID"], PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $tempChat = $stmt->fetch(PDO::FETCH_OBJ);
                $this->id = $tempChat->chatid;
                return true;
            }
        }
        catch(PDOException $ex){
            $ex->getMessage();
            exit();
        }
        return false;
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
                $stmt->bindValue(":groupid", $_SESSION["groupID"]);
                $stmt->execute();
                if($stmt->rowCount()>0){
                    $tempChat = $stmt->fetch(PDO::FETCH_OBJ);
                    $this->id =$tempChat->id;
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