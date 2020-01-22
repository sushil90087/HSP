<!DOCTYPE html>
<html lang="en">

<head>
	<title>Job - Trade Registraion</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/page_setting.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</head>
<?php
require "connect.php";
$RegisterTableName = "register";
$JobsTableName = "jobs";
$CareerTableName = "career";
$JobAppliedTableName = "jobapplied";
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
?>
<?php

session_start();
if (!isset($_SESSION['EmailId']))
	header('Location: login.php');
?>
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
	<div class="row" style="background-color:#71cbdb;">
		<div class="col-sm-2">
			<div>
			</div>
		</div>
		<div class="col-sm-8">
			<h1>
				Applied Job History
			</h1>
			<?php


			//if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//if(isset($_POST['Register']))	{
			//if($_POST["name"]!=""){
			//echo "Post is selected after form submission";
			$mysql_qry = "select * from $RegisterTableName where Email like '$_SESSION[EmailId]';";
			$result = mysqli_query($conn, $mysql_qry);
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc()) {
					$UserId = $row["UserId"];
				}
			}
			$mysql_qry = "select * from $JobAppliedTableName where JobSeekerId like $UserId;";
			$resultJobId = mysqli_query($conn, $mysql_qry);
			if (mysqli_num_rows($result) > 0) {

				while ($row = $resultJobId->fetch_assoc()) {
					$JobId = $row["JobId"];
					$MatchStatus = $row["MatchStatus"];
					echo "<br>" . "<br>" . "Job id = " . $JobId . "<br>" . "MatchStatus is = " . $MatchStatus . "<br>" . "<br>";
			?>
					<div class="one-block-data" style="border-style: solid;display:block">
						<?php

						//echo "check point 1";
						$mysql_qry = "select * from $JobsTableName where JobId like $JobId;";
						$result = mysqli_query($conn, $mysql_qry);
						if (mysqli_num_rows($result) > 0) {
							//echo "checking 2";
							while ($row = $result->fetch_assoc()) {
								echo "JobIntroduction : " . $row["JobIntroduction"] . "<br>";
								echo "JobLocation : " . $row["JobLocation"] . "<br>";
								echo "MinimumExperience : " . $row["MinimumExperience"] . "<br>";
								echo "MaximumExperience : " . $row["MaximumExperience"] . "<br>";
								echo "JoiningTimeInMonths : " . $row["JoiningTimeInMonths"] . "<br>";
								echo "Company : " . $row["Company"] . "<br>";
								echo "SkillSet : " . $row["SkillSet"] . "<br>";
								echo "GenderSpecific : " . $row["GenderSpecific"] . "<br>";
								echo "PreferredCompany : " . $row["PreferredCompany"] . "<br>";
								echo "MinimumPackage : " . $row["MinimumPackage"] . "<br>";
								echo "MaximumPackage : " . $row["MaximumPackage"] . "<br>";
								echo "NumberOfVacancy : " . $row["NumberOfVacancy"] . "<br>";


						?>
								<a href=<?php echo $row["Jd"] ?> download="JD">JD details</a>
						<?php
								echo "<br>";
							}
						}
						?>
					</div>
			<?php
				}
			}
			//}

			?>

		</div>
		</body>

</html>