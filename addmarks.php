<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Marks</title>
</head>
<body>
<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize input
    $regdno1 = mysqli_real_escape_string($mysqli, $_POST['rno']);
    $course1 = mysqli_real_escape_string($mysqli, $_POST['course']);
    $subject1 = mysqli_real_escape_string($mysqli, $_POST['subject']);
    
    // Get the exam date directly since it's already in the correct format
    $exam_date1 = mysqli_real_escape_string($mysqli, $_POST['exam_date']);
    
    // Check if the exam_date is valid
    $dateObj = DateTime::createFromFormat('Y-m-d', $exam_date1);
    if ($dateObj) {
        $exam_date1 = $dateObj->format('Y-m-d'); // This ensures the format is consistent
    } else {
        echo "Invalid exam date format.";
        header("Location: admin_process.php"); // Redirect to Admin Panel
        exit;
    }

    $marks1 = mysqli_real_escape_string($mysqli, $_POST['marks']);
    $grade1 = mysqli_real_escape_string($mysqli, $_POST['grade']);

    // Prepare SQL statement
    $sql = "INSERT INTO marks (regdno, course, subject, exam_date, marks, grade) VALUES ('$regdno1', '$course1', '$subject1', '$exam_date1', '$marks1', '$grade1')";
    
    // Print SQL query for debugging
    // echo "SQL Query: " . $sql . "<br>"; // Uncomment for debugging

    // Execute the query
    if (mysqli_query($mysqli, $sql)) {
        echo "Data inserted successfully.";
        header("Location: admin_process.php"); // Redirect to Admin Panel after success
        exit; // Ensure no further code is executed after the redirect
    } else {
        echo "Error: " . mysqli_error($mysqli);
        header("Location: admin_process.php"); // Redirect to Admin Panel after error
        exit; // Ensure no further code is executed after the redirect
    }
}
?>
</body>
</html>
