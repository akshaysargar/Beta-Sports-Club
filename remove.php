<?php

	session_start();

	$user_id= $_GET['id'];
	
		$link = mysqli_connect("127.0.0.1" ,"root","root","users");

            if (mysqli_connect_error()) 
            {
                die("database connection failed");
            }

		$query = "DELETE FROM `users` WHERE `id` = '".mysqli_real_escape_string($link,$user_id)."' ";
   

		$result=mysqli_query($link,$query);

		if($result){
        echo "Deleted Successfully";
        echo "<BR>";
        echo "<a href='admin.php'>Back to main page</a>";
    }else {
        echo "ERROR";
    }


	


?>