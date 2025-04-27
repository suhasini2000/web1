<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli("localhost:3306", "gen", "lakshith.2018", "geninfo");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
//else {
    //echo "Connected successfully to the database.";
//}
?>

</body>
</html>

