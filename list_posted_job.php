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


//if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
	//echo "check point 1";
	$mysql_qry ="select * from $JobsTableName where JobPosterId like $UserId;";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
		//echo "checking 2";
		while ($row = $result->fetch_assoc()){
			echo "JobIntroduction : ".$row["JobIntroduction"]."<br>";
			echo "JobLocation : ".$row["JobLocation"]."<br>";
			echo "MinimumExperience : ".$row["MinimumExperience"]."<br>";
			echo "MaximumExperience : ".$row["MaximumExperience"]."<br>";
			echo "JoiningTimeInMonths : ".$row["JoiningTimeInMonths"]."<br>";
			echo "Company : ".$row["Company"]."<br>";
			echo "SkillSet : ".$row["SkillSet"]."<br>";
			echo "GenderSpecific : ".$row["GenderSpecific"]."<br>";
			echo "PreferredCompany : ".$row["PreferredCompany"]."<br>";
			echo "MinimumPackage : ".$row["MinimumPackage"]."<br>";
			echo "MaximumPackage : ".$row["MaximumPackage"]."<br>";
			echo "NumberOfVacancy : ".$row["NumberOfVacancy"]."<br>";
			echo "<br>";
			
            ?>
			<a href=<?php echo $row["Jd"]?>  download="JD">JD details</a>
			<?php

		}
	}
//}

?>

