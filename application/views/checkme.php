<?php 

	$value  = $_GET['value'];
	$table  = $_GET['table'];
	$column = $_GET['column'];
	$id     = $_GET['id'];
	$idvalue= $_GET['idvalue'];


	$con=mysqli_connect("localhost","root","bakrbakr","piwheel");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$query  = "select * from $table where $column = '$value'";
	if($id != ""){
		$query .= "and $id = '$idvalue'";
	}
	 $result = mysqli_query($con,$query);
	 if($result->num_rows == 0){
	 	echo 'true';
	 	die();
	 }
	 echo 'false';
	 

	mysqli_close($con);
	?>

 ?>