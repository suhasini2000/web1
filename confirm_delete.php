<?php
require_once "db.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected registration number
    $regdno = mysqli_real_escape_string($mysqli, $_POST['rno']);
    
    // SQL query to delete the student record
    $sql = "DELETE FROM stu_reg WHERE regdno = '$regdno'";

    // Execute the query
    if (mysqli_query($mysqli, $sql)) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($mysqli);
    }
}

echo '<br><a href="admin_process.php">Back to Admin Panel</a>';
?>
