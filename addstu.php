<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>GenInfotech</title>
    <link type="text/css" href="style.css" rel="stylesheet"/>
    <script src="js/jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="css/vallenato.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="css/vallenato.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="css/smoothness/jquery-ui.css">
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script language="javascript" type="text/javascript" src="datetimepicker.js"></script>   
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <style>
        #hlink {
            text-decoration:none;
            font-size:22px;
            color:#000099;
            font-weight:bolder;
            padding-left:20px;
        }
        #cite1 {
            line-height:55px;
            font-style:normal;
        }
    </style>

    <script>
        function updateOptions() {
            var course = document.getElementById("courses").value;
            
            // Hide or show options based on selected course
            if (course == "DCA") {
                document.getElementById("options1").disabled = false;
                document.getElementById("options2").disabled = false;
                document.getElementById("options3").disabled = true;
                document.getElementById("options4").disabled = true;
            } else if (course == "PGDCA") {
                document.getElementById("options1").disabled = false;
                document.getElementById("options2").disabled = false;
                document.getElementById("options3").disabled = false;
                document.getElementById("options4").disabled = false;
            } else {
                // For other courses or no selection, disable all option selects
                document.getElementById("options1").disabled = true;
                document.getElementById("options2").disabled = true;
                document.getElementById("options3").disabled = true;
                document.getElementById("options4").disabled = true;
            }
        }
    </script>
    
    <!-- jQuery and jQuery UI Datepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script>
        $(function() {
            $("#joindate").datepicker({
                dateFormat: 'yy-mm-dd' // Adjust the format if needed
            });
        });
    </script>
</head>

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
                    <form action="stuinsert.php" method="post">
                        <table style="width:800px; height:500px; font-size:22px; border:solid; font-weight:bold; padding-left:30px;">
                            <tr>
                                <td>Regd No</td>
                                <td><input type="text" name="regdno" size="20" /></td>
                            </tr>
                            <tr>
                                <td>SirName</td>
                                <td><input type="text" name="sirname" size="20" style="text-transform:capitalize;" /></td>
                                <td>Student Name</td>
                                <td><input type="text" name="name" size="20" style="text-transform:capitalize;" /></td>
                            </tr>
                            <tr>
                                <td>Father's Name</td>
                                <td><input type="text" name="fname" size="20" style="text-transform:capitalize;"/></td>
                                <td>House No</td>
                                <td><input type="text" name="hno" size="20" />&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Area</td>
                                <td><input type="text" name="area" size="20" style="text-transform:capitalize;" /></td>
                                <td>Town</td>
                                <td><input type="text" name="town" size="20" style="text-transform:capitalize;" /></td>
                            </tr>
                            <tr>
                                <td>Cell No</td>
                                <td><input type="text" name="cellno" size="20" /></td>
                                <td>Mail ID</td>
                                <td><input type="text" name="mailid" size="20" /></td>
                            </tr>
                            <tr>
                                <td>Reference</td>
                                <td>
                                    <select name="reference">
                                        <option>BOARD</option>
                                        <option>FRIEND</option>
                                        <option>STAFF</option>
                                        <option>SELF</option>
                                    </select>
                                </td>
                                <td>Qualification</td>
                                <td>
                                    <select name="qual">
                                        <option>M.C.A</option>
                                        <option>M.B.A</option>
                                        <option>BTech</option>
                                        <option>MTech</option>
                                        <option>Degree</option>
                                        <option>Intermeditate</option>
                                        <option>Politechnique</option>
                                        <option>I.T.I</option>
                                        <option>10th</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Course</td>
                                <td>
                                    <select name="course" id="courses" onchange="updateOptions()">
                                        <option value="">--Select--</option>
                                        <option value="DCA">DCA</option>
                                        <option value="PGDCA">PGDCA</option>
                                        <option value="JAVA">JAVA</option>
                                        <option value="CORE JAVA">CORE JAVA</option>
                                        <option value="Adv. JAVA">Adv. JAVA</option>
                                        <option value="J2EE">J2EE</option>
                                        <option value="DotNet">DotNet</option>
                                        <option value="C">C</option>
                                        <option value="C++">C++</option>
                                        <option value="Sql">Sql</option>
                                        <option value="PHP">PHP</option>
                                        <option value="MSOFFICE">MSOFFICE</option>
                                        <option value="AutoCad">AutoCad</option>
                                        <option value="Photoshop">Photoshop</option>
                                        <option value="Page Maker">Page Maker</option>
                                        <option value="Tally">Tally</option>
                                        <option value="UNIX">UNIX</option>
                                    </select>
                                </td>
                                <td>Duration</td>
                                <td>
                                    <select name="duration">
                                        <option>12 Months</option>
                                        <option>6 Months</option>
                                        <option>4 Months</option>
                                        <option>3 Months</option>
                                        <option>45 Days</option>
                                        <option>30 Days</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Options1</td>
                                <td>
                                    <select name="options1" id="options1" disabled>
                                        <option>AutoCad</option>
                                        <option>C</option>
                                        <option>HTML</option>
                                        <option>Photoshop</option>
                                        <option>Page Maker</option>
                                        <option>Tally</option>
                                    </select>
                                </td>
                                <td>Options2</td>
                                <td>
                                    <select name="options2" id="options2" disabled>
                                        <option>AutoCad</option>
                                        <option>C</option>
                                        <option>HTML</option>
                                        <option>Photoshop</option>
                                        <option>Page Maker</option>
                                        <option>Tally</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Options3</td>
                                <td>
                                    <select name="options3" id="options3" disabled>
                                        <option>Java</option>
                                        <option>DotNet</option>
                                        <option>PHP</option>
                                    </select>
                                </td>
                                <td>Options4</td>
                                <td>
                                    <select name="options4" id="options4" disabled>
                                        <option>Oracle,Sql and Pl/sql</option>
                                        <option>Sql Server</option>
                                        <option>Mysql</option>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                    <td>Join Date</td>
                                    <td>
                                        <input id="joindate" name="joindate" type="text" size="20" style="color:#000000; font-size:18px" required="required">
                                    </td>
                                </tr>

                        
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="submit" value="Submit" style="font-size:18px;" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="admin_process.php" class="btn btn-primary">Back to Admin Panel</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
</body>
</html>
