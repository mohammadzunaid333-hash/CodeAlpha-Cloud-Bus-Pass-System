<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "cloud_bus_pass";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>