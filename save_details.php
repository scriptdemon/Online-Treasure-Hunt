<?php
session_start();
include "database_connection.php";

if(!isset($_SESSION['id']))
header('Location: index.php');
if(isset($_SESSION['id']) &&  ($_POST["page"]=="data_registration"))
{
	$username=$_POST["username"];
	$mobile=$_POST["mobile"];
	$class=$_POST["userclass"];
	$name=$_SESSION["name"];
	$email=$_SESSION["email"];

	$checkMobile = mysqli_query($con,"SELECT * FROM user WHERE mobile=$mobile");
	$checkUsername = mysqli_query($con,"SELECT * FROM user WHERE username='$username'");

	if(mysqli_num_rows($checkMobile) > 0)
	{
		echo "This mobile number is already registered";
	}
	else if(mysqli_num_rows($checkUsername) > 0) 
	{
		echo "This username is already registered";
	}

	else
	{
		if(mysqli_query($con,"insert into user(username,name,user_mail,class,mobile,fill_form) values('".$username."','".$name."','".$email."','".$class."','".$mobile."',1)"))
		{
			echo "successful";
		}
		else 
			die(mysqli_error($con));
	}
}


if(isset($_SESSION['id']) && ($_POST["page"]=="leaderboard_data"))
{
	$sql=mysqli_query($con,"SELECT * FROM `user`  where TS <> 0 ORDER BY points desc,TS asc LIMIT 10");
	$i=1;
	?>
	<thead>
	<tr>
		<th style="text-align:center;">Rank</th>
		<th style="text-align:center;">Username</th>
		<th style="text-align:center;">Points</th>
	</tr>
	<thead>
	<tbody>
	<?php
	while($row=mysqli_fetch_assoc($sql))
	{
		?>
		<tr>
			<td><?php echo $i++;?></td>
			<td><?php echo $row["username"];?></td>
			<td><?php echo $row["points"];?></td>
		</tr>
		<?php
	}
	echo "</tbody>";
}

?>