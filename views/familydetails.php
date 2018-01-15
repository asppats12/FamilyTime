<div id="container">
    <aside id="membersContainer">
        <h3><?php if(isset($_SESSION["groupID"])){echo $famGroup->getName();} else { echo "Family Name";}?></h3>
        <hr/>
        <?php
            if(!empty($famGroup->getMembers())){
                foreach ($famGroup->getMembers() as $member){
                    echo "<div class='memberContainer'><img src='".$member->profilepicurl."' alt='user_photo'>";
                    if($member->id == $_SESSION["userID"]){
                        echo "<h6>You</h6></div>";
                    }
                    else {
                        echo "<h6>" . $member->firstname . " " . $member->lastname . "</h6></div>";
                    }
                }
            }
        ?>
        <?php
            if($_SESSION["adminID"] == $_SESSION["userID"]){?>
                <a class="genericButton" href="addmember.php">Add member</a>
        <?php
            }
        ?>
        <section id="memberList"></section>
    </aside>
    <section id="eventsContainer">
        <h3>Upcoming Family Events</h3>
        <hr/>
        <a class="genericButton" href="createevent.php">New Event</a>
        <section id="eventsList">
            <?php
            if(!empty($events)){
                foreach ($events as $eve){
                    $event->getEventDetails($eve->eventid);
                    $location->getLocationDetails($eve->locationid);

            ?>
                <div class='eventContainer'>
                    <div class="eventDetailsContainer">
                        <h6><?php echo $event->getName();?></h6>
                        <p>Date: <?php echo $event->getStartDate(). " " . $event->getEndDate();?></p>
                        <i>Start Time: <?php echo $event->getStartTime();?></i>
                        <i>End Time: <?php echo $event->getEndTime();?></i>
                    </div>
                    <div class="locationDetailsContainer">
                        <strong><?php echo $location->getName();?></strong>
                        <p><?php echo $location->getAddress();?></p>
                    </div>
                </div>
            <?php
                }
            }
            else { ?>
                <h6>Let's create some events</h6>
            <?php
            }
            ?>
        </section>
    </section>
</div>