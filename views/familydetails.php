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
                        <h6><?php echo $event->getTitle();?></h6>
                        <p>From: <?php echo $event->getStart()?></p>
                        <p>To: <?php echo $event->getEnd();?></p>
                    </div>
                    <div class="locationDetailsContainer">
                        <strong><?php echo $location->getName();?></strong>
                        <p><?php echo $location->getAddress();?></p>
                    </div>
                    <div class="eventControlsContainer">
                        <!--<form action="createevent.php" method="post">
                            <input type="hidden" name="editEventId" value="<?php /*echo $event->getId();*/?>">
                            <input class="genericButton" type="submit" name="editEvent" value="Edit">
                        </form>-->
                        <form action="" method="post">
                            <input type="hidden" name="deleteEventId" value="<?php echo $event->getId();?>">
                            <input class="genericButton" type="submit" name="deleteEvent" value="Delete">
                        </form>
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