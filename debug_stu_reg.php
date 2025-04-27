<?php
// debug_stu_reg.php

require_once "db.php";

// Prepare the query to select all students
$stmt = $mysqli->prepare("SELECT regdno, mailid, logstatus FROM stu_reg");
if (!$stmt) {
    die("Query preparation failed: " . $mysqli->error);
}

$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Debug: stu_reg Table Contents</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Registration Number</th><th>Email</th><th>Log Status</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['regdno']) . "</td>
                <td>" . htmlspecialchars($row['mailid']) . "</td>
                <td>" . htmlspecialchars($row['logstatus']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No records found.</td></tr>";
}

echo "</table>";

// Close statement and connection
$stmt->close();
$mysqli->close();
?>
