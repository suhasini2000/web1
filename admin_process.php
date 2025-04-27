
<?php
// Include the database connection file
include 'db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $username = trim($_POST['usr']);
    $password = trim($_POST['pwd']);

    // Check if username and password are provided
    if (empty($username) || empty($password)) {
        // Redirect to index.php with error message
        header("Location: index.php?error=empty_fields");
        exit;
    }

    // SQL query to check credentials
    $query = "SELECT * FROM admins WHERE username = ? AND password = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Credentials are correct, log in the user
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: admin_process.php"); // Redirect to admin dashboard or home page
        } else {
            // Incorrect credentials, redirect with error
            header("Location: index.php?error=invalid_credentials");
        }

        $stmt->close();
    } else {
        // Error with the query
        echo "Error: Could not prepare query.";
    }
}

?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
require_once "db.php"; // Ensure this file sets up $mysqli properly

// Check if connection is successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare the query to select students with logstatus='N'
$stmt = $mysqli->prepare("SELECT regdno, mailid, logstatus FROM stu_reg WHERE logstatus = 'N'");
if (!$stmt) {
    die("Query preparation failed: " . $mysqli->error);
}

$stmt->execute();
$result = $stmt->get_result();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link type="text/css" href="style.css" rel="stylesheet"/>
<script src="jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vallenato.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="vallenato.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" href="smoothness/jquery-ui.css">
<script src="jquery-1.9.1.js"></script>
<script src="jquery-ui.js"></script>

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
    
  <div id="main">
      <div id="header">
          <table width="100%" >
        <tr>
            <td style="padding-top:50px;">
                <a href="" target="_blank">
                    <img src="images/phone.png" width="30" height="30" alt="phone">
                </a>
                <a href="contact.php" target="_blank">
                    <img src="images/loc logo.png" width="30" height="30" alt="address">
                </a>
            </td>
            <td style="padding-left:900px;padding-top:50px;">
                <a href="https://www.facebook.com/profile.php?id=100063653062101&mibextid=ZbWKwL" target="_blank">
                    <img src="images/facebook-icon.png" width="30" height="30" alt="Facebook">
                </a>
                <a href="https://youtube.com/@geninfocomputereducationcentre?si=3uFdT_aYPUaz-kLc" target="_blank">
                    <img src="images/youtube-icon.png" width="30" height="30" alt="YouTube">
                </a>
                <a href="https://www.instagram.com/gen.sth?igsh=a2NpOTdra3hzeG0w" target="_blank">
                    <img src="images/instagram-icon.jpeg" width="30" height="30" alt="Instagram">
                </a>
            </td>
        </tr>
        </table>
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
             <?php
