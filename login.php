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
//echo "stage1";
$LoginErr="";
session_start();
//echo $_SESSION['Email_id'];
if(isset($_SESSION['EmailId'])){
header ('Location: welcome.php');
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
	$mysql_qry ="select * from $RegisterTableName where Email like '$_POST[EmailId]' and Password like '$_POST[password]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
	//$EmailIdErr="Email_id exists or empty";;
	echo "Login successful";
	session_start();
	$_SESSION['EmailId']=$_POST['EmailId'];
	//echo $_SESSION['EmailId'];
	header ('Location: welcome.php');
	}
	else {
	$LoginErr="Email and password don't match";	
	}
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Email_id: <input type="text" name="EmailId">
<span class="error">* <?php ?></span>
<br><br>
Password: <input type="password" name="password">
<span class="error">* <?php ?></span>
<br><br>


<input type="submit" class="like" value="Login"><?php echo $LoginErr ?>
</form>

