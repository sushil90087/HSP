<?php
require "connect.php";
$AcademicTableName = "academics";
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
	$mysql_qry ="select * from $AcademicTableName where UserId like $UserId;";
    $result = mysqli_query($conn , $mysql_qry);
	//echo $result;
	//if(mysqli_num_rows($result)>0){
	if(mysqli_num_rows($result)>0){
		//echo "Id is registered, please login";
		//$mysql_qry ="INSERT INTO register (Name) VALUES ('$_POST[name]');";
		$mysql_qry ="UPDATE $AcademicTableName SET Class10Board='$_POST[Class10Board]', 
		Class10Percentage='$_POST[Class10Percentage]', 
		Class12Board='$_POST[Class12Board]',
		Class12Percentage='$_POST[Class12Percentage]', 
		College='$_POST[College]',
		Stream='$_POST[Stream]',
		CGPA='$_POST[CGPA]',
		CurrentOrganisation='$_POST[CurrentOrganisation]',
		CurrentCity='$_POST[CurrentCity]'
					WHERE UserId=$UserId;";
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
	else {
		$mysql_qry ="INSERT INTO $AcademicTableName (UserId,Class10Board,Class10Percentage,Class12Board,
		Class12Percentage,College,Stream,CGPA,CurrentOrganisation,CurrentCity)
		VALUES ($UserId, '$_POST[Class10Board]', '$_POST[Class10Percentage]', '$_POST[Class12Board]', '$_POST[Class12Percentage]',
		 '$_POST[College]', '$_POST[Stream]', '$_POST[CGPA]', '$_POST[CurrentOrganisation]', '$_POST[CurrentOrganisation]');";
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
$Class10Board="";
$Class12Board="";
$Class10Percentage=0;
$Class12Percentage=0;
$College="";
$Stream="";
$CGPA=0;
$CurrentOrganisation="";
$CurrentCity="";


	//echo $UserId;
	$mysql_qry ="select * from $AcademicTableName where UserId like $UserId;";
    $result = mysqli_query($conn , $mysql_qry);
	//echo $result;
	//if(mysqli_num_rows($result)>0){
	if(mysqli_num_rows($result)>0){
		while ($row = $result->fetch_assoc()){
			$UserId=$row["UserId"];
			//$Class10Board=$row["Class10Board"];
			$Class10Board=$row["Class10Board"];
			$Class12Board=$row["Class12Board"];
			$Class10Percentage=$row["Class10Percentage"];
			$Class12Percentage=$row["Class12Percentage"];
			$College=$row["College"];
			$Stream=$row["Stream"];
			$CGPA=$row["CGPA"];
			$CurrentOrganisation=$row["CurrentOrganisation"];
			$CurrentCity=$row["CurrentCity"];
//echo "check";
		}
			
	}
	
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Class10Board: <input type="text" name="Class10Board" value=<?php echo $Class10Board?>>
<br><br>

Class10Percentage: <input type="number" name="Class10Percentage" value=<?php echo $Class10Percentage?>>
<br><br>

Class12Board: <input type="text" name="Class12Board" value=<?php echo $Class12Board?>>
<br><br>

Class12Percentage: <input type="number" name="Class12Percentage" value=<?php echo $Class12Percentage?>>
<br><br>

College: <input type="text" name="College" value=<?php echo $College?>>
<br><br>

Stream/Brach: <input type="text" name="Stream" value=<?php echo $Stream?>>
<br><br>

CGPA (in Percentage): <input type="number" name="CGPA" value=<?php echo $CGPA?>>
<br><br>

CurrentOrganisation: <input type="text" name="CurrentOrganisation" value=<?php echo $CurrentOrganisation?>>
<br><br>


CurrentCity: <input type="text" name="CurrentCity" value=<?php echo $CurrentCity?>>
<br><br>


<input type="submit" class="like" value="Update"><?php ?>
</form>