/*
echo '
    <h2>Debug: stu_reg Table Contents</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Registration Number</th>
            <th>Email</th>
            <th>Log Status</th>
        </tr>
        <?php
        // Output the results of the query
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['regdno']) . "</td>
                        <td>" . htmlspecialchars($row['mailid']) . "</td>
                        <td>" . htmlspecialchars($row['logstatus']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan=\'3\'>No records found.</td></tr>";
        }
        ?>
    </table>
';
*/
?>
                
                
             <div id="adm_log" style=" margin-left:200px; margin-top:50px;height:auto; ; width: 200px; z-index:4;  position:absolute;">
                 <h2 class="accordion-header" style="height: 18px; margin-bottom: 0px; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(53, 48, 48); border:solid; border-color:#0000CC;" align="center">
                   ADD STUDENT  
                 </h2>
                 <div class="accordion-content" style="margin-bottom: 0px;">
                      <table width="200" border="1">
                         <tr>
                             <td>
                                 <a href="addstu.php">Add Student</a>
                             </td>
                         </tr>
                        </table>
                 </div>
                
           
             
                <h2 class="accordion-header" style="height: 18px; margin-bottom: 0px; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(53, 48, 48); border:solid; border-color:#0000CC;" align="center">
                 UPDATE STUDENT
                </h2>
                <div class="accordion-content" style="margin-bottom: 0px;">
                            <form action="stuupd.php" method="post">    
                                <table width="200" border="1">
                                    <tr>
                                        <td>Enter Regd No</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="rno">
                                                <?php
                                                // Database connection
                                                $servername = "localhost:3306";  // Update with your GoDaddy host (e.g., 'localhost' or a remote server)
                                                $username = "gen"; // GoDaddy database username
                                                $password = "lakshith.2018"; // GoDaddy database password
                                                $dbname = "geninfo"; // GoDaddy database name
                        
                        
                                                // Create connection
                                                $conn = new mysqli($servername, $username, $password, $dbname);
                        
                                                // Check connection
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                        
                                                // Fetch regdno where status is 'Y'
                                                $sql1 = "SELECT regdno FROM stu_reg WHERE status = 'Y'";
                                                $res1 = $conn->query($sql1);
                        
                                                // Populate the select dropdown
                                                if ($res1->num_rows > 0) {
                                                    while ($row = $res1->fetch_assoc()) {
                                                        echo "<option value='" . $row['regdno'] . "'>" . $row['regdno'] . "</option>";
                                                    }
                                                } else {
                                                    echo "<option>No students found</option>";
                                                }
                        
                                                // Close the connection
                                                $conn->close();
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="submit" id="submit" /></td>
                                    </tr>
                                </table>
                            </form>
                        </div>

             
                 <h2 class="accordion-header" style="height: 18px; margin-bottom: 0px; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(53, 48, 48); border:solid; border-color:#0000CC;" align="center">
                 VIEW STUDENT
                  </h2>  
                 <div class="accordion-content" style="margin-bottom: 0px;">
                             <form action="view_student.php" method="post">    
            <table>
                <tr>
                    <td>Enter Regd No</td>
                </tr>
                <tr>
                    <td>
                        <select name="rno">
                            <?php
                            // Database connection
                            $servername = "localhost:3306";  // Update with your GoDaddy host
                            $username = "gen"; // GoDaddy database username
                            $password = "lakshith.2018"; // GoDaddy database password
                            $dbname = "geninfo"; // GoDaddy database name

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch regdno where status is 'Y'
                            $sql1 = "SELECT regdno FROM stu_reg WHERE status = 'Y'";
                            $res1 = $conn->query($sql1);

                            // Populate the select dropdown
                            if ($res1->num_rows > 0) {
                                while ($row = $res1->fetch_assoc()) {
                                    echo "<option value='" . $row['regdno'] . "'>" . $row['regdno'] . "</option>";
                                }
                            } else {
                                echo "<option>No students found</option>";
                            }

                            // Close the connection
                            $conn->close();
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="submit" id="submit" /></td>
                </tr>
            </table>
        </form>
        </div>

                        <h2 class="accordion-header" style="height: 18px; margin-bottom: 0px; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(53, 48, 48); border:solid; border-color:#0000CC;" align="center">
                                          ADD MARKS
                        </h2>
                        <div class="accordion-content" style="margin-bottom: 0px;">
                                          
                        <table width="200" border="1">
                          
                          <tr>
                            <td><a href="marksadd.php">Add Marks</a></td>
                          </tr>
                          
                        </table>
                      </div>
                      
                      
                         <!-- admin_process.php -->
<h2 class="accordion-header" style="height: 18px; margin-bottom: 0px; color: rgb(255, 255, 255); background: rgb(53, 48, 48); border: solid #0000CC;" align="center">
        UPDATE MARKS
    </h2>
    <div class="accordion-content" style="margin-bottom: 0px;">
        <form action="marksupd.php" method="post">    
            <table width="200" border="1" align="center" style="background-color: #F0F0F0; padding: 20px;">
                <tr>
                    <td>Enter Regd No</td>
                </tr>
                <tr>
                    <td>
                        <select name="rno" required>
                            <?php
                            // Database connection
                            $servername = "localhost";  // Update if necessary
                            $username = "gen"; 
                            $password = "lakshith.2018"; 
                            $dbname = "geninfo"; 

                            // Create connection
                            $mysqli = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($mysqli->connect_error) {
                                die("Connection failed: " . $mysqli->connect_error);
                            }

                            // Fetch regdno where status is 'Y'
                            $sql1 = "SELECT regdno FROM stu_reg WHERE status = 'Y'";
                            $res1 = $mysqli->query($sql1);

                            // Populate the select dropdown
                            if ($res1->num_rows > 0) {
                                while ($row = $res1->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['regdno']) . "'>" . htmlspecialchars($row['regdno']) . "</option>";
                                }
                            } else {
                                echo "<option value=''>No students found</option>";
                            }

                            // Close the connection
                            $mysqli->close();
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="center"><input type="submit" value="Submit" id="submit" /></td>
                </tr>
            </table>
        </form>
    </div>

                      
       <!-- Student Login Creation -->
<h2 class="accordion-header" style="height: 18px; margin-bottom: 0px; color: #FFFFFF; background: #353030; border: solid #0000CC;" align="center">
    STUDENT LOGIN
</h2>

