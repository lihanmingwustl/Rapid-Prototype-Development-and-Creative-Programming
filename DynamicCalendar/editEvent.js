function editEvent(topic, eventd,date, time) {
	// date to pass into display event ajax script 
	var dataString = "topic="+encodeURIComponent(topic)+"&event="+encodeURIComponent(eventd)+"&date="+encodeURIComponent(date)+"&time="+encodeURIComponent(time);
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "editEvent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.addEventListener("load", editCallBack, false);
	xmlHttp.send(dataString);
}

    
    

function editCallBack(event) {
		var data = JSON.parse(event.target.responseText);
		if(data.success){
			alert("Successfully edited!");
			updateCalTable(currentMonth);
		}else{
			alert("Edit failed.  "+data.message);
		}
	
}


    $(document).ready(function(){
	$("#edit_event_btn").click(function(event){
	    var topic = document.getElementById("edit_event_topic").value;
        var eventd = document.getElementById("edit_event_event").value;
		var date = document.getElementById("edit_event_date").value;
		var time = document.getElementById("edit_event_time").value;
		editEvent(topic,eventd, date, time);
	});});
    