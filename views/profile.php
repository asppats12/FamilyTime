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
</head>
<body>
<?php include 'header.php'; ?>

<div class = "container">
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <fieldset>
            <legend>Profile</legend>

            <div class="form-group">
                <label class="col-md-4 control label">Profile Picture</label>
                <div class="col-md-4 inputGroupContainer">
                    <img src="<?php echo $user->getProfilePicUrl();?>" alt="Profile Picture" height="250" width="250">
                </div>

            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">First Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <label id="lblFName"><?php echo $user->getFirstName();?></label>
                        <input  name="fname" placeholder="First Name" class="form-control"  type="text" value="">
                        <button id="btnFName">Edit</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" >Last Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <label id="lblLName"><?php echo $user->getLastName();?></label>
                        <input name="lname" placeholder="Last Name" class="form-control"  type="text" value="">
                        <button id="btnLName">Edit</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Date of Birth</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <label id="lblDateOfBirth"><?php echo $user->getDateOfBirth();?></label>
                        <input type="date" name="dateOfBirth" class="form-control" placeholder="Date of Birth" id="exampleInputDOB1" value="<?php echo date('Y-m-d',strtotime($user->getDateOfBirth())); ?>" >
                        <button id="btnDateOfBirth">Edit</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <label id="lblEmail"><?php echo $user->getEmail();?></label>
                        <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" value="<?php echo $user->getEmail(); ?>">
                        <button id="btnEmail">Edit</button>
                    </div>
                </div>
            </div>

            <!--<div class="form-group">
                <div class="accountFormToggle display-none" id="passwordForm">
                    <div class="col-md-5">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Password" name="pass" class="form-control"  value='' data-bv-excluded="false" required>
                    </div>

                    <div class="col-md-5 col-md-offset-1">
                        <label for="exampleInputEmail1">Confirm password</label>
                        <input type='password' id="password2" placeholder="Confirm password" name="pass" class="form-control" value='' data-bv-excluded="false" data-match="#password" required>
                    </div>
                </div>
            </div>-->

            <!--<div class="row">Profile Pic
                <div class="col-sm-4 text-center">
                    <div class="kv-avatar">
                        <div class="file-loading">
                            <input id="avatar-1" name="avatar-1" type="file">
                        </div>
                    </div>
                    <div class="kv-avatar-hint"><small>Select file < 1500 KB</small></div>
                </div>
            </div>-->

            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button id = 'submit' name='submit' type="submit" class="btn btn-warning" >Sign Up <span class="glyphicon glyphicon-send"></span></button>
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
</body>
