<?php
define("SITE_ROOT", "//".$_SERVER['SERVER_NAME']."/");

$host='localhost';
$user='root';
$password='';
$database='copo';
$db= mysqli_connect( $host, $user, $password, $database);
if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>