<div class="accordion-content" style="margin-bottom: 0px;">
    <form action="stulogin_process.php" method="post">
        <table width="200" border="1" align="center">
            <tr>
                <td>Login ID's</td>
            </tr>
            <tr>
                <td>
                    <select name="rno">
                    <?php 
                            $servername = "localhost";  // Update if necessary
                            $username = "gen"; 
                            $password = "lakshith.2018"; 
                            $dbname = "geninfo";  // Assuming you have a database connection in this file
                            $mysqli = new mysqli($servername, $username, $password, $dbname);
                
                    // Run the query, passing the connection ($mysqli) and the query string
                    $result = mysqli_query($mysqli, "SELECT regdno FROM stu_reg WHERE logstatus='N'");
                
                    // Check if the query was successful
                    if ($result) {
                        while ($row = mysqli_fetch_array($result)) {
                            // Output each option in the dropdown
                            echo "<option value='" . htmlspecialchars($row['regdno']) . "'>" . htmlspecialchars($row['regdno']) . "</option>";
                        }
                    } else {
                        // Handle query failure
                        echo "<option value=''>Error fetching data</option>";
                    }
                
                    ?>
                </select>

                </td>
            </tr>
            <tr>
                <td align="center"><input type="submit" value="Submit" id="submit" /></td>
            </tr>
        </table>
    </form>
</div>



         </div>
        </div>
         
         <div id="content3">
             
         </div>
      </div>
      
      <div id="footer">
         
      </div>
  </div>
</body>
</html>

<?php
// Close the mysqli connection
$mysqli->close();
?>

index.php

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>The GenInfotech Computer Education Centre</title>
<link type="text/css" href="style.css" rel="stylesheet"/>
<script src="js/jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
<script src="css/vallenato.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/vallenato.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" href="css/smoothness/jquery-ui.css">
  <script src="js/jquery-1.9.1.js"></script>
   <script src="js/jquery-ui.js"></script>
   <link rel="stylesheet" type="text/css" href="engine1/style.css" />
   
	<script type="text/javascript" src="engine1/jquery.js"></script>

</head>

<body>
<div id="main">
  <div id="header">
      <table width="100%" >
        <tr>
            <td style="padding-top:50px;">
                <a href="" target="_blank">
                    <img src="images/phone.png" width="30" height="30" alt="phone">
                </a>
                <a href="contact.php" target="_blank">
                    <img src="images/loc logo.png" width="30" height="30" alt="address">
                </a>
            </td>
            <td style="padding-left:900px;padding-top:50px;">
                <a href="https://www.facebook.com/profile.php?id=100063653062101&mibextid=ZbWKwL" target="_blank">
                    <img src="images/facebook-icon.png" width="30" height="30" alt="Facebook">
                </a>
                <a href="https://youtube.com/@geninfocomputereducationcentre?si=3uFdT_aYPUaz-kLc" target="_blank">
                    <img src="images/youtube-icon.png" width="30" height="30" alt="YouTube">
                </a>
                <a href="https://www.instagram.com/gen.sth?igsh=a2NpOTdra3hzeG0w" target="_blank">
                    <img src="images/instagram-icon.jpeg" width="30" height="30" alt="Instagram">
                </a>
            </td>
        </tr>
        </table>
  </div>
  
   <div id="content">
     <div id="content1">
        <div id="menu" style="margin-left:-30px;">
                <ul class="navi" >
                <li><a href="index.php"><img src="images/arrow.png" />Home</a></li>
                <li><a href="aboutus.php"><img src="images/arrow.png" />About Us</a></li>
                <li><a href="courses.html"><img src="images/arrow.png" />Courses</a></li>
                <li><a href="gallery.html"><img src="images/arrow.png" />Gallery</a></li>
                <li><a href="contact.php"><img src="images/arrow.png" />Contact Us</a></li>
                </ul>
        </div>
           <div id="adm_log"  style=" margin-left:60px; margin-top:200px;height:auto; ; width: 100px; z-index:4;  position:absolute;">
					
	<h2 class="accordion-header" style="height: 18px; margin-bottom: 0px; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(53, 48, 48); border:solid; border-color:#0000CC;" align="center">
                   Student Login</h2>
					<div class="accordion-content" style="margin-bottom: 0px; margin-left:-70px;">
                    <form action="login_check.php" method="post">
                    <table width="200" border="0">
  					<tr>
    				<td style="color: #000000;">User Name <input type="text" id="usr" size="15" name="usr" />
                    <br /></td>
  					</tr>
  					<tr>
    				<td style="color:#000000;">Password <input type="password" id="pwd" size="15" name="pwd" />		<br /></td>
  					</tr>
 					 <tr>
   					 <td><input type="submit" id="submit"  value="Submit"/></td>
 					</tr>
 
					</table>
					</form>

                    </div>
                    
                    <h2 class="accordion-header" style="height: 18px; margin-bottom: 0px; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(53, 48, 48); border:solid; border-color:#0000CC;" align="center">
                  Admn Login</h2>
					<div class="accordion-content" style="margin-bottom: 0px;margin-left:-70px;">
                   <form action="admin_process.php"  method="post"> 
                    <table width="200" border="0">
  						<tr>
   					 <td style="color:#FFFFFF;">User Name <input type="text" id="usr" size="15" name="usr" /><br /></td>
  					</tr>
  <tr>
    <td style="color:#FFFFFF;">Password <input type="password" id="pwd" size="15" name="pwd" /><br /></td>
  </tr>
  <tr>
    <td><input type="submit" id="submit"  value="Submit"/></td>
	</tr> 
