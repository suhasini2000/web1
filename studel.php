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
require_once "db.php";

$regdno1=mysql_real_escape_string($_POST['rno']);

$sql="select * from stu_reg where regdno='$regdno1'";



$result=mysql_query($sql);

?>
<form action="delstu.php" method="post">
<table>


<?php
		while($row=mysql_fetch_array($result))
			{?>
          <tr>
          <td>  
            <input type="text" name="regdno" value="<?php echo $row[0];?>" />
           </td>
           <td> 
			<input type="text" name="sirname" value="<?php echo $row[1];?>" />
            </td>
            <td>
            <input type="text" name="name" value="<?php echo $row[2];?>" />
            </td><td>
            <input type="text" name="fname"value="<?php echo $row[3];?>" />
            </td><td>
            <input type="text" name="hno" value="<?php echo $row[4];?>" />
            </td><td>
            <input type="text" name="area" value="<?php echo $row[5];?>" />
            </td></tr><tr><td>
            <input type="text" name="town" value="<?php echo $row[6];?>" />
            </td><td>
            <input type="text" name="cellno" value="<?php echo $row[7];?>" />
            </td><td>
            <input type="text" name="mailid" value="<?php echo $row[8];?>" />
            </td><td>
            <input type="text" name="reference" value="<?php echo $row[9];?>" />
            </td></tr><tr><td>
            <input type="text" name="qual" value="<?php echo $row[10];?>" />
            </td><td>
            <input type="text" name="course" value="<?php echo $row[11];?>" />
            </td><td>
            <input type="text" name="duration" value="<?php echo $row[12];?>" />
            </td><td>
            <input type="text" name="jdate" value="<?php echo $row[13];?>" />
            </td></tr><tr><td>
            <input type="text" name="status" value="<?php echo $row[14];?>" />
           <input type="submit" value="Submit" />
           </td></tr>
		<?php	 }
			


 ?>
  
 </form>
</body>
</html>
