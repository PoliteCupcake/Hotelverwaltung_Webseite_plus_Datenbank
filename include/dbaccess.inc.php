<?php

$serverName ="localhost";
$dbUsername ="root";
$dbPassword ="";
$dbName ="hotel_webpage_db";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}
else
{
    var_dump($conn);
    echo "Sucessfully connected to DB";
}
