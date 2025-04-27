<html>
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

<?php
require_once "db.php"; // Include your database connection

// Fetching registered students with status 'Y'
$sql3 = "SELECT regdno FROM stu_reg WHERE status='Y'";
$res3 = mysqli_query($mysqli, $sql3);

// Fetching courses
$sqlCourses = "SELECT course FROM stu_course";
$resCourses = mysqli_query($mysqli, $sqlCourses);
?>

<body>
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
            <div style="margin-top:20px;"> 
                <form action="addmarks.php" method="post">
                    <table width="800" style="border:dashed #0000CC; font-size:22px; font-weight:bold; padding-left:10px; height:300px;">
                        <tr>
                            <td>Regd No</td>
                            <td>
                                <select name="rno">
                                    <?php  
                                    while ($row = mysqli_fetch_array($res3)) {
                                        echo "<option value='" . $row['regdno'] . "'>" . $row['regdno'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Course</td>
                            <td>
                                <select name="course">
                                    <?php
                                    while ($courseRow = mysqli_fetch_array($resCourses)) {
                                        echo "<option value='" . $courseRow['course'] . "'>" . $courseRow['course'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>Examination Subject</td>
                            <td>
                                <select name="subject">
                                    <option>C</option>
                                    <option>C++</option>
                                    <option>JAVA</option>
                                    <option>CORE JAVA</option>
                                    <option>Adv. JAVA</option>
                                    <option>J2EE</option>
                                    <option>DotNet</option>
                                    <option>Sql</option>
                                    <option>PHP</option>
                                    <option>MSOFFICE</option>
                                    <option>AutoCad</option>
                                    <option>Photoshop</option>
                                    <option>Page Maker</option>
                                    <option>Tally</option>
                                    <option>UNIX</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Exam Date</td>
                            <td>
                                <input id="demo1" name="exam_date" type="date" size="10" style="color:#000000; font-size:18px">
                            </td>
                            <td>Marks</td>
                            <td><input type="text" name="marks" size="20" /></td>
                        </tr>
                        <tr>
                            <td>Grade Alloted</td>
                            <td><input type="text" name="grade" size="20" /></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" value="Submit" size="20" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div id="footer">
        <table width="1100px" style="color:#FFFFFF;">
            <tr>
                <td><br>Copyright &copy; 2014 GenInfoTech, Tanuku. <br><br>All Rights Reserved</td>
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
