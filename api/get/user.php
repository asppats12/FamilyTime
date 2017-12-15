<?php
require '../../model/Database.php';

session_start();
$username = "";
$password = "";

if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = findUser($email, $password);
    if(!isset($user)){
        $_SESSION["loginError"]="Incorrect email or password";
        header('Location: ../../views/login.php');
        exit();
    }
    else{
        $_SESSION["user"] = $user;
        header('Location:../../views/dashboard.php');
        exit();
    }
}
else{
    header('Location:../../views/login.php');
    exit();
}


function findUser($email, $password){
    try{
        $conn = Database::getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $find = "select * from users where email = :email and password = :password";
        $stmt = $conn->prepare($find);
        $stmt->bindValue(":email",$email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        else{
            return null;
        }
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
        exit();
    }
}

function fetchUser($id){
    try{
        $conn = Database::getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $find = "select * from users where email = :email and password = :password";
        $stmt = $conn->prepare($find);
        $stmt->bindValue(":email",$email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            return null;
        }
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
        exit();
    }
}
