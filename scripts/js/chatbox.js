$(document).ready(function(){
    var $messageBox = $("#newMessage");
    var $sendBtn = $("#sendBtn");

    var $viewMessages = $("#viewMessages");

    var minimize = $("#minimize");

    $messageBox.keydown(function(e) {
        if (e.keyCode == 13) {
            $message = $messageBox.val();
            $messageBox.val("");
            //$viewMessages.append("<div class='messageContainer'><p class='userMessage'>" + $message + "</p></div>");

            $.ajax({
                type: "POST",
                url: '../api/saveMessage.php',
                data: {
                    message: $message
                },
                success: function (data) {
                    if(data){

                    }
                },
                error: function () {

                }
            });
        }
    });


    $sendBtn.click(function(){
        $message = $messageBox.val();
        $messageBox.val("");
        //$viewMessages.append("<div class='messageContainer'><p class='userMessage'>" + $message + "</p></div>");

        $.ajax({
            type: "POST",
            url: '../api/saveMessage.php',
            data: {
                message: $message
            },
            success: function (data) {
                if(data){
                }
            },
            error: function () {

            }
        });
    });

    function loadMessages(){
        $viewMessages.empty();
        $.ajax({
            type: "GET",
            url: '../api/loadMessages.php',
            success: function (messages) {
                $.each(JSON.parse(messages), function (i, message) {
                    $viewMessages.append("<div class='messageContainer'><strong>" + message.user + "</strong><br><p class='userMessage'>" + message.message + "</p></div>");
                });
            },
            error: function () {

            }
        });
    }

    var refreshId = setInterval(loadMessages, 500);
});