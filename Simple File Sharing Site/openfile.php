<?php
session_start();
 
$filename = $_SESSION['filename'];
 
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}//check that if the file is exist
 
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}//check that if the file is exist
 
$full_path = sprintf("/home/lihanmingwustl/public_html/%s/%s", $username,$filename);

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);//open and read the file
 
header("Content-Type: ".$mime);//jump to the page to show the file
readfile($full_path);
 
?>