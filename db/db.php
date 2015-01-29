<?php

$dbHost = "p:localhost";
$dbUser = "user";
$dbPass = "password";
$dbName = "list";

$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
$db->set_charset("utf8");

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

?>