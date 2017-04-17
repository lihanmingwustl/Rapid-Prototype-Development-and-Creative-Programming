function ViewEvent(topic, event, cell, date, day) {
	var dataString = "date=" + encodeURIComponent(date);
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "ViewEvent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText);
		if (jsonData.length > 0) {
			for (var tempEvent in jsonData) {
				var jsonevent = jsonData[tempEvent];
				var eventdiv = document.createElement("div", {"id": "Event: "+jsonevent.topic});
				eventdiv.appendChild(document.createTextNode("Event: "+jsonevent.topic+" "));
				eventdiv.appendChild(document.createTextNode(jsonevent.time.split(":").slice(0,2).join(":")+" "));
				eventdiv.appendChild(document.createTextNode(jsonevent.event+" "));
				eventdiv.appendChild(document.createTextNode("Date: "+jsonevent.date));
			}
		}
	}, false);
	xmlHttp.send(dataString);
}