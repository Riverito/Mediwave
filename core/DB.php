<?php
$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "mediwave";

$GLOBALS["conn"] = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

if (!$GLOBALS["conn"]) {
    die('Error de conexión: ' . mysqli_connect_error());
} else {
    $string = "Conexión exitosa";
}
?>
