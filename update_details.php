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
$NameErr = "";
$EmailIdErr = "";
$PasswordErr = "";
$PhoneErr = "";
$name = "Name";
$password = "Password";
$state = "State";
$city = "City";
$gender = "Gender";
$indian_all_states  = array(
	'AP' => 'Andhra Pradesh',
	'AR' => 'Arunachal Pradesh',
	'AS' => 'Assam',
	'BR' => 'Bihar',
	'CT' => 'Chhattisgarh',
	'GA' => 'Goa',
	'GJ' => 'Gujarat',
	'HR' => 'Haryana',
	'HP' => 'Himachal Pradesh',
	'JK' => 'Jammu & Kashmir',
	'JH' => 'Jharkhand',
	'KA' => 'Karnataka',
	'KL' => 'Kerala',
	'MP' => 'Madhya Pradesh',
	'MH' => 'Maharashtra',
	'MN' => 'Manipur',
	'ML' => 'Meghalaya',
	'MZ' => 'Mizoram',
	'NL' => 'Nagaland',
	'OR' => 'Odisha',
	'PB' => 'Punjab',
	'RJ' => 'Rajasthan',
	'SK' => 'Sikkim',
	'TN' => 'Tamil Nadu',
	'TR' => 'Tripura',
	'UK' => 'Uttarakhand',
	'UP' => 'Uttar Pradesh',
	'WB' => 'West Bengal',
	'AN' => 'Andaman & Nicobar',
	'CH' => 'Chandigarh',
	'DN' => 'Dadra and Nagar Haveli',
	'DD' => 'Daman & Diu',
	'DL' => 'Delhi',
	'LD' => 'Lakshadweep',
	'PY' => 'Puducherry',
);
session_start();
if (!isset($_SESSION['EmailId']))
	header('Location: login.php');
//unset($_SESSION['EmailId']);
//echo "stage2";
//session_destroy();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//if(isset($_POST['Register']))	{
	//if($_POST["name"]!=""){
	//echo "Post is selected after form submission";
	$PasswordErr = "";
	if (strlen($_POST["password"]) < 8 || ($_POST["password"] != $_POST["password2"])) {
		$PasswordErr = "Incorrect password rule, please enter minimum lenth of 8 and password should match";
	}
	//echo "Id is registered, please login";
	//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
	if ($PasswordErr == "") {
		$mysql_qry = "UPDATE $RegisterTableName SET Name='$_POST[name]', Password='$_POST[password]',State='$_POST[state]',City='$_POST[city]',Gender='$_POST[gender]'
					WHERE Email='$_SESSION[EmailId]';";
		//VALUES ('$_POST[name]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[gender]');";
		//$mysql_qry ="INSERT INTO register (Name,Email,Password,State,City,PhoneNumber,DateOfRegistration,Gender)	
		//VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]',date(),'$_POST[gender]');";
		if ($conn->query($mysql_qry)) {
			//echo "Data inserted in to DB";
			header('Location: welcome.php');
		} else {
			//echo"DB insertion issue";
		}
	}
}

$mysql_qry = "select * from $RegisterTableName where Email like '$_SESSION[EmailId]';";
$result = mysqli_query($conn, $mysql_qry);
if (mysqli_num_rows($result) > 0) {
	while ($row = $result->fetch_assoc()) {
		$name = $row["Name"];
		$password = $row["Password"];
		$state = $row["State"];
		$city = $row["City"];
		$gender = $row["Gender"];
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
					Update Information
				</h1>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<br><br>
					<div class="form-group">
						<label for="name">Name</label>
						<span class="error">* <p class="form_error"><?php echo $NameErr; ?></p></span>
						<input type="text" class="form-control" id="name" placeholder="name" name="name" value=<?php echo $name ?>>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<span class="error">* <p class="form_error"><?php echo $PasswordErr; ?></p></span>
						<input type="password" class="form-control" id="password" placeholder="password" name="password" value=<?php echo $password ?>>
					</div>

					<div class="form-group">
						<label for="password2">Re-Password</label>
						<span class="error">* <p class="form_error"><?php echo $PasswordErr; ?></p></span>
						<input type="password" class="form-control" id="password2" placeholder="password2" name="password2" value=<?php echo $password ?>>
					</div>

					<br>
					<div class="form-group">
						<label for="state">select your state </label>
						<select type="text" class="form-control" id="state" placeholder="state" name="state">
							<option value=<?php echo $state ?> style="color:red"><?php echo $state ?></option>
							<?php
							foreach ($indian_all_states as $key => $value) {
							?><option value=<?php echo $value ?>><?php echo $value ?></option><?php
															}
																?>
						</select>
					</div>
					<br>
					<div class="form-group">
						<label for="city">Enter your city </label>
						<input type="text" class="form-control" id="city" placeholder="city" name="city" value=<?php echo $city ?>>
					</div>
					<br>

					<div class="form-group">
						<label for="gender">select your gender </label>
						<select type="text" class="form-control" id="gender" placeholder="gender" name="gender" <?php echo $gender ?>>
							<option value="Male"><?php echo $gender ?></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							<option value="other">Other</option>
						</select>
					</div>
					<br>

					<input type="submit" class="like" value="Update"><?php ?>

					<br><br>


				</form>
			</div>
		</div>

	</div>
</body>

</html>