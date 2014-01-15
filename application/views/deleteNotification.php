<?php 

	$value  = $_GET['id'];


	$con=mysqli_connect("localhost","root","bakrbakr","piwheel");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$query  = "delete from notification where ID=".$value;
	$result = mysqli_query($con,$query);
	 

	mysqli_close($con);
	?>

 ?>