var calContainer = document.getElementById("calContainer");


for(var i=1;i<=5;i++){
    for(var j=1;j<=7;j++){
        var calNode = document.createElement("div");
        var dateNode = document.createElement("p");
        var textNode = document.createTextNode();
        dateNode.appendChild(textNode);
        calNode.appendChild(dateNode);
        calContainer.appendChild(calNode);
    }
}

