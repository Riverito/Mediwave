<?php
$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "mediwave";


$conn = mysqli_connect($serverName,$dbUserName,$dbPassword,$dbName);

if (!$conn) {
    die('Connection failed:' . mysqli_connect_error());
};


//0 row(s) affected, 1 warning(s): 1681 Integer display width is deprecated and will be removed in a future release.
