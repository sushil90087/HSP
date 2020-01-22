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
$AcademicTableName = "academics";
$CareerTableName = "career";
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
$state = 'Andhra Pradesh';
session_start();
if (isset($_SESSION['EmailId']))
	unset($_SESSION['EmailId']);
//echo "stage2";
session_destroy();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//if(isset($_POST['Register']))	{
	//if($_POST["name"]!=""){
	//echo "Post is selected after form submission";
	$mysql_qry = "select * from $RegisterTableName where Email like '$_POST[EmailId]';";
	$result = mysqli_query($conn, $mysql_qry);
	if (mysqli_num_rows($result) > 0) {
		$EmailIdErr = "Email_id exists or empty";;
	}
	if (!filter_var($_POST["EmailId"], FILTER_VALIDATE_EMAIL)) {
		$EmailIdErr = "Invalid email format";
	}
	$mysql_qry = "select * from $RegisterTableName where PhoneNumber like '$_POST[phone]';";
	$result = mysqli_query($conn, $mysql_qry);
	if (mysqli_num_rows($result) > 0) {
		$PhoneErr = "Phone Number exists or empty";;
	}
	//echo "password length is".strlen($_POST["password"]);
	//echo "password is ".$_POST["password"]."password 2 is ".($_POST["password"]);
	if (strlen($_POST["password"]) < 8 || ($_POST["password"] != $_POST["password2"])) {
		$PasswordErr = "Incorrect password rule, please enter minimum lenth of 8 and password should match";
	}
	if ((!preg_match("/^[a-zA-Z ]*$/", $_POST["name"])) || ($_POST["name"] == "")) {
		$NameErr = "Please enter valid name, special character are not allowed";
	}
	if (!preg_match('/^[0-9]{10}+$/', $_POST["phone"])) {
		$PhoneErr = "Enter valid phone number";
	}
	//echo "phone err is ".$PhoneErr;
	if ($EmailIdErr == "" && $PhoneErr == "" && $NameErr == "" && $PasswordErr == "") {
		//echo "Id is registered, please login";
		//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
		$mysql_qry = "INSERT INTO $RegisterTableName (Name,Email,Password,State,City,PhoneNumber,Gender) 
		VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]','$_POST[gender]');";
		//$mysql_qry ="INSERT INTO register (Name,Email,Password,State,City,PhoneNumber,DateOfRegistration,Gender)	
		//VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]',date(),'$_POST[gender]');";
		if ($conn->query($mysql_qry)) {
			echo "Data inserted in to DB";
			//header ('Location: login.php');
		} else {
			echo "DB insertion issue";
		}
		$mysql_qry = "select * from $RegisterTableName where Email like '$_POST[EmailId]';";
		$result = mysqli_query($conn, $mysql_qry);
		if (mysqli_num_rows($result) > 0) {
			while ($row = $result->fetch_assoc()) {
				$UserId = $row["UserId"];
			}
		}
		$mysql_qry = "INSERT INTO $AcademicTableName (UserId)
		VALUES ($UserId);";
		if ($conn->query($mysql_qry)) {
			echo "line 			Data inserted in to DB";
			//header ('Location: welcome.php');
		} else {
			echo "line line DB insertion issue";
		}
		$mysql_qry = "INSERT INTO $CareerTableName (UserId)
		VALUES ($UserId);";
		if ($conn->query($mysql_qry)) {
			echo "line 			Data inserted in to DB";
			//header ('Location: welcome.php');
		} else {
			echo "line line DB insertion issue";
		}
		header('Location: login.php');
	}
}

//echo "name err is ".$NameErr;

?>

<body style="background-color:#71cbdb; color:white; ">
	<div class="front_page_register">
		<h1 style="text-align:center">Register to Job - Trade </h1>
		</br></br>
		<div class="row">
			<div class="col-sm-2">

			</div>
			<div class="col-sm-8">
				<div class="register_link" style="text-align:left">
					<h5><a href="login.php" class="register_link">Already have account, Please login here</a>
						<h5>
				</div>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<br><br>
					<div class="form-group">
						<label for="name">Name</label>
						<span class="error">* <p class="form_error"><?php echo $NameErr; ?></p></span>
						<input type="text" class="form-control" id="name" placeholder="name" name="name" value=<?php if (isset($_POST["name"])) echo $_POST["name"]; ?>>
					</div>

					<br>
					<div class="form-group">
						<label for="EmailId">Email</label>
						<span class="error">* <p class="form_error"><?php echo $EmailIdErr; ?></p></span>
						<input type="email" class="form-control" id="EmailId" placeholder="Email" name="EmailId" value=<?php if (isset($_POST["EmailId"])) echo $_POST["EmailId"]; ?>>
					</div>

					<br>
					<div class="form-group">
						<label for="password">password (Minimum length is 8)</label>
						<span class="error">* <p class="form_error"><?php echo $PasswordErr; ?></p></span>
						<input type="password" class="form-control" id="password" placeholder="password" name="password" value=<?php if (isset($_POST["password"])) echo $_POST["password"]; ?>>
					</div>

					<br>
					<div class="form-group">
						<label for="password2">re-enter password </label>
						<input type="password" class="form-control" id="password2" placeholder="password2" name="password2" value=<?php if (isset($_POST["password2"])) echo $_POST["password2"]; ?>>
					</div>

					<br>
					<div class="form-group">
						<label for="state">select your state </label>
						<select type="text" class="form-control" id="state" placeholder="state" name="state">
							<option value=<?php if (isset($_POST["state"])) echo $_POST["state"];
											else echo $state ?> style="color:red"><?php echo $state ?></option>
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
						<input type="text" class="form-control" id="city" placeholder="city" name="city" value=<?php if (isset($_POST["city"])) echo $_POST["city"]; ?>>
					</div>
					<br>

					<div class="form-group">
						<label for="gender">select your gender </label>
						<select type="text" class="form-control" id="gender" placeholder="gender" name="gender" <?php if (isset($_POST["gender"])) echo $_POST["gender"] ?>>
							<option value="Male">select your gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							<option value="other">Other</option>
						</select>
					</div>
					<br>
					<div class="form-group">
						<label for="phone">Enter your mobile number</label>
						<span class="error">* <p class="form_error"> <?php echo $PhoneErr; ?> </p></span>

						<input type="number" class="form-control" id="phone" placeholder="phone" name="phone" value=<?php if (isset($_POST["phone"])) echo $_POST["phone"]; ?>>
					</div>


					<br><br>

					<input type="submit" class="like" value="Register"><?php ?>
				</form>
				<br><br>
			</div>

			<div class="col-sm-2">
			</div>

		</div>

	</div>
</body>

</html>