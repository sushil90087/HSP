<?php
require "connect.php";
$user_name = "user_name_1";
$user_pass ="user_pass_1";
$mysql_qry ="select * from employee_data where user_name like '$user_name' and password like '$user_pass';";
$result = mysqli_query($conn , $mysql_qry);
if(mysqli_num_rows($result)>0){
	echo "login test done";
}
else {
	echo "login test not sucess";
}
?>
<?php
$nameErr="";
$user_idErr="";
$passwordErr="";
$login_signup="";
$loginErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if($_POST["name"]!=""){
	$mysql_qry ="select * from employee_data where user_id like '$_POST[user_id]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
	$user_idErr="User_id exists";;
	}
	if($_POST["user_id"]==100){
	$user_idErr="Its police number, not allowed";
	}
	if($user_idErr==""){
		echo "Id is registered, please login";
		$mysql_qry ="INSERT INTO employee_data (user_name,user_id,password) VALUES ('$_POST[name]','$_POST[user_id]','$_POST[password]');";
        if($conn->query($mysql_qry)){
			echo "ID inserted in to DB";
		}
		else{
			echo"DB insertion issue";
		}
	}
}

if($_POST["name"]==""){
	$mysql_qry ="select * from employee_data where user_id like '$_POST[user_id]' and password like '$_POST[password]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
	echo "login test done";
	session_start();
	//$_SESSION["user_id"]=$_POST["user_id"];
	header('Location: welcome.php');
	
	}	
	else {
		$loginErr="login id and password dont matches";
		echo "login test not sucess";
	}
}	
	
}
?>
<?php
echo "if you keep name as empty then credentials are considered to be login";
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name: <input type="text" name="name">
<span class="error">* <?php echo $nameErr;?></span>
<br><br>
user_id: <input type="text" name="user_id">
<span class="error">* <?php echo $user_idErr;?></span>
<br><br>
password: <input type="password" name="password">
<span class="error">* <?php echo $passwordErr;?></span>
<br><br>
<input type="submit" class="like" value="signup/login"><?php echo $loginErr;?>
</form>

