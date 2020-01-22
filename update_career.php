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
$AcademicTableName = "academics";
$CareerTableName = "career";
$RegisterTableName = "register";
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
//$loginErr="";

session_start();
if (!isset($_SESSION['EmailId']))
	header('Location: login.php');
//unset($_SESSION['EmailId']);
//echo "stage2";
//session_destroy();
$mysql_qry = "select * from $RegisterTableName where Email like '$_SESSION[EmailId]';";
$result = mysqli_query($conn, $mysql_qry);
if (mysqli_num_rows($result) > 0) {
	while ($row = $result->fetch_assoc()) {
		$UserId = $row["UserId"];
	}
}
$FirstUpdate = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//if(isset($_POST['Register']))	{
	//if($_POST["name"]!=""){
	//echo "Post is selected after form submission";
	$mysql_qry = "select * from $CareerTableName where UserId like $UserId;";
	$result = mysqli_query($conn, $mysql_qry);
	//echo $result;
	//if(mysqli_num_rows($result)>0){
	$date = date_create();
	$date_time_stamp = date_timestamp_get($date);
	$target_dir = "ResumeCv/";
	if (isset($_FILES["ResumeCv"]))
		$FirstUpdate = 0;
	$target_Resume = $target_dir . $UserId . $date_time_stamp . $_FILES["ResumeCv"]["name"];
	$target_Resume = preg_replace("/[^a-zA-Z0-9\/\.]+/", "", $target_Resume);
	if (move_uploaded_file($_FILES["ResumeCv"]["tmp_name"], $target_Resume)) {
		echo "The file " . basename($_FILES["ResumeCv"]["name"]) . " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
	if (mysqli_num_rows($result) > 0) {
		//echo "Id is registered, please login";
		//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
		$mysql_qry = "UPDATE $CareerTableName SET 
		Introduction='$_POST[Introduction]',
		MinimumPackage='$_POST[MinimumPackage]',
		PreferredLocation='$_POST[PreferredLocation]',
		PreferredCompany='$_POST[PreferredCompany]',
		JoiningTimeInMonth='$_POST[JoiningTimeInMonth]',
		SkillSet='$_POST[SkillSet]',
		NumberOfYearsExperience='$_POST[NumberOfYearsExperience]',
		LinkedInId='$_POST[LinkedInId]',
		ResumeCv=? 
		WHERE UserId=$UserId;";
		$stmt = $conn->prepare($mysql_qry);
		$stmt->bind_param("s", $target_Resume);
		//VALUES ('$_POST[name]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[gender]');";
		//$mysql_qry ="INSERT INTO register (Name,Email,Password,State,City,PhoneNumber,DateOfRegistration,Gender)	
		//VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]',date(),'$_POST[gender]');";
		//if($conn->query($mysql_qry)){
		if ($stmt->execute()) {
			//echo "Data inserted in to DB";
			header('Location: welcome.php');
		} else {
			echo "DB insertion issue";
		}
	} else {


		$mysql_qry = "INSERT INTO $CareerTableName (UserId,Introduction,MinimumPackage,PreferredLocation,PreferredCompany,JoiningTimeInMonth,
		SkillSet,NumberOfYearsExperience,LinkedInId,ResumeCv)
		VALUES ($UserId,'$_POST[Introduction]', '$_POST[MinimumPackage]', '$_POST[PreferredLocation]', '$_POST[PreferredCompany]',
		'$_POST[JoiningTimeInMonth]', '$_POST[SkillSet]', '$_POST[NumberOfYearsExperience]', '$_POST[LinkedInId]',?);";
		//if($conn->query($mysql_qry)){

		$stmt = $conn->prepare($mysql_qry);
		$stmt->bind_param("s", $target_Resume);
		//echo $stmt;
		if ($stmt->execute()) {
			echo "line 			Data inserted in to DB";
			header('Location: welcome.php');
		} else {
			echo "line line DB insertion issue";
		}
	}
}
//$UserId=0;
$Introduction = "";
$MinimumPackage = 0;
$PreferredLocation = "";
$PreferredCompany = "";
$JoiningTimeInMonth = 0;
$SkillSet = "";
$NumberOfYearsExperience = 0;
$LinkedInId = "";
$ResumeCv = "";

