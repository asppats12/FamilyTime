<?php
session_start();

require_once '../model/Database.php';
require_once '../model/User.php';

$user = null;


if(!isset($_SESSION["userID"])){
    header("Location: login.php");
}

if(isset($_POST["passwordChange"])){
    $user = User::getUser();
    $old = $user->fetchPassword();
    if($_POST["oldPassword"] === $old){
        if($_POST["newPassword"] === $_POST["confirmPassword"]){
            if($user->changePassword($_POST["newPassword"])){
                $_SESSION["message"] = "Password changed.";
                header("Location: profile.php");
                exit();
            }
        }
        else{
            $_SESSION["message"] = "Password Confirmation Failed";
        }
    }
    else {
        $_SESSION["message"] = "Old password does not match";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>Change Password | Family Time</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

</head>

<body>
<?php include 'header.php'; ?>

<div class = "container">
    <span class="message" style="color: crimson; margin: auto; width: auto;"><?php if(isset($_SESSION["message"])){ echo $_SESSION["message"];}?></span>
    <form class="well form-horizontal" action="" method="post"  id="changePasswordForm" enctype="multipart/form-data">
        <fieldset>
            <legend>Change your password</legend>

            <div class="form-group">
                <label class="col-md-4 control-label">Current Password</label>
                <div class="col-md-8 inputGroupContainer">
                    <div class="input-group">
                        <input  name="oldPassword" placeholder="Old Password" class="form-control"  type="password" value="">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" >New Password</label>
                <div class="col-md-8 inputGroupContainer">
                    <div class="input-group">
                        <input name="newPassword" placeholder="New Password" class="form-control"  type="password" value="">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" >New Password</label>
                <div class="col-md-8 inputGroupContainer">
                    <div class="input-group">
                        <input name="confirmPassword" placeholder="Confirm Password" class="form-control"  type="password" value="">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <input id='submit' name='passwordChange' type="submit" class="genericButton" value="Change">
                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php include_once 'footer.php';?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<?php unset($_SESSION["message"]);?>
</body>
</html>