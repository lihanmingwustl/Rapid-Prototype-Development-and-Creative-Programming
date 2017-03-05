<?php
    session_start();

    session_destroy();//destory the created sessions
    header("LOCATION: login.php");
?>