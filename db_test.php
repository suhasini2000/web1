<?php
// Test the database connection
$mysqli = new mysqli(("localhost:3306", "gen", "lakshith.2018", "geninfo");

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
} else {
    echo "Database connection successful!";
}
?>
