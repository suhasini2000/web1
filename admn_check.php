<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GenInfotech</title>
<link type="text/css" href="css/style.css" rel="stylesheet"/>
<script src="js/jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
<script src="css/vallenato.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/vallenato.css" type="text/css" media="screen" charset="utf-8">
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
require_once "db.php";

session_start();
$_SESSION['reg']=$_POST['usr'];

$usrname=mysql_real_escape_string($_POST['usr']);
$password=mysql_real_escape_string($_POST['pwd']);

/*
$sql="select * from log  where usr='$usrname' and pwd='$password'";
$res=mysql_query($sql);
$sql1="select regdno from stu_reg where status='Y'";
$res1=mysql_query($sql1);
$sql2="select regdno from stu_reg where status='Y'";
$res2=mysql_query($sql2);
$sql3="select regdno from marks where cer_gene='N'";
$res3=mysql_query($sql3);
$sql4="select subject from marks where cer_gene='N'";
$res4=mysql_query($sql4);
*/
if($usrname=='admin' && $password=='admin')
{
 header("location:admin_process.php");
}
?>

