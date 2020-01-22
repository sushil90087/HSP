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

<body style="background-color:#71cbdb;" style="color:white">
	<?php
	require "connect.php";
	$RegisterTableName = "register";
	?>
	<?php
	$LoginErr = "";
	session_start();
	//echo $_SESSION['Email_id'];
	if (isset($_SESSION['EmailId'])) {
		header('Location: welcome.php');
	}

	//unset($_SESSION['EmailId']);
	//echo "stage2";
	//session_destroy();
	//echo "stage3";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//if(isset($_POST['Register']))	{
		//if($_POST["name"]!=""){
		//echo "stage4";
		//echo "Post is selected after form submission";
		$mysql_qry = "select * from $RegisterTableName where Email like '$_POST[EmailId]' and Password like '$_POST[password]';";
		$result = mysqli_query($conn, $mysql_qry);
		if (mysqli_num_rows($result) > 0) {
			//$EmailIdErr="Email_id exists or empty";;
			echo "Login successful";
			session_start();
			$_SESSION['EmailId'] = $_POST['EmailId'];
			//echo $_SESSION['EmailId'];
			header('Location: welcome.php');
		} else {
			$LoginErr = "Email and password don't match";
		}
	}

	?>
	<div class="front_page">
		<h1>Welcome to Job - Trade </h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

			Email_id: <input type="text" name="EmailId">
			<span class="error">* <?php ?></span>
			<br><br>
			Password: <input type="password" name="password">
			<span class="error">* <?php ?></span>
			<br><br>


			<input type="submit" class="like" value="Login">
			<p class="form_error"><?php echo "<br>" . $LoginErr ?></p>
		</form>
	</div>
	<div class="register_link">
		<h5><a href="register.php" class="register_link">don't have account, please register</a>
			<h5>
	</div>

</body>

</html>