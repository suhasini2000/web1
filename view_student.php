<?php
require_once "db.php"; // Include your database connection

// Check if a student ID is passed through POST (not GET)
if (isset($_POST['rno'])) {
    $regdno = mysqli_real_escape_string($mysqli, $_POST['rno']);
    
    // Fetch the student record
    $sql = "SELECT regdno, name, mailid FROM stu_reg WHERE regdno = '$regdno'";
    $result = mysqli_query($mysqli, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "Student not found.";
        exit;
    }
} else {
    echo "Invalid student ID.";
    exit;
}

// If delete button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // SQL query to delete the student record
    $sql = "DELETE FROM stu_reg WHERE regdno = '$regdno'";

    // Execute the query
    if (mysqli_query($mysqli, $sql)) {
        echo "<p>Record deleted successfully.</p>";
        echo '<br><a href="admin_process.php">Back to Admin Panel</a>';
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KE6NT3CmgKUPRcCZG+yu4hNir5Uq4XmgzDbpJWptMx8Qn4DixpFZxW4Ij3wZK4G1" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link type="text/css" href="style.css" rel="stylesheet"/>
<script src="jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vallenato.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="vallenato.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" href="smoothness/jquery-ui.css">
<script src="jquery-1.9.1.js"></script>
<script src="jquery-ui.js"></script>
</head>
<body>
     <div id="main">
      <div id="header">
      </div>
      
      <div id="content">
         <div id="content1">
             <div id="menu" style="margin-left:-30px;">
                <ul class="navi" >
                <li><a href="index.php"><img src="images/arrow.png" />Home</a></li>
                <li><a href="aboutus.php"><img src="images/arrow.png" />About Us</a></li>
                <li><a href="courses.php"><img src="images/arrow.png" />Courses</a></li>
                <li><a href="gallery.php#"><img src="images/arrow.png" />Gallery</a></li>
                <li><a href="contactus.php"><img src="images/arrow.png" />Contact Us</a></li>
                </ul>
            </div>
         </div>
         
         <div id="content2">
              <h2 class="card-title text-center">Student Details</h2>
                <p><strong>Regd No:</strong> <?php echo $student['regdno']; ?></p>
                <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $student['mailid']; ?></p>

                <form method="POST" action="">
                    <input type="hidden" name="rno" value="<?php echo $student['regdno']; ?>">
                    <button type="submit" name="delete" class="btn btn-danger">Delete Student</button>
                </form>

                <br>
                <a href="admin_process.php" class="btn btn-primary">Back to Admin Panel</a>
         </div>    
         
         <div id="content3">
             
         </div>
      </div>
      
      <div id="footer">
         
      </div>
   
</body>
</html>
