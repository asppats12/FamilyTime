<?php
session_start();
require "../model/Database.php";
require "../model/User.php";


if(isset($_SESSION["userID"])){
    $user = User::getUser();
    $user->fetchUser($_SESSION["userID"]);
}
else{
    header("Location: login.php");
    exit();
}

if(isset($_POST["submit"])){
    $user = User::getUser();
    $user->setEmail($_POST["email"]);
    $user->setDateOfBirth($_POST["dateOfBirth"]);
    $user->setFirstName($_POST["fname"]);
    $user->setLastName($_POST["lname"]);
    if($user->updateUser()){
        $_SESSION["message"] = "Update Successful";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class = "container">
    <span class="message" style="color: seagreen; margin: auto; width: auto;"><?php if(isset($_SESSION["message"])){ echo $_SESSION["message"];}?></span>
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <fieldset>
            <legend>Profile</legend>

            <div class="form-group">
                <label class="col-md-4 control label"><strong>Profile Picture</strong></label>
                <div class="col-md-8 inputGroupContainer">
                    <img src="<?php echo $user->getProfilePicUrl();?>" alt="Profile Picture" height="250" width="250">
                    <input class = "genericButton" id="profilePicUpload" name="fileUpload" type="file" value="Edit">
                    <!--<button class = "genericButton" id="btnProfile">Edit</button>-->
                </div>

            </div>

            <div class="form-group">
                <label class="col-md-4 control-label"><strong>First Name</strong></label>
                <div class="col-md-8 inputGroupContainer">
                    <div class="input-group">
                        <label class="col-md-8 control-label" id="lblFName"><?php echo $user->getFirstName();?></label>
                        <input  name="fname" placeholder="First Name" class="form-control"  type="text" value="<?php echo $user->getFirstName()?>">
                        <button class="genericButton" id="btnFName">Edit</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" ><strong>Last Name</strong></label>
                <div class="col-md-8 inputGroupContainer">
                    <div class="input-group">
                        <label class="col-md-8 control-label" id="lblLName"><?php echo $user->getLastName();?></label>
                        <input name="lname" placeholder="Last Name" class="form-control"  type="text" value="<?php echo $user->getLastName()?>">
                        <button class="genericButton" id="btnLName">Edit</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label"><strong>Date of Birth</strong></label>
                <div class="col-md-8 inputGroupContainer">
                    <div class="input-group">
                        <label class="col-md-8 control-label" id="lblDateOfBirth"><?php echo $user->getDateOfBirth();?></label>
                        <input type="date" name="dateOfBirth" class="form-control" placeholder="Date of Birth" id="exampleInputDOB1" value="<?php echo date('Y-m-d',strtotime($user->getDateOfBirth())); ?>" >
                        <button class="genericButton" id="btnDateOfBirth">Edit</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label"><strong>E-Mail</strong></label>
                <div class="col-md-8 inputGroupContainer">
                    <div class="input-group">
                        <label class="col-md-8 control-label" id="lblEmail"><?php echo $user->getEmail();?></label>
                        <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" value="<?php echo $user->getEmail(); ?>">
                        <button class="genericButton" id="btnEmail">Edit</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <a style="text-decoration: none;" href="changepassword.php">Change Password</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <button id='submit' name='submit' type="submit" class="genericButton" >Save <span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>

        </fieldset>
    </form>
</div>

<?php include 'footer.php'; ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="../scripts/js/profile.js" type="text/javascript"></script>
<?php unset($_SESSION["message"]);?>
</body>
