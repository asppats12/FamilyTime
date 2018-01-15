<?php
/**
 * Created by PhpStorm.
 * User: Akshay
 * Date: 2017-12-06
 * Time: 7:32 PM
 */

class Location
{
    private $id;
    private $name;
    private $lat;
    private $lng;
    private $address;

    private static $location;
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

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param mixed $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    private function __construct()
    {
    }

    public static function getLocation(){
        if(self::$location==null){
            self::$location = new Location();
        }
        return self::$location;
    }

    public function getLocationDetails($locationId){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetchGroup = "select * from location where id=:locationid";
            $stmt = $conn->prepare($fetchGroup);
            $stmt->bindValue(":locationid", $locationId, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $tempLocation = $stmt->fetch(PDO::FETCH_OBJ);
                $this->id = $tempLocation->id;
                $this->name = $tempLocation->name;
                $this->lat = $tempLocation->lat;
                $this->lng = $tempLocation->lng;
                $this->address = $tempLocation->formattedaddress;
                return true;
            }
        }
        catch(PDOException $ex){
            $ex->getMessage();
            exit();
        }
        return false;
    }
}