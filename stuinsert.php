<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require_once 'db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize POST data using MySQLi's real_escape_string
    $regdno1    = $mysqli->real_escape_string($_POST['regdno']);
    $sirname1   = $mysqli->real_escape_string($_POST['sirname']);
    $name1      = $mysqli->real_escape_string($_POST['name']);
    $fname1     = $mysqli->real_escape_string($_POST['fname']);
    $hno1       = $mysqli->real_escape_string($_POST['hno']);
    $area1      = $mysqli->real_escape_string($_POST['area']);
    $town1      = $mysqli->real_escape_string($_POST['town']);
    $cellno1    = $mysqli->real_escape_string($_POST['cellno']);
    $mailid1    = $mysqli->real_escape_string($_POST['mailid']);
    $reference1 = $mysqli->real_escape_string($_POST['reference']);
    $qual1      = $mysqli->real_escape_string($_POST['qual']);
    $course1    = $mysqli->real_escape_string($_POST['course']);
    $options1   = isset($_POST['options1']) ? $mysqli->real_escape_string($_POST['options1']) : null;
    $options2   = isset($_POST['options2']) ? $mysqli->real_escape_string($_POST['options2']) : null;
    $options3   = isset($_POST['options3']) ? $mysqli->real_escape_string($_POST['options3']) : null;
    $options4   = isset($_POST['options4']) ? $mysqli->real_escape_string($_POST['options4']) : null;
    $duration1  = $mysqli->real_escape_string($_POST['duration']);
    $jdate1     = $mysqli->real_escape_string($_POST['joindate']); // Fixed the key name here

    // Begin Transaction
    $mysqli->begin_transaction();

    try {
        // Prepare the INSERT statement for stu_reg
        $stmt = $mysqli->prepare("INSERT INTO stu_reg (regdno, sirname, name, fname, hno, area, town, cellno, mailid, reference, qual, course, duration, jdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $mysqli->error);
        }

        // Bind parameters
        $stmt->bind_param("ssssssssssssss", $regdno1, $sirname1, $name1, $fname1, $hno1, $area1, $town1, $cellno1, $mailid1, $reference1, $qual1, $course1, $duration1, $jdate1);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // Insert into stu_course based on course type
        if ($course1 === 'DCA') {
            $stmt_course = $mysqli->prepare("INSERT INTO stu_course (regno, course, subject, subject1, subject2) VALUES (?, ?, 'Fundamentals & MSOffice', ?, ?)");
            if (!$stmt_course) {
                throw new Exception("Prepare failed: " . $mysqli->error);
            }
            $stmt_course->bind_param("ssss", $regdno1, $course1, $options1, $options2);
            if (!$stmt_course->execute()) {
                throw new Exception("Execute failed: " . $stmt_course->error);
            }
            $stmt_course->close();
        } elseif ($course1 === 'PGDCA') {
            $stmt_course = $mysqli->prepare("INSERT INTO stu_course (regno, course, subject, subject1, subject2, subject3, subject4) VALUES (?, ?, 'Fundamentals & MSOffice', ?, ?, ?, ?)");
            if (!$stmt_course) {
                throw new Exception("Prepare failed: " . $mysqli->error);
            }
            $stmt_course->bind_param("ssssss", $regdno1, $course1, $options1, $options2, $options3, $options4);

            if (!$stmt_course->execute()) {
                throw new Exception("Execute failed: " . $stmt_course->error);
            }
            $stmt_course->close();
        } elseif (in_array($course1, ['JAVA', 'CORE JAVA', 'Adv.JAVA', 'J2EE', 'HTML', 'C', 'C++','DotNet', 'Sql', 'PHP', 'MSOFFICE', 'UNIX','AutoCad', 'Photoshop', 'Page Maker', 'Tally'])) {
            $stmt_course = $mysqli->prepare("INSERT INTO stu_course (regno, course, subject) VALUES (?, ?, ?)");
            if (!$stmt_course) {
                throw new Exception("Prepare failed: " . $mysqli->error);
            }
            $stmt_course->bind_param("sss", $regdno1, $course1, $course1);
            if (!$stmt_course->execute()) {
                throw new Exception("Execute failed: " . $stmt_course->error);
            }
            $stmt_course->close();
        }

        // Commit Transaction
        $mysqli->commit();

        // Redirect to addstu.php after successful insertion
        header("Location: addstu.php");
        exit();

    } catch (Exception $e) {
        // An exception has been thrown
        // Rollback the transaction
        $mysqli->rollback();
        echo "Failed to insert record: " . $e->getMessage();
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
} else {
    echo "Invalid request method.";
}
?>
