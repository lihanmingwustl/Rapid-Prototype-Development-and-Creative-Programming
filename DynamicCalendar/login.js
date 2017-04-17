function login(event){
	var username = document.getElementById("username").value; 
	var password = document.getElementById("password").value; 
 
	// Make a URL-encoded string for passing POST data:
	var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
 
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "login.php", true); 
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText);
		if(jsonData.success){
			alert("You've been logged in!");
		}else{
			alert("You were not logged in.  "+jsonData.message);
		}
	}, false);
	xmlHttp.send(dataString);	
}

$(document).ready(function(){
var eventLogin = document.getElementById("login_btn");
if (eventLogin){
	eventLogin.addEventListener("click", login, false); 
}});
