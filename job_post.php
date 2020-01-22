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
$JobsTableName = "jobs"
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
	$date = date_create();
	$date_time_stamp = date_timestamp_get($date);
	$target_dir = "Jd/";
	$target_file = $target_dir . $UserId . $date_time_stamp . $_FILES["Jd"]["name"];
	$target_file = preg_replace("/[^a-zA-Z0-9\/\.]+/", "", $target_file);
	//$target_file = $target_dir . $_FILES["Filetoupload"]["name"];	
	echo "Your Jd stored name is : " . $target_file;
	//echo basename($_FILES["Jd"]["name"]);
	//echo "target file is ".$target_file;
	//print_r($_FILES["Jd"]);
	//echo "target temp file is ".$tmp_name;
	//echo basename($_FILES["Filetoupload"]["temp_name"]);
	//echo $_FILES[];
	//echo "tmp_name is ".$_FILES["Filetoupload"]["tmp_name"];
	if (move_uploaded_file($_FILES["Jd"]["tmp_name"], $target_file)) {
		echo "The file " . basename($_FILES["Jd"]["name"]) . " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
	//$target_file='Jd123441text';
	//$target_file=strval($target_dir);
	//$target_JobIntroduction=$_POST["JobIntroduction"];
	$mysql_qry = "INSERT INTO $JobsTableName (JobPosterId,JobIntroduction,JobLocation,MinimumExperience,MaximumExperience,JoiningTimeInMonths,
	Company,SkillSet,GenderSpecific,PreferredCompany,MinimumPackage,MaximumPackage,NumberOfVacancy,Jd) 
	VALUES ($UserId,'$_POST[JobIntroduction]','$_POST[JobLocation]','$_POST[MinimumExperience]','$_POST[MaximumExperience]','$_POST[JoiningTimeInMonths]',
	'$_POST[Company]','$_POST[SkillSet]','$_POST[GenderSpecific]','$_POST[PreferredCompany]','$_POST[MinimumPackage]','$_POST[MaximumPackage]','$_POST[NumberOfVacancy]',
	?);";
	$stmt = $conn->prepare($mysql_qry);
	$stmt->bind_param("s", $target_file);
	//if($conn->query($mysql_qry)){
	if ($stmt->execute()) {
		echo "Data inserted in to DB";
		header('Location: welcome.php');
	} else {
		echo "DB insertion issue";
	}
}

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
		<div class="row" style="background-color:#71cbdb;">
			<div class="col-sm-2">
				<div>
				</div>
			</div>
			<div class="col-sm-8">
				<h1>
					Post a job
				</h1>
				<form method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label for="Introduction">Introduction</label>
						<input type="text" class="form-control" id="Introduction" placeholder="Introduction" name="Introduction">
					</div>
					<div class="form-group">
						<label for="JobLocation">JobLocation</label>
						<input type="text" class="form-control" id="JobLocation" placeholder="JobLocation" name="JobLocation">
					</div>
					<div class="form-group">
						<label for="MinimumExperience">MinimumExperience</label>
						<input type="floatval" class="form-control" id="MinimumExperience" placeholder="MinimumExperience" name="MinimumExperience">
					</div>
					<div class="form-group">
						<label for="MaximumExperience">MaximumExperience</label>
						<input type="floatval" class="form-control" id="MaximumExperience" placeholder="MaximumExperience" name="MaximumExperience">
					</div>
					<div class="form-group">
						<label for="JoiningTimeInMonths">JoiningTimeInMonths</label>
						<input type="number" class="form-control" id="JoiningTimeInMonths" placeholder="JoiningTimeInMonths" name="JoiningTimeInMonths">
					</div>
					<div class="form-group">
						<label for="Company">Company</label>
						<input type="text" class="form-control" id="Company" placeholder="Company" name="Company">
					</div>
					<div class="form-group">
						<label for="SkillSet">SkillSet</label>
						<input type="text" class="form-control" id="SkillSet" placeholder="SkillSet" name="SkillSet">
					</div>
					<div class="form-group">
						<label for="GenderSpecific">GenderSpecific</label>
						<input type="text" class="form-control" id="GenderSpecific" placeholder="GenderSpecific" name="GenderSpecific">
					</div>
					<div class="form-group">
						<label for="PreferredCompany">PreferredCompany</label>
						<input type="text" class="form-control" id="PreferredCompany" placeholder="PreferredCompany" name="PreferredCompany">
					</div>
					<div class="form-group">
						<label for="MinimumPackage">MinimumPackage</label>
						<input type="floatval" class="form-control" id="MinimumPackage" placeholder="MinimumPackage" name="MinimumPackage">
					</div>
					<div class="form-group">
						<label for="MaximumPackage">MaximumPackage</label>
						<input type="floatval" class="form-control" id="MaximumPackage" placeholder="MaximumPackage" name="MaximumPackage">
					</div>
					<div class="form-group">
						<label for="NumberOfVacancy">NumberOfVacancy</label>
						<input type="number" class="form-control" id="NumberOfVacancy" placeholder="NumberOfVacancy" name="NumberOfVacancy">
					</div>
					<div class="form-group">
						Upload Jd: <input type="file" name="Jd">
						<br><br>
					</div>

					<input type="submit" class="like" value="Submit Job"><?php ?>
					<br><br>


				</form>
			</div>
		</div>

	</div>
</body>

</html>