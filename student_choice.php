<?php
session_start();
require 'db.php';

if (empty($_SESSION['reg'])) {
    header("Location: index.php?error=session_expired");
    exit();
}

$reg = $_SESSION['reg'];

$sql = "SELECT * FROM stu_reg WHERE regdno = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $reg);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No student data found for registration number: " . htmlspecialchars($reg);
    exit();
}
$student = $result->fetch_object();
$names = htmlspecialchars($student->name) . " " . htmlspecialchars($student->sirname);

$sql = "SELECT * FROM stu_course WHERE regno = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $reg);
$stmt->execute();
$courses_result = $stmt->get_result();

if ($courses_result->num_rows === 0) {
    echo "No courses found for registration number: " . htmlspecialchars($reg);
    exit();
}

$course = $courses_result->fetch_object();
$materials = [];
$opt = $course->course;
$sub = $course->subject;
$sub1 = $course->subject1;
$sub2 = $course->subject2;
$sub3 = $course->subject3;
$sub4 = $course->subject4;

if ($opt === 'PGDCA') {
    $materials = [
        htmlspecialchars($sub) => "materials/pgdca_subject.pdf",
        htmlspecialchars($sub1) => "materials/pgdca_subject1.pdf",
        htmlspecialchars($sub2) => "materials/pgdca_subject2.pdf",
        htmlspecialchars($sub3) => "materials/pgdca_subject3.pdf",
        htmlspecialchars($sub4) => "materials/pgdca_subject4.pdf",
    ];
} elseif ($opt === 'DCA') {
    $materials = [
        htmlspecialchars($sub) => "materials/dca_subject1.pdf",
        htmlspecialchars($sub1) => "materials/dca_subject2.pdf",
        htmlspecialchars($sub2) => "materials/dca_subject3.pdf",
        htmlspecialchars($sub3) => "materials/dca_subject4.pdf",
    ];
} elseif ($opt === 'MSOFFICE') {
    $materials = [
        htmlspecialchars($sub) => "materials/msoffice_practice.pdf",
    ];
} elseif ($opt === 'SQL') {
    $materials = [
        'Create and Alter Commands' => "materials/SQL/CREATE_ALTER_INSERT.pdf",
        'CONSTRAINTS' => "materials/SQL/CONSTRAINTS.pdf",
        'Indexing and Views' => "materials/SQL/INDEXING_VIEWS.pdf",
        'Transactions and Triggers' => "materials/SQL/TRANSACTIONS_TRIGGERS.pdf"
    ];
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Choice</title>
    <link type="text/css" href="css/style.css" rel="stylesheet"/>
</head>
<body>
    <div id="main">
        <div id="header">
            <!-- Header Content -->
        </div>

        <div id="content">
            <div style="margin-left:650px; padding-top:30px;">
                <input type="text" value="&nbsp; Welcome ! <?php echo $names; ?>" 
                style="font-size:24px; color:#FFFFFF; text-transform:capitalize; background-color:#0000FF; border:none;" 
                readonly="readonly" size="25" />
            </div>

            <div id="content1">
                <div id="menu" style="margin-left:-30px;">
                    <ul class="navi">
                        <li><a href="index.php"><img src="images/arrow.png" />Home</a></li>
                        <li><a href="aboutus.php"><img src="images/arrow.png" />About Us</a></li>
                        <li><a href="courses.php"><img src="images/arrow.png" />Courses</a></li>
                        <li><a href="gallery.php"><img src="images/arrow.png" />Gallery</a></li>
                        <li><a href="contactus.php"><img src="images/arrow.png" />Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div id="content2">
                <form action="marks.php" method="post">
                    <div id="adm_log" style="margin-left:200px; margin-top:50px; width:200px;">
                        <h2 class="accordion-header" style="color:#FFF; background-color:#353030; border-color:#0000CC;" align="center">
                            Material
                        </h2>
                        <div class="accordion-content">
                            <?php 
                            if (!empty($materials)) {
                                echo '<table width="200" border="1">';
                                foreach ($materials as $subject => $link) {
                                    echo '<tr><td>' . $subject . ' <a href="' . $link . '">Download Material</a></td></tr>';
                                }
                                echo '</table>';
                            } else {
                                echo "<p>No materials available for this course.</p>";
                            }
                            ?>
                        </div>

                        <h2 class="accordion-header" style="color:#FFF; background-color:#353030; border-color:#0000CC;" align="center">
                            Marks
                        </h2>
                        <div class="accordion-content">
                            <table width="200" border="1">
                                <tr><td>Enter Regd No</td></tr>
                                <tr><td><input type="text" name="regdno" value="<?php echo htmlspecialchars($_SESSION['reg']); ?>" readonly="readonly" /></td></tr>
                                <tr><td><input type="submit" value="Submit" id="submit" /></td></tr>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="footer"></div>
    </div>
</body>
</html>
