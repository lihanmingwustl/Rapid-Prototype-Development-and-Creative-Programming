<!DOCTYPE html>

<html>
<head>
        <title>File List</title>
</head>

<!--show the files of the user-->
<body>
        <p>The file list: <br></p>
<form action="filelist.php" method="POST">
</form> 
<?php
session_start();

$username = $_SESSION['username'];
$dir = "/home/lihanmingwustl/public_html/".$username;

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if($file != "." && $file != ".."){    
                echo $file."<br>\n";
            }//read the folder of the user and list the files
        }
    closedir($dh);
    }
}

?>


<!--type in the file's name to view it -->
<form enctype="multipart/form-data" action="view.php" method="POST">
        Choose the file you want to view: <input type="text" name="filename"/><br>
        <input type="submit" name="view" value="View"/><br>
</form>

<!--type in the file's name to download-->
<form enctype="multipart/form-data" action="downloader.php" method="POST">
        Choose the file you want to download: <input type="text" name="filename"/><br>
        <input type="submit" name="download" value="Download"/><br>
</form> 

<!--type in the file's name to delete-->
<form enctype="multipart/form-data" action="delete.php" method="POST">
        Choose the file you want to delete: <input type="text" name="filename"/><br>
        <input type="submit" name="delete" value="Delete"/><br>
</form> 

<!--choose the file to upload-->
<form enctype="multipart/form-data" action="uploader.php" method="POST">
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
		<label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
	</p>
	<p>
		<input type="submit" value="Upload File" />
	</p>
</form>

<!--log out-->
<form enctype="multipart/form-data" action="logout.php" method="POST">
        <input type="submit" name="logout" value="Logout"/><br>
</form> 

</body>
</html>