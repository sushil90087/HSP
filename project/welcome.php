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
echo "You are logged-in successfully";
?>


<button type="button" onclick="myFunction()">Try it</button>

