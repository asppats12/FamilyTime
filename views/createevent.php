<?php
/**
 * Created by PhpStorm.
 * User: Akshay
 * Date: 2017-12-16
 * Time: 4:55 PM
 */
?>
<!doctype html>
<html lang="en">
<head>
    <title>Family Time</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<?php include_once 'header.php';?>
<main id="container" style="height: 80vh;">
    <h3 id="eventFormLabel">Create an Event</h3>
    <form id="eventForm" method="post" action="" onsubmit="validateEventData()">
        <div class="form-group">
            <label class="col-md-12 control-label" for="eventname">Event Name</label>
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <input  id="eventname" name="eventname" placeholder="Event Name" class="form-control"  type="text">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-12 control-label" for="startdate">Start Date</label>
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <input  id="startdate" name="startdate" class="form-control"  type="date">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-12 control-label" for="enddate">End Date</label>
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <input  id="enddate" name="enddate" class="form-control"  type="date">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-12 control-label" for="starttime">Start Time</label>
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <input  id="starttime" name="starttime" class="form-control"  type="time">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-12 control-label" for="endtime">End Time</label>
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <input  id="endtime" name="endtime" class="form-control"  type="time">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-12 control-label" for="eventdetails">Details</label>
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <textarea  id="eventdetails" name="eventdetails" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12 control-label"></label>
            <div class="col-md-12">
                <button name='submit' type="submit" class="default-btn" >Create Event<span class="glyphicon glyphicon-send"></span></button>
            </div>
        </div>
    </form>
    <input id = "pac-input" class="controls" type="text" name="placeSearch" placeholder="Start typing here">

    <div id="map">

    </div>
</main>
<?php include_once 'footer.php';?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="../scripts/js/createevent.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYXPdzuOeRrXxR8qbC_bIPU-VnH7r7P5w&libraries=places&callback=initialize"></script>
</body>
</html>
