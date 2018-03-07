<?php
session_start();
if(!isset($_SESSION['id']))
header('Location :index.php');
include 'database_connection.php';
$index = (int)$_POST['index'];
$user_mail = (string)$_SESSION['email'];
if($index == 0)	
{
	$update_status = mysqli_query($con,"UPDATE user SET current_question=11,i_1=1,flag=1 WHERE user_mail='$user_mail'") or die(mysqli_error($con));
	if($update_status)
		echo "Successful";	
}
else if($index == 1)
{
	$update_status = mysqli_query($con,"UPDATE user SET current_question=21,i_2=1,flag=2 WHERE user_mail='$user_mail'") or die(mysqli_error($con));
	if($update_status)
		echo "Successful";
}
else if($index == 2)
{
		$update_status = mysqli_query($con,"UPDATE user SET current_question=31,i_3=1,flag=3 WHERE user_mail='$user_mail'") or die(mysqli_error($con));
		if($update_status)
			echo "Successful";
}
else
{
	echo "failure";
}
?>