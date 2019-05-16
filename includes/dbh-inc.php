<?php
		
	// For site's database
	$dbServerName = "mysql.shsustudents.com"; 
	$dbUsername = "hump";			
	$dbPassword = "123456789";		
	$dbName = "jabbe";				
	

	/*
	// LOCAL USE
	$dbServerName = "localhost";
	$dbUsername = "root";			
	$dbPassword = "";		
	$dbName = "katsconnect";
	*/				

	$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

?>
	
