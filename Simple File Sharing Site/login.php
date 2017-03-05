<!DOCTYPE HTML>
    
<html>
<head><title>File Sharing System</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--The Style of the login page-->
<style>
.center {
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    text-align: center;
    font-size: 18px;
}
    .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    float: left
}
p {
    font-size: 50px;
}
p.normal {
    font-style: normal;
}

p.italic {
    font-style: italic;
}

p.oblique {
    font-style: oblique;
}
h2 {
    position: absolute;
    left: 210px;
    top: 190px;
}
h3 {
    position: absolute;
    left: 480px;
    top: 180px;
}
</style>


</head>
<body>
    
  
<i class="fa fa-cloud" style="font-size:36px;"></i>
<i class="fa fa-cloud" style="font-size:36px;"></i>
<i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i>
<p class="italic">Welcome to our file sharing system</p >



<br><br><br><br><br><br>

<!--Type the username to login-->
<form name="input" action="login.php" method="GET">
<h2>User Name:<input type="text" name="username"><br></h2>
<h3><input type="submit" value="login" class="button"><br></h3>

<br><br><br>
<i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i><i class="fa fa-cloud" style="font-size:36px;"></i>

<br>
</form>

<!--The php function of login with a username-->
<?php
if(isset($_GET['username'])){
session_start();

$h = fopen("/home/lihanmingwustl/public_html/users.txt", "r");
$username = $_GET['username'];
$_SESSION['username'] = $username;
while(!feof($h)){
        if($username == trim(fgets($h))){
                header("LOCATION: filelist.php");

                exit;
        }
}
echo "Invalid Username";
fclose($h);
}
?>
</body>
</html>