<?php
//Login Database connector

$dbServername = "mysql.shsustudents.com"; //this is where the real server name should be
$dbUsername = "hump"; //
$dbPassword = "123456789"; //
$dbDBname = "shsu";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbDBname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
