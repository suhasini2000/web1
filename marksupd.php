<!-- marksupd.php -->
<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session if needed
session_start();

require_once "db.php";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if both 'rno' and 'subject' are set
    if (isset($_POST['rno']) && isset($_POST['subject'])) {
        // Both 'rno' and 'subject' are set: Display the update form

        $regdno1 = mysqli_real_escape_string($mysqli, $_POST['rno']);
        $subj = mysqli_real_escape_string($mysqli, $_POST['subject']);

        // Fetch the specific record
        $sql = "SELECT * FROM marks WHERE regdno='$regdno1' AND subject='$subj'";
        $result = mysqli_query($mysqli, $sql);

        if (!$result) {
            // Query failed
            echo "Error fetching record: " . mysqli_error($mysqli);
            echo '<br><a href="admin_process.php">Go Back</a>';
            exit();
        }

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Update Marks</title>
                <link type="text/css" href="style.css" rel="stylesheet"/>
                <!-- Include your CSS and JS files here -->
            </head>
            <body>
                <h2>Update Marks for Regd No: <?php echo htmlspecialchars($regdno1); ?> - Subject: <?php echo htmlspecialchars($subj); ?></h2>
                <form action="updmarks.php" method="post">
                    <table border="1" style="width: 600px; margin: auto; background-color: #0066CC; color: #FFFFFF; font-size: 18px;">
                        <tr>
                            <td>Registered No</td>
                            <td><input type="text" name="regdno" value="<?php echo htmlspecialchars($row['regdno']); ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Course</td>
                            <td><input type="text" name="course" value="<?php echo htmlspecialchars($row['course']); ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Subject</td>
                            <td><input type="text" name="subject" value="<?php echo htmlspecialchars($row['subject']); ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Exam Date</td>
                            <td><input type="date" name="exam_date" value="<?php echo htmlspecialchars($row['exam_date']); ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Marks</td>
                            <td><input type="number" name="marks" value="<?php echo htmlspecialchars($row['marks']); ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Grade</td>
                            <td><input type="text" name="grade" value="<?php echo htmlspecialchars($row['grade']); ?>" maxlength="3" required /></td>
                        </tr>
                        <tr>
                            <td>Certificate Issued</td>
                            <td>
                                <select name="cer_gene" required>
                                    <option value="Y" <?php if($row['cer_gene'] == 'Y') echo 'selected'; ?>>Yes</option>
                                    <option value="N" <?php if($row['cer_gene'] == 'N') echo 'selected'; ?>>No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" value="Update Marks" /></td>
                        </tr>
                    </table>
                </form>
            </body>
            </html>
            <?php
        } else {
            // No matching record found
            echo "No matching record found.";
            echo '<br><a href="admin_process.php">Go Back</a>';
        }
    } elseif (isset($_POST['rno'])) {
        // Only 'rno' is set: Display the subject selection form

        $regdno1 = mysqli_real_escape_string($mysqli, $_POST['rno']);

        // Fetch subjects for the selected rno (Removed 'status = 'Y'')
        $sql = "SELECT subject FROM marks WHERE regdno='$regdno1'";
        $result = mysqli_query($mysqli, $sql);

        if (!$result) {
            // Query failed
            echo "Error fetching subjects: " . mysqli_error($mysqli);
            echo '<br><a href="admin_process.php">Go Back</a>';
            exit();
        }

        if (mysqli_num_rows($result) > 0) {
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Select Subject to Update</title>
                <link type="text/css" href="style.css" rel="stylesheet"/>
                <!-- Include your CSS and JS files here -->
            </head>
            <body>
                <h2>Select Subject to Update Marks for Regd No: <?php echo htmlspecialchars($regdno1); ?></h2>
                <form action="marksupd.php" method="post">
                    <input type="hidden" name="rno" value="<?php echo htmlspecialchars($regdno1); ?>" />
                    <table border="1" style="width: 300px; margin: auto; background-color: #F0F0F0; padding: 20px;">
                        <tr>
                            <td><label for="subject">Subject:</label></td>
                            <td>
                                <select name="subject" id="subject" required>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . htmlspecialchars($row['subject']) . "'>" . htmlspecialchars($row['subject']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" value="Select Subject" /></td>
                        </tr>
                    </table>
                </form>
            </body>
            </html>
            <?php
        } else {
            // No subjects found for the selected rno
            echo "No subjects found for the selected Registration Number.";
            echo '<br><a href="admin_process.php">Go Back</a>';
        }
    } else {
        // Neither 'rno' nor 'subject' is set: Redirect back
        header("Location: admin_process.php");
        exit();
    }
} else {
    // If accessed directly without POST data, redirect back
    header("Location: admin_process.php");
    exit();
}

mysqli_close($mysqli);
?>
