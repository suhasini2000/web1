<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['usr']);
    $password = trim($_POST['pwd']);

    if (empty($username) || empty($password)) {
        header("Location: index.php?error=empty_fields");
        exit();
    }

    // Prepare statement to fetch password and regdno
    $stmt = $mysqli->prepare("SELECT pwd, usr FROM log WHERE usr = ? AND status = 'Y'");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password, $regdno);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['reg'] = $regdno; // Set regdno for access in student_choice.php
                header("Location: student_choice.php");
                exit();
            } else {
                header("Location: index.php?error=incorrect_password");
                exit();
            }
        } else {
            header("Location: index.php?error=user_not_found");
            exit();
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare query.";
    }
}
?>
