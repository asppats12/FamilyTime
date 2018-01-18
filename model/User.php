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
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            exit();
        }
        return false;
    }

    public function fetchUser($id){
        try{
            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetch = "select * from users where id=:id";
            $stmt = $conn->prepare($fetch);
            $stmt->bindValue(":id",$id, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $tempUser = $stmt->fetch(PDO::FETCH_OBJ);
                $this->id = $tempUser->id;
                $this->firstName = $tempUser->firstname;
                $this->lastName = $tempUser->lastname;
                $this->email = $tempUser->email;
                $this->dateOfBirth = $tempUser->dateofbirth;
                $this->profilePicUrl = $tempUser->profilepicurl;
                return true;
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            exit();
        }
        return false;
    }

    public function insertUser(){
        try {

            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $insert="INSERT INTO users(email,password,firstname,lastname,dateofbirth,profilepicurl) VALUES(:email,:password,:fname,:lname,:date,:profilepicurl)";

            $stmt = $conn->prepare($insert);
            $stmt->bindValue(':fname',$this->firstName,PDO::PARAM_STR);
            $stmt->bindValue(':lname',$this->lastName,PDO::PARAM_STR);
            $stmt->bindValue(':date',$this->dateOfBirth,PDO::PARAM_STR);
            $stmt->bindValue(':email',$this->email,PDO::PARAM_STR);
            $stmt->bindValue(':password',$this->password,PDO::PARAM_STR);
            $stmt->bindValue(':profilepicurl',$this->profilePicUrl,PDO::PARAM_STR);
            $rowsUpdated = $stmt->execute();

            if ($rowsUpdated > 0) {
                return true;
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
        return false;
    }

    public function updateUser(){
        try {

            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $update="update users set email=:email, firstname=:fname, lastname=:lname, dateofbirth=:date where id=:userid";

            $stmt = $conn->prepare($update);
            $stmt->bindValue(':userid', $_SESSION["userID"], PDO::PARAM_INT);
            $stmt->bindValue(':fname',$this->firstName,PDO::PARAM_STR);
            $stmt->bindValue(':lname',$this->lastName,PDO::PARAM_STR);
            $stmt->bindValue(':date',$this->dateOfBirth,PDO::PARAM_STR);
            $stmt->bindValue(':email',$this->email,PDO::PARAM_STR);
            $rowsUpdated = $stmt->execute();

            if ($rowsUpdated > 0) {
                return true;
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
        return false;
    }

    public function insertPhoto(){
        $target_dir = "../uploads/photos/";
        $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }


        // Check file size
        if ($_FILES["fileUpload"]["size"] > 1500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                $this->setProfilePicUrl($target_file);
                return true;
            }
        }
        return false;
    }

    public function changePassword($newPassword){
        try {

            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $update="update users set password=:password where id=:userid";

            $stmt = $conn->prepare($update);
            $stmt->bindValue(':userid', $_SESSION["userID"], PDO::PARAM_INT);
            $stmt->bindValue(':password', $newPassword, PDO::PARAM_STR);
            $rowsUpdated = $stmt->execute();

            if ($rowsUpdated > 0) {
                return true;
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
        return false;
    }

    public function fetchPassword(){
        try {

            $conn = Database::getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $update="select password from users where id=:userid";

            $stmt = $conn->prepare($update);
            $stmt->bindValue(':userid', $_SESSION["userID"], PDO::PARAM_INT);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_OBJ)->password;
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
        return false;
    }

}