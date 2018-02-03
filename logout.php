<?php
   include("connection.php");

   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
   		$token=mysqli_real_escape_string($conn,$_POST['token']);
   		$id = mysqli_real_escape_string($conn,$_POST['id']);
   		$myusername = mysqli_real_escape_string($conn,$_POST['username']);
   		$reason=mysqli_real_escape_string($conn,$_POST['reason']);
   		$query = "UPDATE timestamp SET logout_time=CURRENT_TIME, reason='$reason' WHERE id='$id' AND username='$myusername'";

   		if ($conn->query($query) === TRUE)
		{
			if ($token === "1")		//counting the total number of hours worked for the day and proves is emp on site
			{
				echo "Hey";
			}
			else if ($token === "0") 
			{
				echo "Not On Site";
			}
			echo "Logged Out";
		}
		else
		{
			echo "Failed to Log Out";		
		}
   }
   
 
?>