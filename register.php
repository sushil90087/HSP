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
	$mysql_qry ="select * from $RegisterTableName where PhoneNumber like '$_POST[phone]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
	$PhoneErr="Phone Number exists exists or empty";;
	}
	if($EmailIdErr=="" && $PhoneErr==""){
		//echo "Id is registered, please login";
		//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
		$mysql_qry ="INSERT INTO $RegisterTableName (Name,Email,Password,State,City,PhoneNumber,Gender) 
		VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]','$_POST[gender]');";
		//$mysql_qry ="INSERT INTO register (Name,Email,Password,State,City,PhoneNumber,DateOfRegistration,Gender)	
		//VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]',date(),'$_POST[gender]');";
        if($conn->query($mysql_qry)){
			//echo "Data inserted in to DB";
			header ('Location: login.php');
		}
		else{
			//echo"DB insertion issue";
		}
	}
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name: <input type="text" name="name">
<span class="error">* <?php echo $NameErr;?></span>
<br><br>
Email_id: <input type="text" name="EmailId">
<span class="error">* <?php echo $EmailIdErr;?></span>
<br><br>
Password: <input type="password" name="password">
<span class="error">* <?php echo $PasswordErr;?></span>
<br><br>
State: <input type="text" name="state">
<br><br>
City: <input type="text" name="city">
<br><br>
gender: <input type="text" name="gender">
<br><br>
Phone: <input type="tel" name="phone">
<br><br>

<input type="submit" class="like" value="Register"><?php ?>
</form>

