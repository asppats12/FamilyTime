$(document).ready(function(){
    var users;
    var $searchBox = $("#userSearch");
    var $userListContainer = $("#userListContainer");
    $.ajax({
        type: "GET",
        url: '../api/users.php',
        success: function(data){
            users = JSON.parse(data);
        },
        error: function(){}
    });


    $searchBox.keyup(function(){
        $userListContainer.empty();
        var searchString = "";
        if($(this).val() === "" || $(this).val() === null){
            $userListContainer.empty();
        }
        else {
            searchString = $(this).val().toUpperCase();
            $.each(users, function(i, user){
                var referenceString = user.firstname + " " + user.lastname;
                if(referenceString.toUpperCase().indexOf(searchString) > -1){
                    //$userListContainer.append("<div class='user-list-item'><h4>" + user.firstname + " " + user.lastname + "</h4></div>");
                    $userListContainer.append(displayUser(user));
                }
                /*else{
                    $userListContainer.html("No users to display.");
                }*/
            });
        }

    });

    function displayUser(user){
        var container = $("<div></div>");
        container.addClass("user-list-item");
        var userPhoto = $("<div class='user-photo'><img alt='profile-photo' src='" + user.profilepicurl + "'></div>");
        var userDetails = $("<div class='user-details'><h6>" + user.firstname + " " + user.lastname + "</h6><p>" + user.email + "</p></div>");
        var addToGroupBtn = $("<button class='default-btn' id='addToGroupBtn'>Add Member</button>");
        addToGroupBtn.click({id: user.id}, addToGroup);

        container.append(userPhoto);
        userDetails.append(addToGroupBtn);
        container.append(userDetails);
        return container;
    }

    function addToGroup(event){
        $.ajax({
            type: "POST",
            url: '../api/addToGroup.php',
            data: {
                id: event.data.id
            },
            success: function(data){
                if(data){
                    event.target.disabled = true;
                    event.target.value = "Member";
                }
            },
            error: function(){}
        });
    }
});