</table>
</form>


                    </div>
              </div>
   
        
     </div>
     
     <div  id="content2">
       <p id="head1">
              WelCome...
              </p>
              
              <p id="para1">
               

<div id="f2">The GenInfotech Computer Education centre is founded in 2000 with the mission of providing best quality Computer education to all class of people in a very reasonable fee structure. Thousands of students have already trained professionally and made their successful career in the past years. Over the past few years the growth of the computer industry has been quite remarkable and today it is the fastest growing industry, Not just the students or housewives, even experienced professional are helped greatly by upgrading themselves in The GenInfotech Computer Education centre. Our organization not only provides the platform to build up the bright professional career in computer field but also provids the placement opportunities in reputed companies. As Computer knowledge has become primary requirement for everyone. Our Institute provides best Quality Computer Education in most reasonable fee structure to all class of people. Our motive is to make all class of people Computer literate and take all possible advantages to make their future much brighter. </div></p>
           
     <div id="wowslider-container1">
	<div class="ws_images"><ul>
		<li><img src="data1/images/p11.jpg" alt="p11" title="p11" id="wows1_0"/></li>
		<li><img src="data1/images/p1.jpg" alt="p1" title="p1" id="wows1_1"/></li>
		<li><img src="data1/images/p2.jpg" alt="p2" title="p2" id="wows1_2"/></li>
		<li><img src="data1/images/p3.jpg" alt="p3" title="p3" id="wows1_3"/></li>
		<li><img src="data1/images/p4.jpg" alt="p4" title="p4" id="wows1_4"/></li>
		<li><img src="data1/images/images_2.jpg" alt="images (2)" title="images (2)" id="wows1_5"/></li>
		<li><img src="data1/images/p5.jpg" alt="p5" title="p5" id="wows1_6"/></li>
		<li><img src="data1/images/p6.png" alt="p6" title="p6" id="wows1_7"/></li>
		<li><img src="data1/images/p9.jpg" alt="p9" title="p9" id="wows1_8"/></li>
		<li><img src="data1/images/p12.jpg" alt="p12" title="p12" id="wows1_9"/></li>
		<li><img src="data1/images/p13.jpg" alt="p13" title="p13" id="wows1_10"/></li>
		<li><img src="data1/images/p14.jpg" alt="p14" title="p14" id="wows1_11"/></li>
		<li><img src="data1/images/p15.jpg" alt="p15" title="p15" id="wows1_12"/></li>
		<li><img src="data1/images/images_4.jpg" alt="images (4)" title="images (4)" id="wows1_13"/></li>
		<li><img src="data1/images/collegestudents.jpg" alt="College-Students" title="College-Students" id="wows1_14"/></li>
		<li><img src="data1/images/p16.jpg" alt="p16" title="p16" id="wows1_15"/></li>
		<li><img src="data1/images/p17.jpg" alt="p17" title="p17" id="wows1_16"/></li>
		<li><img src="data1/images/images_5.jpg" alt="images (5)" title="images (5)" id="wows1_17"/></li>
		<li><img src="data1/images/images_8.jpg" alt="images (8)" title="images (8)" id="wows1_18"/></li>
		<li><a href="http://wowslider.com/vf"><img src="data1/images/dsc00943.jpg" alt="full screen slider" title="DSC00943" id="wows1_19"/></a></li>
		<li><img src="data1/images/20140827_101810.jpg" alt="20140827_101810" title="20140827_101810" id="wows1_20"/></li>
	</ul></div>
<span class="wsl"><a href="http://wowslider.com/vu">image carousel</a> by WOWSlider.com v6.9</span>
	<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
    </div>
       
           
           
    </div>
   
       
   
     
     
     
     
     <div id="content3">
      <div id="latest">
       <p id="head1">
    Latest News
    </p>
    <p id="para1">
   <marquee behavior="scroll" direction="up" scrollamount="2" scrolldelay="10" onMouseOver="this.stop()" onMouseOut="this.start()">
            Results Realeased<br /><br />
            Certificates Released<br /><br />
            Exams Announced<br /><br />
            Holidays<br /><br />
            </marquee>
     </p>
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
