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
$NameErr="";
$EmailIdErr="";
$PasswordErr="";
$PhoneErr="";
session_start();
if(isset($_SESSION['EmailId']))
unset($_SESSION['EmailId']);
//echo "stage2";
session_destroy();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if(isset($_POST['Register']))	{
//if($_POST["name"]!=""){
	//echo "Post is selected after form submission";
	$mysql_qry ="select * from $RegisterTableName where Email like '$_POST[EmailId]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
	$EmailIdErr="Email_id exists or empty";;
	}
	if (!filter_var($_POST["EmailId"], FILTER_VALIDATE_EMAIL)) {
		$EmailIdErr = "Invalid email format";
	  }
	$mysql_qry ="select * from $RegisterTableName where PhoneNumber like '$_POST[phone]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
	$PhoneErr="Phone Number exists or empty";;
	}
	//echo "password length is".strlen($_POST["password"]);
	//echo "password is ".$_POST["password"]."password 2 is ".($_POST["password"]);
	if(strlen($_POST["password"])<8 || ($_POST["password"]!=$_POST["password2"])){
		$PasswordErr="Incorrect password rule, please enter minimum lenth of 8 and password should match";
	}
	if ((!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) || ($_POST["name"]=="")){
		$NameErr="Please enter valid name, special character are not allowed";
	}
	if (!preg_match('/^[0-9]{10}+$/', $_POST["phone"]))
	{
		$PhoneErr="Enter valid phone number";
	}
	//echo "phone err is ".$PhoneErr;
	if($EmailIdErr=="" && $PhoneErr=="" && $NameErr=="" && $PasswordErr==""){
		//echo "Id is registered, please login";
		//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
		$mysql_qry ="INSERT INTO $RegisterTableName (Name,Email,Password,State,City,PhoneNumber,Gender) 
		VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]','$_POST[gender]');";
		//$mysql_qry ="INSERT INTO register (Name,Email,Password,State,City,PhoneNumber,DateOfRegistration,Gender)	
		//VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]',date(),'$_POST[gender]');";
        if($conn->query($mysql_qry)){
			echo "Data inserted in to DB";
			//header ('Location: login.php');
		}
		else{
			echo"DB insertion issue";
		}
		$mysql_qry ="select * from $RegisterTableName where Email like '$_POST[EmailId]';";
    	$result = mysqli_query($conn , $mysql_qry);
		if(mysqli_num_rows($result)>0){
		while ($row = $result->fetch_assoc()){
			$UserId = $row["UserId"];
			}

		}
		$mysql_qry ="INSERT INTO $AcademicTableName (UserId)
		VALUES ($UserId);";
		if($conn->query($mysql_qry)){
			echo "line 			Data inserted in to DB";
			//header ('Location: welcome.php');
		}
		else{
			echo"line line DB insertion issue";
		}
		$mysql_qry ="INSERT INTO $CareerTableName (UserId)
		VALUES ($UserId);";
		if($conn->query($mysql_qry)){
			echo "line 			Data inserted in to DB";
			//header ('Location: welcome.php');
		}
		else{
			echo"line line DB insertion issue";
		}
		header ('Location: welcome.php');
	}
}
 
//echo "name err is ".$NameErr;

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name: <input type="text" name="name">
<span class="error">* <?php echo $NameErr;?></span>
<br><br>
Email_id: <input type="text" name="EmailId">
<span class="error">* <?php echo $EmailIdErr;?></span>
<br><br>
Password(Minimum length is 8): <input type="password" name="password">
<span class="error">* <?php echo $PasswordErr;?></span>
<br><br>
Re-enter Password: <input type="password" name="password2">
<br>
<br>
State: <input type="text" name="state">
<br><br>
City: <input type="text" name="city">
<br><br>
gender: <input type="text" name="gender">
<br><br>
Phone: <input type="number" name="phone">
<span class="error">* <?php echo $PhoneErr;?></span>
<br><br>

<input type="submit" class="like" value="Register"><?php ?>
</form>

