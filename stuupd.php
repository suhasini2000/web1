<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GenInfotech</title>
<link type="text/css" href="style.css" rel="stylesheet"/>
<script src="js/jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vallenato.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="vallenato.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" href="css/smoothness/jquery-ui.css">
  <script src="js/jquery-1.9.1.js"></script>
   <script src="js/jquery-ui.js"></script>
   
    
<style>
#hlink
{
text-decoration:none;
font-size:22px;
color:#000099;
font-weight:bolder;
padding-left:20px;
}
#cite1
{
line-height:55px;
font-style:normal;
}
</style>

</head>

<body>

<?php
require_once "db.php"; // Ensure that $conn is defined in db.php as the MySQLi connection

// Escape user input to prevent SQL injection
$regdno1 = mysqli_real_escape_string($mysqli, $_POST['rno']);

// Update query
$sql = "SELECT * FROM stu_reg WHERE regdno='$regdno1'";

// Execute the query
$result = mysqli_query($mysqli, $sql);
?>

<div id="main">
 <div id="header"></div>
 <div id="content">
   <div id="content1">
    <div id="menu" style="margin-left:-30px;">
        <ul class="navi">
            <li><a href="index.php"><img src="images/arrow.png" />Home</a></li>
            <li><a href="aboutus.php"><img src="images/arrow.png" />About Us</a></li>
            <li><a href="courses.php"><img src="images/arrow.png" />Courses</a></li>
            <li><a href="gallery.php#"><img src="images/arrow.png" />Gallery</a></li>
            <li><a href="contactus.php"><img src="images/arrow.png" />Contact Us</a></li>
        </ul>
     </div>
   </div>

   <div id="content2">
       <form action="updstu.php" method="post">
           <table style="margin-top:50px; background-color:#0066CC; font-size:24px; font-family:'Courier New', Courier, monospace; color:#FFFFFF; font-weight:bold; height:500px; width:600px;" align="center">
           <?php
           // Fetch the result and populate the form
           while ($row = mysqli_fetch_array($result)) { ?>
               <tr>
                   <td> Register No</td>
                   <td><input type="text" name="regdno" value="<?php echo $row[0]; ?>" /></td>
               </tr>
               <tr>
                   <td> Sur Name </td>
                   <td><input type="text" name="sirname" value="<?php echo $row[1]; ?>" /></td>
               </tr>
               <tr>
                   <td> Name</td> 
                   <td><input type="text" name="name" value="<?php echo $row[2]; ?>" /></td>
               </tr>
               <tr>
                   <td>Father Name </td>
                   <td><input type="text" name="fname" value="<?php echo $row[3]; ?>" /></td>
               </tr>
               <tr>
                   <td> H.No</td>
                   <td><input type="text" name="hno" value="<?php echo $row[4]; ?>" /></td>
               </tr>
               <tr>
                   <td>Street Name</td>
                   <td><input type="text" name="area" value="<?php echo $row[5]; ?>" /></td>
               </tr>
               <tr>
                   <td>Town Name</td>
                   <td><input type="text" name="town" value="<?php echo $row[6]; ?>" /></td>
               </tr>
               <tr>
                   <td>Cell Number</td>
                   <td><input type="text" name="cellno" value="<?php echo $row[7]; ?>" /></td>
               </tr>
               <tr>
                   <td>Email Id</td>
                   <td><input type="text" name="mailid" value="<?php echo $row[8]; ?>" /></td>
               </tr>
               <tr>
                   <td>Reference</td>
                   <td><input type="text" name="reference" value="<?php echo $row[9]; ?>" /></td>
               </tr>
               <tr>
                   <td>Qualification</td>
                   <td><input type="text" name="qual" value="<?php echo $row[10]; ?>" /></td>
               </tr>
               <tr>
                   <td>Course</td>
                   <td><input type="text" name="course" value="<?php echo $row[11]; ?>" /></td>
               </tr>
               <tr>
                   <td>Duration</td>
                   <td><input type="text" name="duration" value="<?php echo $row[12]; ?>" /></td>
               </tr>
               <tr>
                   <td>Joining Date</td>
                   <td><input type="text" name="jdate" value="<?php echo $row[13]; ?>" /></td>
               </tr>
               <tr>
                   <td><input type="submit" value="Submit" /></td>
               </tr>
           <?php } ?>
           </table>
       </form>
   </div>
 </div>
</div>

<?php
// Close the connection
mysqli_close($mysqli);
?>



</body>
</html>
