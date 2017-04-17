function register(event){
	var username = document.getElementById("rusername").value; 
	var password = document.getElementById("rpassword").value; 
	var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
 
	var xmlHttp = new XMLHttpRequest(); 
	xmlHttp.open("POST", "register.php", true); 
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText);
		if(jsonData.success){
			alert("You've been registered!");
		}else{
			alert("You were not registered.  "+jsonData.message);
		}
	}, false);
	xmlHttp.send(dataString);
}

$(document).ready(function(){
var eventRegister = document.getElementById("register_btn");
if (eventRegister){
	eventRegister.addEventListener("click", register, false); 
}});