<?php
	
	require "db.php";
	
	$email = $_GET["us_email"];
	
	$sql = "SELECT user_id FROM user WHERE email='$email' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
	if(!empty($row)){
		echo $row["user_id"];
		
	}
?>
