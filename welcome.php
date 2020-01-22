<!DOCTYPE html>
<html lang="en">

<head>
  <title>Job - Trade</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/page_setting.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</head>
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
if (isset($_SESSION['EmailId'])) {

  //echo "Welcome   ".$_SESSION['EmailId'];
} else
  header('Location: login.php');
//unset($_SESSION['EmailId']);
//session_destroy()


?>

<body>
  <div class="body">
    <div class="top-link" style="background-color:#10383f; color:black;">
      <ul class="nav justify-content-end">
        <li class="nav-item"><a class="nav-link active" href="logoff.php">Sign Off</a></li>
        <li class="nav-item"><a class="nav-link active" href="welcome.php"><?php echo $_SESSION['EmailId'] ?></a></li>
        <li class="nav-item"><a class="nav-link active" href="update_details.php">Update Details</a></li>
        <li class="nav-item"><a class="nav-link active" href="update_academics.php">Academic Details Update</a></li>
        <li class="nav-item"><a class="nav-link active" href="update_career.php">Professional Details Update</a></li>
        <li class="nav-item"><a class="nav-link active" href="job_post.php">Post a job</a></li>
        <li class="nav-item"><a class="nav-link active" href="list_posted_job.php">Posted Job History</a></li>
        <li class="nav-item"><a class="nav-link active" href="search_job.php">Search Job</a></li>
        <li class="nav-item"><a class="nav-link active" href="list_applied_job.php">Applied Jobs history</a></li>

      </ul>

    </div>
    <div class="row">
      <div class="col-sm-2">
        <div>
        </div>
      </div>
      <div class="col-sm-8">
        <h1>
          About Us
        </h1>
        <p>
          We provide solution to job seeker to apply jobs in market according skill set and recruiter to hire candidates as per requirement.
        </p>

        <h1> Contact us for any query and feedback</h1>
        <h5>
          +91-9008793798</br>
          sps90087@gmail.com
        </h5>
        <h9>we just provide platform, we are not responsible for any misconduct during whole process.</h9>
      </div>
    </div>

  </div>
</body>

</html>
</br>
<!--
<a href="update_details.php">update profile</a> </br>
<a href="logoff.php">sign off</a> </br>
<a href="update_academics.php">update academics</a> </br>
<a href="update_career.php">update career Details</a> </br>
<a href="job_post.php">Post a job</a> </br>
<a href="list_posted_job.php">List Posted jobs</a> </br>
<a href="search_job.php">search jobs</a> </br>
<a href="list_applied_job.php">List Applied jobs</a> </br>
-->