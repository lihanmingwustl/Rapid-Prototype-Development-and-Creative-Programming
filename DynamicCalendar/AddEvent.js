function addEvent(topic, context, date, time) {
	var dataString = "topic="+encodeURIComponent(topic)+"&event="+encodeURIComponent(context)+"&date="+encodeURIComponent(date)+"&time="+encodeURIComponent(time);
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "AddEvent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText);
		if(jsonData.success){
			alert("Your event has been added!");
			updateCalTable(currentMonth);
		}else{
			alert("Adding event failed.  "+jsonData.message);
		}
	}, false);
	xmlHttp.send(dataString);
}
$(document).ready(function(){
	$("#add_event_btn").click(function(event){
		var topic = document.getElementById("topic").value;
		var context = document.getElementById("event").value;
		var date = document.getElementById("date").value;
		var time = document.getElementById("time").value;
		addEvent(topic, context, date, time);
	});
});