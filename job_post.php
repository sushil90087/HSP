<?php
require "connect.php";
$RegisterTableName = "register";
$JobsTableName = "jobs"
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

session_start();
if(!isset($_SESSION['EmailId']))
		header ('Location: login.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if(isset($_POST['Register']))	{
//if($_POST["name"]!=""){
	//echo "Post is selected after form submission";
	$mysql_qry ="select * from $RegisterTableName where Email like '$_SESSION[EmailId]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
		while ($row = $result->fetch_assoc()){
			$UserId = $row["UserId"];
		}
	}
	
		
		$mysql_qry ="INSERT INTO $JobsTableName (JobPosterId,JobIntroduction,JobLocation,MinimumExperience,MaximumExperience,JoiningTimeInMonths,
		Company,SkillSet,GenderSpecific,PreferredCompany,MinimumPackage,MaximumPackage,NumberOfVacancy) 
		VALUES ($UserId,'$_POST[JobIntroduction]','$_POST[JobLocation]','$_POST[MinimumExperience]','$_POST[MaximumExperience]','$_POST[JoiningTimeInMonths]',
		'$_POST[Company]','$_POST[SkillSet]','$_POST[GenderSpecific]','$_POST[PreferredCompany]','$_POST[MinimumPackage]','$_POST[MaximumPackage]','$_POST[NumberOfVacancy]');";
		
        if($conn->query($mysql_qry)){
			//echo "Data inserted in to DB";
			header ('Location: welcome.php');
		}
		else{
			//echo"DB insertion issue";
		}
	
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
JobIntroduction: <input type="text" name="JobIntroduction">
<br><br>

JobLocation: <input type="text" name="JobLocation">
<br><br>

MinimumExperience: <input type="floatval" name="MinimumExperience">
<br><br>

MaximumExperience: <input type="text" name="MaximumExperience">
<br><br>

JoiningTimeInMonths: <input type="number" name="JoiningTimeInMonths">
<br><br>

Company: <input type="text" name="Company">
<br><br>

SkillSet: <input type="text" name="SkillSet">
<br><br>

GenderSpecific: <input type="text" name="GenderSpecific">
<br><br>

PreferredCompany: <input type="text" name="PreferredCompany">
<br><br>

MinimumPackage: <input type="floatval" name="MinimumPackage">
<br><br>

MaximumPackage: <input type="floatval" name="MaximumPackage">
<br><br>

NumberOfVacancy: <input type="number" name="NumberOfVacancy">
<br><br>


<input type="submit" class="like" value="Submit Job"><?php ?>
</form>

