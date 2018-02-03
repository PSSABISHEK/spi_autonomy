<?php
   include("connection.php");
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {
      // username and password sent from form  
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

      if ($myusername == '' && $mypassword == '') 
      {
        echo "Please fill in the details";
      }
      
      else if($myusername == '') 
      {
        echo "Please enter your username";
      }

      else if ($mypassword == '') 
      {
        echo "Please enter the pwd";
      }
      
      else 
      {
        $sql = "SELECT * FROM employees WHERE BINARY username = '$myusername' AND BINARY password = '$mypassword'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
        $count = mysqli_num_rows($result);
        // If result matched $myusername and $mypassword, table row must be 1 row
        
        if($count == 1)
        {
          //echo ("Logged in"); 
          $query1= "SELECT emp_id name FROM employees WHERE username ='$myusername'";
          $result1 = mysqli_query($conn,$query1);
          $row = mysqli_fetch_assoc($result1);
          $name1=$row['name'];
          
          //Inserting the name into the timestamp table
          $sql = "INSERT INTO timestamp (name,username,date,login_time,logout_time,reason)
                    VALUES ('$name1','$myusername',CURRENT_DATE,CURRENT_TIME,'','')";          
          
          if ($conn->query($sql) === TRUE)
          {
            $query2="SELECT id,login_time FROM timestamp WHERE login_time=CURRENT_TIMESTAMP AND name='$name1'";   //fetching the ID using the login time
            $result2 = mysqli_query($conn,$query2);
            $row1 = mysqli_fetch_assoc($result2);
            echo $row1['id'];
          }
          
          else
          {
           echo ("Error :");
        }
      }
      else 
      {
        echo ("Your Username or Password is invalid");
      }

   }
}
else 
{
  echo ("Error 404");
}

?>