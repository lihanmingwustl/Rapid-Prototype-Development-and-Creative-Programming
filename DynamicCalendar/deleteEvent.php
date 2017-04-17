<?php

ini_set("session.cookie_httponly", 1);
// or session_set_cookie_params(0, NULL, NULL, NULL, TRUE);

//require 'database.php';
header("Content-Type: application/json");

session_start();
$username = $_SESSION["username"];
$topic = $_POST['topic'];
$mysqli = new mysqli('localhost', 'lihanmingwustl','Lhm2016', 'module5');
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
// agent consistency  
//$previous_ua = @$_SESSION['useragent'];
//$current_ua = $_SERVER['HTTP_USER_AGENT'];
//if(isset($_SESSION['useragent']) && $previous_ua !== $current_ua){
//  die("Session hijack detected");
//}else{
//  $_SESSION['useragent'] = $current_ua;
//}

//  if (isset($_SESSION['username'])) { 
//		$_SESSION['loggedin'] = true;
//	}
//	else {
//		$_SESSION['loggedin'] = false;
//	}
//    
	//$token = $_POST['token'];
	//if($_SESSION['token'] !== $_POST['token']){
	//die("Request forgery detected");
	//}
	
    
	//if ($_SESSION['loggedin']) {
	//       
        
	
		// pass in variables

	//	// query correct user
	//	$query = "select user from (event left join user on event.user=user.username) where event.topic=?";
	//	$stmt = $mysqli->prepare($query);
	//	if(!$stmt){
	//        echo json_encode(array(
	//            "success" => false,
	//            "message" => "Query failed"
	//            ));
	//        exit;
	//	}
	//	$stmt -> bind_param('s', $event_id);
	//	$stmt -> execute();
	//	$result = $stmt -> get_result();
	//	$row = $result -> fetch_assoc();
	//	$user_name = $row['username'];
	//	$stmt -> close();
	//	// check user credential
	//	if ($user_name != $username) {
	//		echo json_encode(array(
	//            "success" => false,
	//            "message" => "Authorization failed"
	//            ));
	//        exit;
	//	}
		// delete event from database
	//	$query = "delete from event where topic=?";
		$query = "DELETE FROM `event` WHERE topic = ?";
		$stmt = $mysqli->prepare($query);
        
		if(!$stmt){
	        echo json_encode(array(
	            "success" => false,
	            "message" => "Cannot delete event"
	            ));
	        exit;
		}
        
		$stmt -> bind_param('s', $topic);
		$stmt -> execute();
		$stmt -> close();
		// output json array
		echo json_encode(array(
	    	"success" => true,
      //  "message"=>"Delete Event Successful!"
		));
		//exit;
    //}
// }
?>