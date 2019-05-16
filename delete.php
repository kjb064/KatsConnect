<?php

include_once 'includes/header.php';

if (isset($_GET['deleteid'])){

	$tutorid=$_GET['deleteid'];
	$table_name=$_GET['table_name'];
	$redirect_url=$_GET['redirect_url'];

	$tutor_data = $user->delete_row($table_name,$tutorid);

	if ($tutor_data) {
		header('location:'.$redirect_url);
	}
}


?>
