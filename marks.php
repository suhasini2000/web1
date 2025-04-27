<?php
require_once "db.php"; // Assuming your db.php contains the mysqli connection setup

$regno = mysqli_real_escape_string($mysqli, $_POST['regdno']); // Using mysqli_real_escape_string
$sql = "SELECT * FROM marks WHERE regdno = '$regno'";

$res = mysqli_query($mysqli, $sql);

if (!$res) {
    echo "Error: " . mysqli_error($mysqli); // Debugging query errors
}
?>

<div style="height:200px; width:1100px; margin-left:50px;">
    <div id="header"></div>
   
    <div id="content" style="height:500px;">
        <div id="space"></div>
        <div align="center">
            <script language="JavaScript">
            if (window.print) {
                document.write(
                '<form><input type="button" name="print" value="Print" style=" font-size:18px; cursor:pointer;  color:#000099;" onClick="window.print()"></form>'
                );
            }
            </script>
        </div>
        <table width="800" border="0" style="margin-top:50px; cursor:help;" align="center">
            <tr style="background-color:#FFFFFF; color:#0000FF; font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif;">
                <th>Regd No</th><th>Course</th><th>Subject</th><th>Exam Date</th><th>Marks</th><th>Grade</th><th>Certificate Issued</th>
            </tr>

            <?php
            if ($res) {
                while ($row = mysqli_fetch_array($res)) { ?>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $row['regdno']; ?>" size="15" readonly="readonly" />
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row['course']; ?>" size="15" readonly="readonly" />
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row['subject']; ?>" size="15" readonly="readonly"/>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row['exam_date']; ?>" size="15" readonly="readonly"/>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row['marks']; ?>" size="15" readonly="readonly"/>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row['grade']; ?>" size="15" readonly="readonly"/>
                        </td>
                        <td>
                            <input type="text" value="<?php echo isset($row['cer_gene']) ? $row['cer_gene'] : 'N/A'; ?>" size="15" readonly="readonly"/>
                        </td>
                    </tr>
                <?php }
            }
            ?>
        </table>  
        <div align="center" style="margin-top:20px;">
            <a href="student_choice.php" style="font-size:16px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; text-decoration:none; background-color:#000099; border-radius:25px;">&nbsp;&nbsp; Back &nbsp;&nbsp;</a>
        </div>
    </div> 
</div>
</body>
</html>
