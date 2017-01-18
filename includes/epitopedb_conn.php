<?php
/**
 * Created by PhpStorm.
 * User: chins
 * Date: 5/4/2016
 * Time: 9:08 PM
 */
date_default_timezone_set("Asia/Kuala_Lumpur");

$host="110.4.46.121";
$port=3306;
$socket="";
$user="user_emico";
$password="useremico01";
$dbname="emico";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();
?>