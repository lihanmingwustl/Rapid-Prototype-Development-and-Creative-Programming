<?php
        session_start();
        $filename = $_POST['filename'];
        $username = $_SESSION['username'];
        $fullpath = sprintf("/home/lihanmingwustl/public_html/%s/%s", $username,$filename);
        unlink($fullpath);//delete the file
        echo strip_tags("<input type="."radio"." name="."filename"." value=".$filename."/>".$filename."<br>\n"); 
?>