<?php 

	$value  = $_GET['lessonID'];	

	$con=mysqli_connect("localhost","root","bakrbakr","piwheel");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	 $query  = "delete from Chapter_Lesson where ID=".$value;
	 $result = mysqli_query($con,$query);
	 if(mysqli_affected_rows($con) == 0)
	 	return "false";
	 else
	 	return "true";
	 

	mysqli_close($con);
	?>

 ?>