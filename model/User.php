<?php
/**
 * Created by PhpStorm.
 * User: Akshay
 * Date: 2017-12-06
 * Time: 7:17 PM
 */



class User
{
    private $id;
    private $email;
    private $firstName;
    private $lastName;
    private $password;
    private $dateOfBirth;
    private $profilePicUrl;

    private static $user = null;

    private function __construct()
    {
    }


    public static function getUser(){
        if(self::$user === null){
            self::$user = new User();
        }
        return self::$user;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getProfilePicUrl()
    {
        return $this->profilePicUrl;
    }

    /**
     * @param mixed $profilePicAddress
     */
    public function setProfilePicUrl($profilePicUrl)
    {
        $this->profilePicUrl = $profilePicUrl;
    }

    public function findUser($email, $password){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $find = "select * from users where email = :email and password = :password";
            $stmt = $conn->prepare($find);
            $stmt->bindValue(":email",$email, PDO::PARAM_STR);
            $stmt->bindValue(":password", $password, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $this->id = $stmt->fetch(PDO::FETCH_OBJ)->id;
                return true;
            }
            else{
                return false;
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            exit();
        }
    }

    public function fetchUser($id){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $find = "select * from users where id=:id";
            $stmt = $conn->prepare($find);
            $stmt->bindValue(":id",$id, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $tempUser = $stmt->fetch(PDO::FETCH_OBJ);
                $this->id = $tempUser->id;
                $this->firstName = $tempUser->firstname;
                $this->lastName = $tempUser->lastname;
                $this->email = $tempUser->email;
                $this->dateOfBirth = $tempUser->dateofbirth;
                return true;
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            exit();
        }
    }

    public function insertUser(){

    }

    public function updateUser(){

    }
}