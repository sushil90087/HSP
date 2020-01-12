<?php
require "connect.php";
$RegisterTableName = "register";
$JobsTableName = "jobs";
$CareerTableName = "career";
$JobAppliedTableName = "jobapplied";
?>
<?php

session_start();
if(!isset($_SESSION['EmailId']))
	header ('Location: login.php');
	if (isset($_GET["id"])){
		$JobId=$_GET["id"];
	//	echo "Job id is :".$JobId;
	}


	$mysql_qry ="select * from $RegisterTableName where Email like '$_SESSION[EmailId]';";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
		while ($row = $result->fetch_assoc()){
			$UserId = $row["UserId"];
		}
	}
//echo $_SESSION['JobId'];
	//echo "check point 1";
	$mysql_qry ="select * from $JobsTableName where JobId like $JobId;";
    $result = mysqli_query($conn , $mysql_qry);
	if(mysqli_num_rows($result)>0){
		while ($row = $result->fetch_assoc()){
			$JobId = $row["JobId"];
			$JobPosterId = $row["JobPosterId"];
		}
	}

        $MatchStatus='APPLIED';
//echo "JobId=".$JobId."JobPosterId=".$JobPosterId."JobSeekerId=".$UserId."MatchStatus=".$MatchStatus;
		$mysql_qry ="INSERT INTO $JobAppliedTableName (JobId,JobPosterId,JobSeekerId,MatchStatus) 
		VALUES ($JobId, $JobPosterId, $UserId, 'APPLIED');";
        if($conn->query($mysql_qry)){
			//echo "Data inserted in to DB";
			header ('Location: search_job.php');
		}
		else{
			//echo"DB insertion issue";
		}
		
//}

?>

