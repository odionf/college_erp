<?php
	include 'db.php';
	$pid = $_GET['pid'];
	$value = $_GET['value'];
	$val = $_GET['val'];
	if($value=='delete'){
	$q="DELETE FROM `users` WHERE pid='$pid'";}
	if($value=='reset'){
	$q="UPDATE `users` SET user_pass='123' WHERE pid='$pid'";}
	if($val=='reset'){
	$q="UPDATE `users` SET parent_pass='321' WHERE pid='$pid'";}
	mysqli_query($mysqli,$q);
?>