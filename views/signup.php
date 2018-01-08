<?php
session_start();
require "../model/Database.php";
require "../model/User.php";


if(isset($_POST['submit'])) {
    $user = User::getUser();
    if($user->insertPhoto()){
        $user->setFirstName($_POST["fname"]);
        $user->setLastName($_POST['lname']);
        $user->setDateOfBirth($_POST['date']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST["password"]);
        if($user->insertUser()){
            $_SESSION["userCreated"] = "Registration Successful";
            header("Location:login.php");
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <fieldset>
            <legend>Contact Us Today!</legend>

            <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>

            <div class="form-group">
                <label class="col-md-4 control-label">First Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="fname" placeholder="First Name" class="form-control"  type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" >Last Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="lname" placeholder="Last Name" class="form-control"  type="text">
                    </div>
                </div>
            </div>

            <div class="well">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="date" class="form-control" id="exampleInputDOB1" placeholder="Date of Birth">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="accountFormToggle display-none" id="passwordForm">
                    <div class="col-md-5">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Password" name="password" class="form-control"  value='' data-bv-excluded="false" required>
                    </div>

                    <div class="col-md-5 col-md-offset-1">
                        <label for="exampleInputEmail1">Confirm password</label>
                        <input type='password' id="password2" placeholder="Confirm password" name="password" class="form-control" value='' data-bv-excluded="false" data-match="#password" required>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-4">
                    <div class="kv-avatar">
                        <div class="file-loading">
                            <label for="fileUpload">Profile Pic</label>
                            <input id="profilePicUpload" name="fileUpload" type="file">
                        </div>
                    </div>
                    <div class="kv-avatar-hint"><small>Select file < 1500 KB</small></div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button name='submit' type="submit" class="genericButton" >Sign Up <span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>

        </fieldset>
    </form>
</div>

</body>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>