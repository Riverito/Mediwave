<?php
$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "mediwave";
$string = "hola";

$GLOBALS["conn"] = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);



if (!$GLOBALS["conn"]) {
    die('Error de conexión: ' . mysqli_connect_error());
} else {
    $string = "Conexión exitosa";
}
?>
