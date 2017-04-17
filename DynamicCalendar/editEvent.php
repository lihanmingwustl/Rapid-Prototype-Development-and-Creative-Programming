<?php

ini_set("session.cookie_httponly", 1);
// or session_set_cookie_params(0, NULL, NULL, NULL, TRUE);

$mysqli = new mysqli('localhost', 'lihanmingwustl', 'Lhm2016', 'module5');
header("Content-Type: application/json");

session_start();

		$username = $_SESSION["username"];
		$topic = $_POST['topic'];
    $eventd = $_POST['event'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$query = "update event set topic=?, event=?,date=?, time=? where topic=?";
		$stmt = $mysqli->prepare($query);
		if(!$stmt){
		        echo json_encode(array(
		            "success" => false,
		            "message" => "Query failed"
		            ));
		        exit;
		}
		$stmt->bind_param('ssssi', $topic, $eventd, $date, $time, $topic);
		$stmt->execute();
		$stmt->close();
		// output json array
		echo json_encode(array(
	     "success" => true,
        "message"=>"Update Event Successful!"
		));
		
    
// }
?>