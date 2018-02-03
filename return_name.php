<?php
	include("connection.php");

	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{   
    	$myid = mysqli_real_escape_string($conn,$_POST['id']);
    	$myusername = mysqli_real_escape_string($conn,$_POST['username']);
		$query = "SELECT name, login_time FROM timestamp WHERE id='$myid' AND username='$myusername'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($result);
			
		if(isset($row)) 
		{
			$json = array();
			$details = array('name'=>$row['name'], 'login_time'=>$row['login_time']);		
			array_push($json, $details);
			$jsonstring = json_encode($json);
			echo $jsonstring;
		}
		else 
		{
			echo "No data available";
		}
	}
	
?>