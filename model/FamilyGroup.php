<?php
/**
 * Created by PhpStorm.
 * User: Akshay
 * Date: 2017-12-06
 * Time: 7:19 PM
 */

class FamilyGroup
{
    private $id;
    private $name;
    private $adminID;
    private static $group;
    private $members = array();

    /**
     * @return mixed
     */
    public function getAdminID()
    {
        return $this->adminID;
    }

    /**
     * @return array
     */
    public function getMembers(): array
    {
        return $this->members;
    }

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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    private function __construct()
    {
    }

    public static function getGroup(){
        if(self::$group == null){
            self::$group = new FamilyGroup();
            return self::$group;
        }
        return self::$group;
    }


    public function findUserGroup(){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetchGroup = "select * from usergroupbridge where userid=:userid";
            $stmt = $conn->prepare($fetchGroup);
            $stmt->bindValue(":userid", $_SESSION["userID"], PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $tempGroup = $stmt->fetch(PDO::FETCH_OBJ);
                $this->id = $tempGroup->groupid;
                return true;
            }
        }
        catch(PDOException $ex){
            $ex->getMessage();
            exit();
        }
        return false;
    }

    public function fetchGroup(){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetchGroup = "select * from familygroup where id=:groupid";
            $stmt = $conn->prepare($fetchGroup);
            $stmt->bindValue(":groupid", $_SESSION["groupID"], PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $tempGroup = $stmt->fetch(PDO::FETCH_OBJ);
                $this->id = $tempGroup->id;
                $this->name = $tempGroup->name;
                $this->adminID = $tempGroup->admin;
                return true;
            }
        }
        catch(PDOException $ex){
            $ex->getMessage();
            exit();
        }
        return false;
    }

    public function fetchMembers(){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetchGroup = "select userid from usergroupbridge where groupid=:groupID";
            $stmt = $conn->prepare($fetchGroup);
            $stmt->bindValue(":groupID", $_SESSION["groupID"], PDO::PARAM_INT);
            $rowsUpdated = $stmt->execute();
            if($rowsUpdated > 0){
                $memberIDs = $stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($memberIDs as $id){
                    $fetchMember = "select * from users where id=:id";
                    $stmt = $conn->prepare($fetchMember);
                    $stmt->bindValue(":id", $id->userid, PDO::PARAM_INT);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                        array_push($this->members, $stmt->fetch(PDO::FETCH_OBJ));
                    }
                    $stmt->closeCursor();
                }
                return true;
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            exit();
        }
        return false;
    }

    public function createGroup($groupName, $adminID){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $createGroup = "insert into familygroup(name, admin) values(:groupname, :adminID)";
            $stmt = $conn->prepare($createGroup);
            $stmt->bindValue(":groupname",$groupName, PDO::PARAM_STR);
            $stmt->bindValue(":adminID", $adminID, PDO::PARAM_INT);
            $rowsUpdated = $stmt->execute();
            if($rowsUpdated > 0){
                $fetchGroupID = "select * from familygroup where admin = :adminID";
                $stmt = $conn->prepare($fetchGroupID);
                $stmt->bindValue(":adminID", $adminID);
                $stmt->execute();
                if($stmt->rowCount()>0){
                    $tempGroup = $stmt->fetch(PDO::FETCH_OBJ);
                    $this->id = $tempGroup->id;
                    $this->name = $tempGroup->name;
                    return true;
                }
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            exit();
        }
        return false;
    }

    public function addToGroup($userID){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $createGroup = "insert into usergroupbridge(userid, groupid, chatid) values(:userid, :groupid, :chatid)";
            $stmt = $conn->prepare($createGroup);
            $stmt->bindValue(":userid",$userID, PDO::PARAM_INT);
            $stmt->bindValue(":groupid", $_SESSION["groupID"], PDO::PARAM_INT);
            $stmt->bindValue(":chatid", $_SESSION["chatID"],PDO::PARAM_INT);
            $rowsUpdated = $stmt->execute();
            if($rowsUpdated > 0){
                return true;
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            exit();
        }
        return false;
    }
}