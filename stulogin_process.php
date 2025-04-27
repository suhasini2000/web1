<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link type="text/css" href="style.css" rel="stylesheet"/>
<script src="js/jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vallenato.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="vallenato.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" href="smoothness/jquery-ui.css">
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
// Database connection details
$servername = "localhost";
$username = "gen";
$password = "lakshith.2018";
$dbname = "geninfo";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Escape the user input to prevent SQL injection
$reg = mysqli_real_escape_string($mysqli, $_POST['rno']);

// Query to select student based on the registration number
$sql = "SELECT * FROM stu_reg WHERE regdno = '$reg'";

// Execute the query
$result = mysqli_query($mysqli, $sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an object
    if ($row = mysqli_fetch_object($result)) {
        // Assign the values to variables
        $username = $row->regdno;	  
        $email = $row->mailid;
    } else {
        // Handle case where no records are found
        echo "No student found with the given registration number.";
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Handle query failure
    echo "Error: " . mysqli_error($mysqli);
}

// Close the database connection
$mysqli->close();
?>


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
       
       <div style="margin-top:20px;">
        <form action="stulogin.php" method="post">
         <table style="width:500px; height:300px; border:#0000FF dotted; font-size:18px; font-weight:bold;">
          <tr>
            <td> User Name </td>
            <td> <input type="text" name="txtusr" value="<?php echo $username; ?>" readonly="readonly"> </td>
          </tr> 
          <tr>
           <td>Password</td>
           <td> <input type="password" name="txtpwd"> </td>
          </tr>
          <tr>
           <td>Email</td>
           <td> <input type="text" name="txtemail" value="<?php echo $email;?>" readonly="readonly"> </td>
          </tr>
          <tr>
           <td> <input type="submit" value="Submit">  </td>
          </tr>
         </table>
        </form>
       </div>
    </div>
    </div>
    <div id="footer">
  <table width="1100px" style="color:#FFFFFF;">
    <tr>
    <td>
     <br>
    Copyright &copy; 2014 GenInfoTech, Tanuku. <br><br>All Rights Reserved
     </td>
    <td>
   <img src="images/followus.gif" width="176" height="29" border="0" usemap="#Map" />
          <map name="Map" id="Map">
            <area shape="circle" coords="103,15,12" href="http://facebook.com" />
            <area shape="circle" coords="133,15,12" href="https://twitter.com" />
            <area shape="circle" coords="164,15,12" href="http://in.linkedin.com" />
          </map>
    </td>
   </tr>
   </table>
  </div>

    
</div>
</body>
</html>

</body>
</html>
