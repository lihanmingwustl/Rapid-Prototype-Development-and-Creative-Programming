    function deleteEvent(topic) {
	var dataString = "topic="+encodeURIComponent(topic);
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "deleteEvent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.addEventListener("load", function(event){
	var jsonData = JSON.parse(event.target.responseText);
	if(jsonData.success){
		alert("Your event has been deleted!");
		updateCalTable(currentMonth);
	}else{
		alert("Deleting event failed.  ");
	}
	}, false);
	//xmlHttp.addEventListener("load", deleteEventCallback, false);
	xmlHttp.send(dataString);
}

//function deleteEventCallback(event) {
//		var jsonData = JSON.parse(event.target.responseText);
//		// check event handler status
//		if(jsonData.success){
//			alert("Your event has been deleted!");
//			updateCalTable(currentMonth);
//		}else{
//			alert("Deleting event failed.  ");
//		}
//	
//}


	// delete event
	$(document).ready(function(){
	$("#delete_event_btn").click(function(event){
		var topic = document.getElementById("delete_event_topic").value;
		deleteEvent(topic);
	});});
    
    
     