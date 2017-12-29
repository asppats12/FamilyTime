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

    public function __construct()
    {
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
                    $this->id = $stmt->fetch(PDO::FETCH_OBJ)->id;
                    $this->name = $stmt->fetch(PDO::FETCH_OBJ)->name;
                    return true;
                }
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            exit();
        }
    }
}