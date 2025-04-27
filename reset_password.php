<?php
// reset_password.php

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "db.php";

// Set the character set for the MySQL connection
$mysqli->set_charset("latin1");

// Function to generate a secure token
function generateToken($length = 50) {
    return bin2hex(random_bytes($length));
}

// Check if the request is to initiate password reset
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate the token
    $stmt = $mysqli->prepare("SELECT regdno FROM stu_reg WHERE reset_token = ? AND token_expiry > NOW()");
    if (!$stmt) {
        die("Query preparation failed: " . $mysqli->error);
    }
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $regdno = $row['regdno'];
    } else {
        echo "Invalid or expired token.";
        exit();
    }

    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'], $_POST['password'], $_POST['confirm_password'])) {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Begin transaction
    $mysqli->begin_transaction();

    try {
        // Update the password in the 'log' table
        $stmt = $mysqli->prepare("UPDATE log SET pwd = ? WHERE usr = (SELECT regdno FROM stu_reg WHERE reset_token = ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $mysqli->error);
        }
        $stmt->bind_param("ss", $hashed_password, $token);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        // Remove the reset token and expiry from 'stu_reg' table
        $stmt = $mysqli->prepare("UPDATE stu_reg SET reset_token = NULL, token_expiry = NULL WHERE reset_token = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $mysqli->error);
        }
        $stmt->bind_param("s", $token);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        // Commit the transaction
        $mysqli->commit();

        echo "Password has been reset successfully. You can now log in.";
    } catch (Exception $e) {
        // Rollback the transaction on error
        $mysqli->rollback();
        echo "Failed to reset password: " . $e->getMessage();
    }

    // Close connection
    $mysqli->close();
    exit();
} else {
    echo "Invalid request.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link type="text/css" href="style.css" rel="stylesheet"/>
    <style>
        /* Add your custom styles here */
        table {
            border: 1px solid #0000FF;
            padding: 20px;
            width: 400px;
            margin: auto;
            background-color: #F9F9F9;
        }
        input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php if (isset($regdno)): ?>
        <h2 style="text-align: center;">Reset Password for <?php echo htmlspecialchars($regdno); ?></h2>
        <form action="reset_password.php" method="post">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <table>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="Reset Password"></td>
                </tr>
            </table>
        </form>
    <?php endif; ?>
</body>
</html>
