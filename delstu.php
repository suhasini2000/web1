<?php
require_once "db.php"; // Include your database connection file

// Check if the 'regdno' parameter is set in the URL
if (isset($_GET['regdno'])) {
    $regdno = mysqli_real_escape_string($mysqli, $_GET['regdno']);
    
    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM stu_reg WHERE regdno='$regdno'";
    
    // Execute the query
    if (mysqli_query($mysqli, $sql)) {
        // If deletion is successful, redirect to a success page or back to admin_process.php
        header("Location: admin_process.php?msg=Record+deleted+successfully");
        exit(); // Exit to ensure no further code is executed
    } else {
        // If there's an error, redirect to an error page or display a message
        header("Location: admin_process.php?msg=Error+deleting+record");
        exit();
    }
} else {
    // If 'regdno' is not set, redirect back to the admin_process.php
    header("Location: admin_process.php?msg=Invalid+request");
    exit();
}
?>
