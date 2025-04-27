ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GenInfotech</title>
<link type="text/css" href="style.css" rel="stylesheet"/>
<script src="js/jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vallenato.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="vallenato.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" href="smoothness/jquery-ui.css">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<style>
#hlink {
    text-decoration: none;
    font-size: 22px;
    color: #000099;
    font-weight: bolder;
    padding-left: 20px;
}
#cite1 {
    line-height: 55px;
    font-style: normal;
}
</style>
</head>
<body>

<?php
require_once "db.php"; // Ensure $mysqli is your MySQLi connection

// Check and escape user inputs to avoid missing fields and SQL injection
$regdno1 = isset($_POST['regdno']) && !empty($_POST['regdno']) ? mysqli_real_escape_string($mysqli, $_POST['regdno']) : null;
$sirname1 = isset($_POST['sirname']) && !empty($_POST['sirname']) ? mysqli_real_escape_string($mysqli, $_POST['sirname']) : null;
$name1 = isset($_POST['name']) && !empty($_POST['name']) ? mysqli_real_escape_string($mysqli, $_POST['name']) : null;
$fname1 = isset($_POST['fname']) && !empty($_POST['fname']) ? mysqli_real_escape_string($mysqli, $_POST['fname']) : null;
$hno1 = isset($_POST['hno']) && !empty($_POST['hno']) ? mysqli_real_escape_string($mysqli, $_POST['hno']) : null;
$area1 = isset($_POST['area']) && !empty($_POST['area']) ? mysqli_real_escape_string($mysqli, $_POST['area']) : null;
$town1 = isset($_POST['town']) && !empty($_POST['town']) ? mysqli_real_escape_string($mysqli, $_POST['town']) : null;
$cellno1 = isset($_POST['cellno']) && !empty($_POST['cellno']) ? mysqli_real_escape_string($mysqli, $_POST['cellno']) : null;
$mailid1 = isset($_POST['mailid']) && !empty($_POST['mailid']) ? mysqli_real_escape_string($mysqli, $_POST['mailid']) : null;
$reference1 = isset($_POST['reference']) && !empty($_POST['reference']) ? mysqli_real_escape_string($mysqli, $_POST['reference']) : null;
$qual1 = isset($_POST['qual']) && !empty($_POST['qual']) ? mysqli_real_escape_string($mysqli, $_POST['qual']) : null;
$course1 = isset($_POST['course']) && !empty($_POST['course']) ? mysqli_real_escape_string($mysqli, $_POST['course']) : null;
$duration1 = isset($_POST['duration']) && !empty($_POST['duration']) ? mysqli_real_escape_string($mysqli, $_POST['duration']) : null;
$jdate1 = isset($_POST['jdate']) && !empty($_POST['jdate']) ? mysqli_real_escape_string($mysqli, $_POST['jdate']) : null;

// Debugging: print the POST data to check for missing fields
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Check if all required fields are present
if ($regdno1 && $sirname1 && $name1 && $fname1 && $hno1 && $area1 && $town1 && $cellno1 && $mailid1 && $reference1 && $qual1 && $course1 && $duration1 && $jdate1) {
    // Update query
    $sql = "UPDATE stu_reg SET 
                sirname='$sirname1', 
                name='$name1', 
                fname='$fname1', 
                hno='$hno1', 
                area='$area1', 
                town='$town1', 
                cellno='$cellno1', 
                mailid='$mailid1', 
                reference='$reference1', 
                qual='$qual1', 
                course='$course1', 
                duration='$duration1', 
                jdate='$jdate1'
            WHERE regdno='$regdno1'";

    // Execute the query
    if (mysqli_query($mysqli, $sql)) {
        header("Location: admin_process.php"); // Redirect to success page
    } else {
        echo "Error: " . mysqli_error($mysqli); // Output any SQL errors
    }
} else {
    // If any fields are missing, display an error message
    echo "Some fields are missing. Please fill out all fields.";
}

// Close the connection
mysqli_close($mysqli);
?>
</body>
</html>
