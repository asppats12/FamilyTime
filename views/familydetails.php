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
        <a class="genericButton" href="addmember.php">Add member</a>
        <section id="memberList"></section>
    </aside>
    <section id="eventsContainer">
        <h3>Upcoming Family Events</h3>
        <hr/>
        <a class="genericButton" href="createevent.php">New Event</a>
        <section id="eventsList"></section>
    </section>
</div>