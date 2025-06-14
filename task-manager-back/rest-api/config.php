<?php
$hostname = 'localhost';
$username = "root";
$password = "momo83";
$database = "taskmanager";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("connection failed" . mysqli_connect_error());
}

if ($connection) {
    echo "maladec, connected";
}
