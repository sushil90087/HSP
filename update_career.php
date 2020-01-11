<?php
require "connect.php";
$AcademicTableName = "academics";
$CareerTableName = "career";
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
if(!isset($_SESSION['EmailId']))
	header ('Location: login.php');
//unset($_SESSION['EmailId']);
//echo "stage2";
//session_destroy();
	$mysql_qry ="select * from $RegisterTableName where Email like '$_SESSION[EmailId]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
		while ($row = $result->fetch_assoc()){
			$UserId = $row["UserId"];
		}
	}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if(isset($_POST['Register']))	{
//if($_POST["name"]!=""){
	//echo "Post is selected after form submission";
	$mysql_qry ="select * from $CareerTableName where UserId like $UserId;";
    $result = mysqli_query($conn , $mysql_qry);
	//echo $result;
	//if(mysqli_num_rows($result)>0){
	if(mysqli_num_rows($result)>0){
		//echo "Id is registered, please login";
		//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
		$mysql_qry ="UPDATE $CareerTableName SET 
		Introduction='$_POST[Introduction]',
		MinimumPackage='$_POST[MinimumPackage]',
		PreferredLocation='$_POST[PreferredLocation]',
		PreferredCompany='$_POST[PreferredCompany]',
		JoiningTimeInMonth='$_POST[JoiningTimeInMonth]',
		SkillSet='$_POST[SkillSet]',
		NumberOfYearsExperience='$_POST[NumberOfYearsExperience]',
		LinkedInId='$_POST[LinkedInId]'
		WHERE UserId=$UserId;";
		//VALUES ('$_POST[name]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[gender]');";
		//$mysql_qry ="INSERT INTO register (Name,Email,Password,State,City,PhoneNumber,DateOfRegistration,Gender)	
		//VALUES ('$_POST[name]','$_POST[EmailId]','$_POST[password]','$_POST[state]','$_POST[city]','$_POST[phone]',date(),'$_POST[gender]');";
        if($conn->query($mysql_qry)){
			//echo "Data inserted in to DB";
			header ('Location: welcome.php');
		}
		else{
			echo"DB insertion issue";
		}
	}
	else {
		$mysql_qry ="INSERT INTO $CareerTableName (UserId,Introduction,MinimumPackage,PreferredLocation,PreferredCompany,JoiningTimeInMonth,
		SkillSet,NumberOfYearsExperience,LinkedInId)
		VALUES ($UserId, '$_POST[Introduction]', '$_POST[MinimumPackage]', '$_POST[PreferredLocation]', '$_POST[PreferredCompany]',
		'$_POST[JoiningTimeInMonth]', '$_POST[SkillSet]', '$_POST[NumberOfYearsExperience]', '$_POST[LinkedInId]');";
		if($conn->query($mysql_qry)){
			//echo "line 			Data inserted in to DB";
			header ('Location: welcome.php');
		}
		else{
			//echo"line line DB insertion issue";
		}
	}
	
}
//$UserId=0;
$Introduction="";
$MinimumPackage=0;
$PreferredLocation="";
$PreferredCompany="";
$JoiningTimeInMonth=0;
$SkillSet="";
$NumberOfYearsExperience=0;
$LinkedInId="";
$Resume="";


	//echo $UserId;
	$mysql_qry ="select * from $CareerTableName where UserId like $UserId;";
    $result = mysqli_query($conn , $mysql_qry);
	//echo $result;
	//if(mysqli_num_rows($result)>0){
	if(mysqli_num_rows($result)>0){
		while ($row = $result->fetch_assoc()){
			$UserId=$row["UserId"];
			$Introduction=$row["Introduction"];
			$MinimumPackage=$row["MinimumPackage"];
			$PreferredLocation=$row["PreferredLocation"];
			$PreferredCompany=$row["PreferredCompany"];
			$JoiningTimeInMonth=$row["JoiningTimeInMonth"];
			$SkillSet=$row["SkillSet"];
			$NumberOfYearsExperience=$row["NumberOfYearsExperience"];
			$LinkedInId=$row["LinkedInId"];
			$Resume=$row["Resume"];
//echo "check";
		}
			
	}
	
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Introduction: <input type="text" name="Introduction" value=<?php echo $Introduction?>>
<br><br>

MinimumPackage: <input type="floatval" name="MinimumPackage" value=<?php echo $MinimumPackage?>>
<br><br>

PreferredLocation: <input type="text" name="PreferredLocation" value=<?php echo $PreferredLocation?>>
<br><br>

PreferredCompany: <input type="text" name="PreferredCompany" value=<?php echo $PreferredCompany?>>
<br><br>

JoiningTimeInMonth: <input type="number" name="JoiningTimeInMonth" value=<?php echo $JoiningTimeInMonth?>>
<br><br>

SkillSet: <input type="text" name="SkillSet" value=<?php echo $SkillSet?>>
<br><br>

NumberOfYearsExperience: <input type="floatval" name="NumberOfYearsExperience" value=<?php echo $NumberOfYearsExperience?>>
<br><br>

LinkedInId: <input type="text" name="LinkedInId" value=<?php echo $LinkedInId?>>
<br><br>



<input type="submit" class="like" value="Update"><?php ?>
</form>