$ResumeCv = "ResumeCv/sorry.pdf";
//echo $UserId;
$mysql_qry = "select * from $CareerTableName where UserId like $UserId;";
$result = mysqli_query($conn, $mysql_qry);
//echo $result;
//if(mysqli_num_rows($result)>0){
if (mysqli_num_rows($result) > 0) {
	while ($row = $result->fetch_assoc()) {
		$UserId = $row["UserId"];
		$Introduction = $row["Introduction"];
		$MinimumPackage = $row["MinimumPackage"];
		$PreferredLocation = $row["PreferredLocation"];
		$PreferredCompany = $row["PreferredCompany"];
		$JoiningTimeInMonth = $row["JoiningTimeInMonth"];
		$SkillSet = $row["SkillSet"];
		$NumberOfYearsExperience = $row["NumberOfYearsExperience"];
		$LinkedInId = $row["LinkedInId"];
		$ResumeCv = $row["ResumeCv"];
		//echo "check";
	}
}


//$MyResume = fopen($ResumeCv, "r");
//echo $ResumeCv;
//echo $MyResume;
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
					Update your career details
				</h1>
				<form method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label for="Introduction">Introduction</label>
						<input type="text" class="form-control" id="Introduction" placeholder="Introduction" name="Introduction" value=<?php echo $Introduction ?>>
					</div>
					<div class="form-group">
						<label for="MinimumPackage">MinimumPackage</label>
						<input type="floatval" class="form-control" id="MinimumPackage" placeholder="MinimumPackage" name="MinimumPackage" value=<?php echo $MinimumPackage ?>>
					</div>
					<div class="form-group">
						<label for="PreferredLocation">PreferredLocation</label>
						<input type="text" class="form-control" id="PreferredLocation" placeholder="PreferredLocation" name="PreferredLocation" value=<?php echo $PreferredLocation ?>>
					</div>
					<div class="form-group">
						<label for="PreferredCompany">PreferredCompany</label>
						<input type="text" class="form-control" id="PreferredCompany" placeholder="PreferredCompany" name="PreferredCompany" value=<?php echo $PreferredCompany ?>>
					</div>
					<div class="form-group">
						<label for="JoiningTimeInMonth">JoiningTimeInMonth</label>
						<input type="number" class="form-control" id="JoiningTimeInMonth" placeholder="JoiningTimeInMonth" name="JoiningTimeInMonth" value=<?php echo $JoiningTimeInMonth ?>>
					</div>
					<div class="form-group">
						<label for="SkillSet">SkillSet</label>
						<input type="text" class="form-control" id="SkillSet" placeholder="SkillSet" name="SkillSet" value=<?php echo $SkillSet ?>>
					</div>
					<div class="form-group">
						<label for="NumberOfYearsExperience">NumberOfYearsExperience</label>
						<input type="floatval" class="form-control" id="NumberOfYearsExperience" placeholder="NumberOfYearsExperience" name="NumberOfYearsExperience" value=<?php echo $NumberOfYearsExperience ?>>
					</div>
					<div class="form-group">
						<label for="LinkedInId">LinkedInId</label>
						<input type="text" class="form-control" id="LinkedInId" placeholder="LinkedInId" name="LinkedInId" value=<?php echo $LinkedInId ?>>
					</div>
					<div class="form-group">
						Upload Resume/CV: <input type="file" name="ResumeCv">
						<br><br>

						<?php if ($FirstUpdate == 0) ?>
						<a href=<?php echo $ResumeCv ?> download="Resume">Last uploaded Resume</a>

					</div>
					<input type="submit" class="like" value="Update"><?php ?>

					<br><br>


				</form>
			</div>
		</div>

	</div>
</body>

</html>