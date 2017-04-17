var months = [ "January", "February", "March", "April", "May", "June",
"July", "August", "September", "October", "November", "December" ];
var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var d = new Date();
var rightNow = [d.getDate(), d.getMonth(), d.getFullYear()];
var currentMonth = new Month(rightNow[2], rightNow[1]);
var userIsLogged = false;
var selectedCategory = "all";

(function(){Date.prototype.deltaDays=function(c){
    return new Date(this.getFullYear(),this.getMonth(),this.getDate()+c)};
    Date.prototype.getSunday=function(){return this.deltaDays(-1*this.getDay())}})();
function Week(c){
    this.sunday=c.getSunday();
    this.nextWeek=function(){
        return new Week(this.sunday.deltaDays(7))};
        this.prevWeek=function(){return new Week(this.sunday.deltaDays(-7))};
        this.contains=function(b){return this.sunday.valueOf()===b.getSunday().valueOf()};
        this.getDates=function(){for(var b=[],a=0;7>a;a++)b.push(this.sunday.deltaDays(a));return b}}
function Month(c,b){this.year=c;
this.month=b;
this.nextMonth=function(){
    return new Month(c+Math.floor((b+1)/12),(b+1)%12)};
    this.prevMonth=function(){return new Month(c+Math.floor((b-1)/12),(b+11)%12)};
    this.getDateObject=function(a){return new Date(this.year,this.month,a)};
    this.getWeeks=function(){var a=this.getDateObject(1),b=this.nextMonth().getDateObject(0),c=[],a=new Week(a);
    for(c.push(a);!a.contains(b);)a=a.nextWeek(),c.push(a);return c}};


function showCurrMonth() {
	$(".curr_month").html(months[currentMonth.month] + " " + currentMonth.year);
}

function updateCalTable(month) {
	var weeks = month.getWeeks();
	var table = $("#cal_table")[0];
	// clean up table
	while (table.rows.length > 1) {
		table.deleteRow(1);
	}
	// append each week as a new row to table
	var rowCounter = 1;
	for (var w in weeks) {
		var row = table.insertRow(rowCounter);
		var days = weeks[w].getDates();
		rowCounter += 1;
		// append day to each row
		for (i = 0; i < 7; i ++) { 
			var cell = row.insertCell(i);
			var tempDay = days[i].getDate();
			if (w === 0 && tempDay > 22) {
				cell.innerHTML = "";
			} else if (w > 3 && tempDay < 7) {
				cell.innerHTML = "";
			} else {
				// cell.innerHTML = tempDay;
				cell.appendChild(document.createTextNode(tempDay));
				// display events in calendar table
				if (userIsLogged) {
					var tempDate = currentMonth.year +"-"+ ("0"+(Number(currentMonth.month)+1)).slice(-2) +"-"+ ("0"+tempDay).slice(-2);
					ViewEvent(cell, tempDate, tempDay);
				}
				// add background color to today
				if (rightNow[2] == currentMonth.year && rightNow[1] == currentMonth.month &&rightNow[0] == tempDay) {
					cell.style.background = "rgb(100,100,100)";
				}
	    	}
		}
	}
}

function ViewEvent(cell, date, day) {
	var dataString = "date=" + encodeURIComponent(date);
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "ViewEvent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText);
		if (jsonData.length > 0) {
			for (var tempEvent in jsonData) {
				var jsonevent = jsonData[tempEvent];
				cell.appendChild(document.createTextNode("Event: "+jsonevent.topic+" "));
				cell.appendChild(document.createTextNode(jsonevent.time.split(":").slice(0,2).join(":")+" "));
				cell.appendChild(document.createTextNode(jsonevent.event+" "));
				cell.appendChild(document.createTextNode("Date: "+jsonevent.date));
			}
		}
	}, false);
	xmlHttp.send(dataString);
}

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
			userIsLogged = true;
			updateCalTable(currentMonth);
		}else{
			alert("You were not logged in.  "+jsonData.message);
		}
	}, false);
	xmlHttp.send(dataString);	
}

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
			userIsLogged = true;
			updateCalTable(currentMonth);
		}else{
			alert("You were not registered.  "+jsonData.message);
		}
	}, false);
	xmlHttp.send(dataString);
}

$(document).ready(function(){
	showCurrMonth();
	updateCalTable(currentMonth);
	
	var eventLogin = document.getElementById("login_btn");
	if (eventLogin){
		eventLogin.addEventListener("click", login, false);
	}
	var eventRegister = document.getElementById("register_btn");
	if (eventRegister){
		eventRegister.addEventListener("click", register, false); 
	}
	
	// update to next month
	$("#next_month_btn").click(function(event){
		currentMonth = currentMonth.nextMonth();
		showCurrMonth();
		updateCalTable(currentMonth);
	});
	// update to prev month
	$("#prev_month_btn").click(function(event){
		currentMonth = currentMonth.prevMonth();
		showCurrMonth();
		updateCalTable(currentMonth);
	});
});