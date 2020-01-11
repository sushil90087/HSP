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
$NameErr="";
$EmailIdErr="";
$PasswordErr="";
$PhoneErr="";
$name = "Name";
$password = "Password";
$state = "State";
$city = "City";
$gender = "Gender";
session_start();
if(!isset($_SESSION['EmailId']))
	header ('Location: login.php');
//unset($_SESSION['EmailId']);
//echo "stage2";
//session_destroy();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if(isset($_POST['Register']))	{
//if($_POST["name"]!=""){
	//echo "Post is selected after form submission";

		//echo "Id is registered, please login";
		//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
		$mysql_qry ="UPDATE $RegisterTableName SET Name='$_POST[name]', Password='$_POST[password]',State='$_POST[state]',City='$_POST[city]',Gender='$_POST[gender]'
					WHERE Email='$_SESSION[EmailId]';";
		//VALUES ('$_POST[name]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[gender]');";
		//$mysql_qry ="INSERT INTO register (Name,Email,Password,State,City,PhoneNumber,DateOfRegistration,Gender)	
		//VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]',date(),'$_POST[gender]');";
        if($conn->query($mysql_qry)){
			//echo "Data inserted in to DB";
			header ('Location: welcome.php');
		}
		else{
			//echo"DB insertion issue";
		}
	
}

	$mysql_qry ="select * from $RegisterTableName where Email like '$_SESSION[EmailId]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
		while ($row = $result->fetch_assoc()){
			$name = $row["Name"];
			$password = $row["Password"];
			$state = $row["State"];
			$city = $row["City"];
			$gender = $row["Gender"];
		}
			
	}
	
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name: <input type="text" name="name" value=<?php echo $name?>>
<span class="error">* <?php echo $NameErr;?></span>
<br><br>

Password: <input type="password" name="password" value=<?php echo $password?>>
<span class="error">* <?php echo $PasswordErr;?></span>
<br><br>
State: <input type="text" name="state" value=<?php echo $state?>>
<br><br>
City: <input type="text" name="city" value=<?php echo $city?>>
<br><br>
gender: <input type="text" name="gender" value=<?php echo $gender?>>
<br><br>


<input type="submit" class="like" value="Update"><?php ?>
</form>

