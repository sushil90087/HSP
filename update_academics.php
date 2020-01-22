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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//if(isset($_POST['Register']))	{
	//if($_POST["name"]!=""){
	//echo "Post is selected after form submission";
	$mysql_qry = "select * from $AcademicTableName where UserId like $UserId;";
	$result = mysqli_query($conn, $mysql_qry);
	//echo $result;
	//if(mysqli_num_rows($result)>0){
	if (mysqli_num_rows($result) > 0) {
		//echo "Id is registered, please login";
		//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
		$mysql_qry = "UPDATE $AcademicTableName SET Class10Board='$_POST[Class10Board]', 
		Class10Percentage='$_POST[Class10Percentage]', 
		Class12Board='$_POST[Class12Board]',
		Class12Percentage='$_POST[Class12Percentage]', 
		College='$_POST[College]',
		Stream='$_POST[Stream]',
		CGPA='$_POST[CGPA]',
		CurrentOrganisation='$_POST[CurrentOrganisation]',
		CurrentCity='$_POST[CurrentCity]'
					WHERE UserId=$UserId;";
		//VALUES ('$_POST[name]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[gender]');";
		//$mysql_qry ="INSERT INTO register (Name,Email,Password,State,City,PhoneNumber,DateOfRegistration,Gender)	
		//VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]',date(),'$_POST[gender]');";
		if ($conn->query($mysql_qry)) {
			//echo "Data inserted in to DB";
			header('Location: welcome.php');
		} else {
			//echo"DB insertion issue";
		}
	} else {
		$mysql_qry = "INSERT INTO $AcademicTableName (UserId,Class10Board,Class10Percentage,Class12Board,
		Class12Percentage,College,Stream,CGPA,CurrentOrganisation,CurrentCity)
		VALUES ($UserId, '$_POST[Class10Board]', '$_POST[Class10Percentage]', '$_POST[Class12Board]', '$_POST[Class12Percentage]',
		 '$_POST[College]', '$_POST[Stream]', '$_POST[CGPA]', '$_POST[CurrentOrganisation]', '$_POST[CurrentOrganisation]');";
		if ($conn->query($mysql_qry)) {
			//echo "line 			Data inserted in to DB";
			header('Location: welcome.php');
		} else {
			//echo"line line DB insertion issue";
		}
	}
}
//$UserId=0;
$Class10Board = "";
$Class12Board = "";
$Class10Percentage = 0;
$Class12Percentage = 0;
$College = "";
$Stream = "";
$CGPA = 0;
$CurrentOrganisation = "";
$CurrentCity = "";


//echo $UserId;
$mysql_qry = "select * from $AcademicTableName where UserId like $UserId;";
$result = mysqli_query($conn, $mysql_qry);
//echo $result;
//if(mysqli_num_rows($result)>0){
if (mysqli_num_rows($result) > 0) {
	while ($row = $result->fetch_assoc()) {
		$UserId = $row["UserId"];
		//$Class10Board=$row["Class10Board"];
		$Class10Board = $row["Class10Board"];
		$Class12Board = $row["Class12Board"];
		$Class10Percentage = $row["Class10Percentage"];
		$Class12Percentage = $row["Class12Percentage"];
		$College = $row["College"];
		$Stream = $row["Stream"];
		$CGPA = $row["CGPA"];
		$CurrentOrganisation = $row["CurrentOrganisation"];
		$CurrentCity = $row["CurrentCity"];
		//echo "check";
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
					Update your academics
				</h1>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<br><br>
					<div class="form-group">
						<label for="Class10Board">Class10Board</label>
						<input type="text" class="form-control" id="Class10Board" placeholder="Enter class 10 board name" name="Class10Board" value=<?php echo $Class10Board ?>>
					</div>
					<div class="form-group">
						<label for="Class10Percentage">Class10Percentage</label>
						<input type="float" class="form-control" id="Class10Percentage" placeholder="Enter class 10 board percentage" name="Class10Percentage" value=<?php echo $Class10Percentage ?>>
					</div>
					<div class="form-group">
						<label for="Class12Board">Class12Board</label>
						<input type="text" class="form-control" id="Class12Board" placeholder="Enter class 12 board name" name="Class12Board" value=<?php echo $Class12Board ?>>
					</div>
					<div class="form-group">
						<label for="Class12Percentage">Class12Percentage</label>
						<input type="float" class="form-control" id="Class12Percentage" placeholder="Enter class 12 board percentage" name="Class12Percentage" value=<?php echo $Class12Percentage ?>>
					</div>

					<div class="form-group">
						<label for="College">College</label>
						<input type="text" class="form-control" id="College" placeholder="College" name="College" value=<?php echo $College ?>>

						<div class="form-group">
							<label for="Stream">Stream</label>
							<input type="text" class="form-control" id="Stream" placeholder="Stream" name="Stream" value=<?php echo $Stream ?>>

							<div class="form-group">
								<label for="CGPA">CGPA</label>
								<input type="float" class="form-control" id="CGPA" placeholder="CGPA" name="CGPA" value=<?php echo $CGPA ?>>
							</div>


							<div class="form-group">
								<label for="CurrentOrganisation">CurrentOrganisation</label>
								<input type="text" class="form-control" id="CurrentOrganisation" placeholder="CurrentOrganisation" name="CurrentOrganisation" value=<?php echo $CurrentOrganisation ?>>

								<div class="form-group">
									<label for="CurrentCity">CurrentCity</label>
									<input type="text" class="form-control" id="CurrentCity" placeholder="CurrentCity" name="CurrentCity" value=<?php echo $CurrentCity ?>>
									<br><br>


									<input type="submit" class="like" value="Update"><?php ?>
									<br><br>
				</form>
			</div>
		</div>

	</div>
</body>

</html>