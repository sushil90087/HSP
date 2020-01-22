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
				Serach a Job
			</h1>
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
			$mysql_qry = "select * from $CareerTableName where UserId like $UserId;";
			$result = mysqli_query($conn, $mysql_qry);
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc()) {
					$UserId = $row["UserId"];
					$UserMinimumPackage = $row["MinimumPackage"];
					$UserNumberOfYearsExperience = $row["NumberOfYearsExperience"];
				}
			}
			//echo "check point 1";
			$mysql_qry = "select * from $JobsTableName;";
			$result = mysqli_query($conn, $mysql_qry);
			echo "Jobs matching as per MinimumPackage  =  " . $UserMinimumPackage . "and NumberOfYearsExperience  =  " . $UserNumberOfYearsExperience;
			if (mysqli_num_rows($result) > 0) {
				//echo "checking 2";
				while ($row = $result->fetch_assoc()) {

			?>
					<div class="one-block-data" style="border-style: solid;display:block">
						<?php
						$JobId = $row["JobId"];
						$mysql_qry = "select * from $JobAppliedTableName where JobId like $JobId and JobSeekerId like $UserId;";
						$AppliedJobResult = mysqli_query($conn, $mysql_qry);
						if (mysqli_num_rows($AppliedJobResult) == 0) {
							if ($UserNumberOfYearsExperience <= $row["MaximumExperience"] && $UserNumberOfYearsExperience >= $row["MinimumExperience"]) {
								if ($UserMinimumPackage < $row["MaximumPackage"]) {
									echo "<br>";
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
									echo "<br>";
									$Jd_link = $row["Jd"];
									//echo $Jd_link;
						?>
									<a href=<?php echo $Jd_link ?> download="JD">Download JD</a>
									<?php
									echo "<br>";
									//$_SESSION['JobId']=$row["JobId"];
									//echo "Job id =".$JobId;
									$apply_job_link = "apply_job.php?id=" . $row["JobId"];
									?> <a href=<?php echo $apply_job_link ?>>Apply for this Job</a> </br><?php
																				echo "<br>";
																				echo "<br>";
																				echo "<br>";
																			}
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