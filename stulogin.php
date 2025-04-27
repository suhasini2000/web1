<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required POST data is set
    if (isset($_POST['txtusr'], $_POST['txtpwd'], $_POST['txtemail'])) {
        $username = trim($_POST['txtusr']);
        $password = $_POST['txtpwd'];
        $email = trim($_POST['txtemail']);

        // Basic validation
        if (empty($password)) {
            echo "Password cannot be empty.";
            echo '<br><a href="stulogin_process.php">Go Back</a>';
            exit();
        }

        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $servername = "localhost";  // Update if necessary
        $username_db = "gen"; 
        $password_db = "lakshith.2018"; 
        $dbname = "geninfo";
        $mysqli = new mysqli($servername, $username_db, $password_db, $dbname);

        // Check for a connection error
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Begin transaction
        $mysqli->begin_transaction();

        try {
            // Insert login credentials into the 'log' table
            $stmt = $mysqli->prepare("INSERT INTO log (usr, pwd) VALUES (?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $mysqli->error);
            }
            $stmt->bind_param("ss", $username, $hashed_password);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }
            $stmt->close();

            // Update the student's logstatus to 'Y' in 'stu_reg' table
            $stmt = $mysqli->prepare("UPDATE stu_reg SET logstatus = 'Y', reset_token = NULL, token_expiry = NULL WHERE regdno = ?");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $mysqli->error);
            }
            $stmt->bind_param("s", $username);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }
            $stmt->close();

            // Commit the transaction
            $mysqli->commit();

            // Generate a password reset token
            $token = bin2hex(random_bytes(50)); // Generates a 100-character hexadecimal token

            // Update the stu_reg table with the reset token and expiry time (e.g., 1 hour from now)
            $stmt = $mysqli->prepare("UPDATE stu_reg SET reset_token = ?, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE regdno = ?");
            if (!$stmt) {
                die("Prepare failed: " . $mysqli->error);
            }
            $stmt->bind_param("ss", $token, $username);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
            $stmt->close();
            $mysqli->close();

            // Create the password reset link
            $reset_link = "https://www.geninfotech.co.in/reset_password.php?token=" . $token;

            // Send the password reset email to the student
            $subject = "Set Your Student Login Password";
            $message = "Dear Student,\n\nYour login has been created successfully. Please click the link below to set your password:\n\n$reset_link\n\nThis link will expire in 1 hour.\n\nRegards,\nGenInfoTech";
            $headers = "From: geninfo133@gmail.com"; // Replace with a valid sender email

            // Send the email
            if (mail($email, $subject, $message, $headers)) {
                // Optionally, inform the admin that the email was sent
                echo "Login has been created and a password reset link has been sent to $email.";
            } else {
                // Handle email sending failure
                echo "Failed to send email to $email.";
            }

            // Redirect back to admin_process.php with a success message
            header("Location: admin_process.php?message=Login created successfully and email sent.");
            exit();
        } catch (Exception $e) {
            // Rollback the transaction on error
            $mysqli->rollback();
            echo "Failed to create student login: " . $e->getMessage();
            echo '<br><a href="admin_process.php">Go Back</a>';
            exit();
        }
    } else {
        // Missing POST data
        echo "Invalid request. Missing required data.";
        echo '<br><a href="admin_process.php">Go Back</a>';
        exit();
    }
} else {
    // If accessed directly without POST data, redirect back
    header("Location: admin_process.php");
    exit();
}
?>
