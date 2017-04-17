<?php

$mysqli = new mysqli('localhost', 'lihanmingwustl','Lhm2016', 'module5');
if ($mysqli -> connect_errno) {
    printf("Connection Failed: %s\n", $mysqli -> connect_error);
    exit;
}
?>