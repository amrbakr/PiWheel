<?php 

	$examID  = $_GET['id'].'.xml';
	$path = base_url()."application/uploads/exams".$examID;
	$xml  =simplexml_load_file($path);
	echo $xml;
	?>

 ?>