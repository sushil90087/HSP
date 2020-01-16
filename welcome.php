<?php
require "connect.php";
//$user_name = "user_name_1";
//$user_pass ="user_pass_1";
//$mysql_qry ="select * from employee_data where user_name like '$user_name' and password like '$user_pass';";
//$result = mysqli_query($conn , $mysql_qry);
//if(mysqli_num_rows($result)>0){
//	echo "login test done";
//}
//else {
//	echo "login test not sucess";
//}
//echo "You are logged-in successfully";
session_start();
	//$_SESSION['EmailId']=$_POST['EmailId'];
	//echo $_SESSION['EmailId'];
//session_start();
if(isset($_SESSION['EmailId']))
	echo "Welcome   ".$_SESSION['EmailId'];
else
	header ('Location: login.php');
//unset($_SESSION['EmailId']);
//session_destroy()


?>
</br>
<a href="update_details.php">update profile</a> </br>
<a href="logoff.php">sign off</a> </br>
<a href="update_academics.php">update academics</a> </br>
<a href="update_career.php">update career Details</a> </br>
<a href="job_post.php">Post a job</a> </br>
<a href="list_posted_job.php">List Posted jobs</a> </br>
<a href="search_job.php">search jobs</a> </br>
<a href="list_applied_job.php">List Applied jobs</a> </br>

