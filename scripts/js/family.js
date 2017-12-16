$(document).ready(function(){
    var events = $("#familyEvents");
    var members = $("#familyMembers");
    members.hide();
    events.show();

    $("#events").click(function(){
        members.hide();
        events.show();
    });

    $("#members").click(function(){
        members.show();
        events.hide();
    });
});