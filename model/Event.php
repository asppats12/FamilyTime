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
    private $endDate;
    private $startTime;
    private $endTime;

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
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
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
                $this->name = $tempEvent->name;
                $this->details = $tempEvent->details;
                $this->startDate = $tempEvent->startdate;
                $this->endDate = $tempEvent->enddate;
                $this->startTime = $tempEvent->starttime;
                $this->endTime = $tempEvent->endtime;
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