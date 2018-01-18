<div id="chatContainer">
    <div id="header">
        <h5 id="groupName"><?php echo $family->getName();?></h5>
        <button id="minimize">-</button>
    </div>
    <div id="viewMessages">

    </div>
    <div id="sendMessage">
        <input type="text" id="newMessage" name="newMessage" placeholder="Type a message"/>
        <button id="sendBtn" name="send">Send</button>
    </div>
</div>
<link href="../styles/chatbox.css" type="text/css" rel="stylesheet">