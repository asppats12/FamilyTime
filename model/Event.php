<?php
/**
 * Created by PhpStorm.
 * User: Akshay
 * Date: 2017-12-06
 * Time: 7:20 PM
 */

class Event
{
    private $id;
    private $title;
    private $start;
    private $end;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    private static $event;

    private function __construct()
    {
    }

    public static function getEvent(){
        if(self::$event==null){
            self::$event = new Event();
        }
        return self::$event;
    }

    public function getEventDetails($eventId){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetchGroup = "select * from events where id=:eventid";
            $stmt = $conn->prepare($fetchGroup);
            $stmt->bindValue(":eventid", $eventId, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $tempEvent = $stmt->fetch(PDO::FETCH_OBJ);
                $this->id = $tempEvent->id;
                $this->title = $tempEvent->title;
                $this->start = $tempEvent->start;
                $this->end = $tempEvent->end;
                return true;
            }
        }
        catch(PDOException $ex){
            $ex->getMessage();
            exit();
        }
        return false;
    }

    public function deleteEvent(){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetchGroup = "delete from events where id=:eventid";
            $stmt = $conn->prepare($fetchGroup);
            $stmt->bindValue(":eventid", $this->id, PDO::PARAM_INT);
            $rowUpdated = $stmt->execute();
            if($rowUpdated>0){
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