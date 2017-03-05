<?php
session_start();//start session to use session variable

$filename = basename($_FILES['uploadedfile']['name']);//upload the file to the serve
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}//check the username

$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}//check the file
 
$full_path = sprintf("/home/lihanmingwustl/public_html/%s/%s", $username,$_FILES["uploadedfile"]["name"]);

move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path);//copy the temp file to the path
 
?>