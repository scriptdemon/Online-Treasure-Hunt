<?php
session_start();
if(!isset($_SESSION['id']))
header('Location :index.php');
include "database_connection.php";
$user_mail = (string)$_SESSION['email'];
$getUserInfo = mysqli_query($con,"SELECT * FROM user where user_mail = '$user_mail'") or die(mysqli_error($con));
	while($row = mysqli_fetch_array($getUserInfo))
	{
		$current_question = (int)$row['current_question'];
		$points = (int)$row['points'];
		$i_1 = (int)$row['i_1'];
		$i_2 = (int)$row['i_2'];
		$i_3 = (int)$row['i_3'];
	}

	if($current_question == 0)
	{
		$updateQ = mysqli_query($con,"UPDATE user SET current_question = 1 WHERE user_mail = '$user_mail'") or die(mysqli_error($con));

		if($updateQ)
			echo "Successful";
	}

	else if($current_question == 100)
	{
		$updateQ = mysqli_query($con,"UPDATE user SET current_question = 101 WHERE user_mail = '$user_mail'") or die(mysqli_error($con));
		if($updateQ)
			echo "Successful";
	}

	else if($current_question == 999)
	{
		$updateQ = mysqli_query($con,"UPDATE user SET current_question = 1000 WHERE user_mail = '$user_mail'") or die(mysqli_error($con));
		if($updateQ)
			echo "Successful";
	}

	else if($current_question == 98)
	{
		$updateQ = mysqli_query($con,"UPDATE user SET current_question = 99 WHERE user_mail = '$user_mail'") or die(mysqli_error($con));
		$checkFlag = mysqli_query($con,"SELECT flag FROM user WHERE user_mail = '$user_mail'") or die(mysqli_error($con));
		while($row3 = mysqli_fetch_array($checkFlag))
		{
			$flag = (int)$row3['flag'];
		}

		if($flag == 1)
		{
			$updateCrim = mysqli_query($con,"UPDATE user SET criminal1=1 WHERE user_mail = '$user_mail'") or die(mysqli_error($con));
		}
		if($flag == 2)
		{
			$updateCrim = mysqli_query($con,"UPDATE user SET criminal2=1 WHERE user_mail = '$user_mail'") or die(mysqli_error($con));			
		}
		if($flag == 3)
		{
			$updateCrim = mysqli_query($con,"UPDATE user SET criminal3=1 WHERE user_mail = '$user_mail'") or die(mysqli_error($con));
		}
		if($updateQ && $updateCrim)
			echo "Successful";
	}

	else
	{
		$ans = (string)$_POST['ans'];
		$getQuestionInfo = mysqli_query($con,"SELECT * FROM question WHERE q_id = $current_question") or die(mysqli_error($con));
		while ($row2 = mysqli_fetch_array($getQuestionInfo)) 
		{
			$q_next = (int)$row2['q_next'];
			$q_points = (int)$row2['q_points'];
			$q_answer = (string)$row2['q_answer'];
		}

		if($ans == $q_answer)
		{
			$t = time();
			$points = $points + $q_points;
			$updateStatus = mysqli_query($con,"UPDATE user SET points=$points,current_question=$q_next,TS=$t WHERE user_mail='$user_mail'") or die(mysqli_error($con));
			if($updateStatus)
			{
				echo "Successful";
			}
			else
			{
				echo "faliure";
			}
		}
		else
		{
			echo "Wrong Answer";
		}
	}				
?>