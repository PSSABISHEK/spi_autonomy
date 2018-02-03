<?php

	include("connection.php");
      if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$myusername = mysqli_real_escape_string($conn,$_POST['username']);
		$type = mysqli_real_escape_string($conn,$_POST['type']);
      	$desp = mysqli_real_escape_string($conn,$_POST['description']);
      	$reason = mysqli_real_escape_string($conn,$_POST['reason']);

      	if ($type == '' || $desp == '' || $reason == '')
      	{    
      		echo "Please fill in all the details";
      	}
            else
      	{
                  $sql = "SELECT * FROM details WHERE username = '$myusername'";
      		$result = $conn->query($sql);
      		$row = mysqli_fetch_assoc($result);
      		$name=$row['name'];
      		$mail_id=$row['mail_id'];
      		$contact=$row['contact'];
                  $query="INSERT INTO roster_change (name,mail_id,contact,type,description,reason) 
      				VALUES ('$name','$mail_id','$contact','$type','$desp','$reason')";
      		if ($conn->query($query) === TRUE)
      		{
      			echo "Entry done";
      		}
      		else
      		{
      			echo "Failed";
      		}
            }
      }
      else
      {
            echo "ERROR 404";
      }

?>


