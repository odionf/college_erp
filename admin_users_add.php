<?php
	include 'db.php';
	$type = $_POST['type'];
	$password = $_POST['user_pass'];
	$passw = $_POST['parent_pass'];
	$id = $_POST['pid'];
	$first_name = $_POST['f_name'];
	$last_name = $_POST['l_name'];
	$q="INSERT INTO `users` (pid, user_pass, parent_pass, type, f_name, l_name) VALUES ('$id','$password','$passw','$type','$first_name','$last_name') ";
	mysqli_query($mysqli,$q);
?>