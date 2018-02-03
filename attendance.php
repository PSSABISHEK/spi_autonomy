<?php 
	include ("connection.php");
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$myusername = mysqli_real_escape_string($conn,$_POST['username']);
		$query="SELECT date,login_time,logout_time FROM timestamp WHERE username='$myusername' ORDER BY date,login_time";
		$result = mysqli_query($conn,$query);		
		$json=array();
		while($row = mysqli_fetch_assoc($result))
		{
			$details = array('Date'=>$row['date'], 'LoginTime'=>$row['login_time'], 'LogoutTime'=>$row['logout_time']);		
			array_push($json, $details);
		}
		$jsonstring = json_encode($json);
		echo $jsonstring;
	} 		
 ?>