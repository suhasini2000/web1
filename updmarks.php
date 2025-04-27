<!-- updmarks.php -->
<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session if needed
session_start();

require_once "db.php";

// Check if all required POST data is set
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['regdno'], $_POST['course'], $_POST['subject'], $_POST['exam_date'], $_POST['marks'], $_POST['grade'], $_POST['cer_gene'])) {
        
        // Sanitize and assign variables
        $regdno1 = mysqli_real_escape_string($mysqli, $_POST['regdno']);
        $course1 = mysqli_real_escape_string($mysqli, $_POST['course']);
        $subject1 = mysqli_real_escape_string($mysqli, $_POST['subject']);
        $exam_date1 = mysqli_real_escape_string($mysqli, $_POST['exam_date']);
        $marks1 = intval($_POST['marks']); // Assuming marks are integers
        $grade1 = mysqli_real_escape_string($mysqli, $_POST['grade']);
        $cer_gene1 = mysqli_real_escape_string($mysqli, $_POST['cer_gene']);

        // Validate inputs (optional but recommended)
        // Example: Check if marks are within a valid range
        if ($marks1 < 0 || $marks1 > 100) {
            echo "Marks should be between 0 and 100.";
            echo '<br><a href="marksupd.php">Go Back</a>';
            exit();
        }

        // Update the record
        $sql = "UPDATE marks SET 
                    course='$course1', 
                    subject='$subject1', 
                    exam_date='$exam_date1', 
                    marks='$marks1', 
                    grade='$grade1', 
                    cer_gene='$cer_gene1' 
                WHERE regdno='$regdno1' AND subject='$subject1'";

        if (mysqli_query($mysqli, $sql)) {
            // Redirect to confirmation page with success message
            header("Location: marksupd_confirmation.php?status=success");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
            echo '<br><a href="marksupd.php">Go Back</a>';
        }
    } else {
        // Missing POST data
        echo "Missing required data.";
        echo '<br><a href="admin_process.php">Go Back</a>';
    }
} else {
    // If accessed directly without POST data, redirect back
    header("Location: admin_process.php");
    exit();
}

mysqli_close($mysqli);
?>
