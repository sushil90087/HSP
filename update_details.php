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
$indian_all_states  = array (
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
if(!isset($_SESSION['EmailId']))
	header ('Location: login.php');
//unset($_SESSION['EmailId']);
//echo "stage2";
//session_destroy();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if(isset($_POST['Register']))	{
//if($_POST["name"]!=""){
	//echo "Post is selected after form submission";
	$PasswordErr="";
	if(strlen($_POST["password"])<8 || ($_POST["password"]!=$_POST["password2"])){
		$PasswordErr="Incorrect password rule, please enter minimum lenth of 8 and password should match";
	}
		//echo "Id is registered, please login";
		//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
		if ($PasswordErr==""){
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
Password-reenter: <input type="password" name="password2" value=<?php echo $password?>>
<span class="error">* <?php echo $PasswordErr;?></span>
<br><br>
State:
<select name="state">
<option value=<?php echo $state?>  style="color:red" ><?php echo $state?></option>
<?php 
foreach($indian_all_states as $key => $value){
?><option value=<?php echo $value?>><?php echo $value?></option><?php
}
?>
</select>

<br><br>
City: <input type="text" name="city" value=<?php echo $city?>>
<br><br>
gender:
<select name="gender">
  <option value=<?php echo $gender?>  style="color:red" ><?php echo $gender?></option>
  <option value="Male">Male</option>
  <option value="Female">Female</option>
  <option value="other">Other</option>
  </select>

<br><br>


<input type="submit" class="like" value="Update"><?php ?>
</form>

