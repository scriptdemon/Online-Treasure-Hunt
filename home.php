<?php
session_start();
if(!isset($_SESSION['id']))
header('Location: index.php');
include "database_connection.php";
$name = (string)$_SESSION['name'];
$user_mail = (string)$_SESSION['email'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>OTH 2K17|Home</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="FA/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Styles.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/auth.js"></script>
</head>
<body style="color:#00ff00;background-color:black;">
<?php
$check_if_exists = "SELECT * from user where user_mail='$user_mail'";
$exec = mysqli_query($con,$check_if_exists);
$result=mysqli_fetch_assoc($exec);
if($result["fill_form"]==0)
{
?>
	<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4" style="margin-top:15vh;">
		<form>
		<h2 class="text-center">Registration</h2>
			 <div class="form-group">
			    <label for="name">Name</label>
			    <input type="text" class="form-control" id="name" value="<?php echo $name; ?>" >
			 </div>

			 <div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" id="email" disabled="disabled" value="<?php echo $user_mail; ?>">
			 </div>

			 <div class="form-group">
			    <label for="mobile">Mobile</label>
			    <input type="number" class="form-control" id="mobile" placeholder="Your Mobile Number" maxlength="10">
			 </div>

			 <div class="form-group">
			    <label for="username">Username</label>
			    <input type="text" class="form-control" id="username" placeholder="Your Hacker Username">
			 </div>

			 <div class="form-group">
			    <label for="class">Class</label>
			    <select class="form-control" id="class">
			    	<option>Select</option>
		    		<option>D6A</option>
					<option>D6B</option>
					<option>D7A</option>
					<option>D7B</option>
					<option>D7C</option>
			          <option>D8</option>
			          <option>D9A</option>
			          <option>D9B</option>
			          <option>D9C</option>
			          <option>D10</option>
			          <option>D11A</option>
			          <option>D11B</option>
			          <option>D12A</option>
			          <option>D12B</option>
			          <option>D12C</option>
			          <option>D13</option>
			          <option>D14A</option>
			          <option>D14B</option>
			          <option>D14C</option>
			          <option>D15</option>
			          <option>D16A</option>
			          <option>D16B</option>
			          <option>D17A</option>
			          <option>D17B</option>
			          <option>D17C</option>
			          <option>D18</option>
			          <option>D19A</option>
			          <option>D19B</option>
			          <option>D19C</option>
			          <option>D20</option>
			    </select>
			 </div>
			 <div id='status'></div>
			 <div class="text-center">
			 	<button class="btn btn-success" onclick="return validate()">Register</button>
			 <div>
		</form>
	</div>
</body>
</html>

<!-- ACTUAL GAME -->
<?php
}
else
{	
include 'modal.php';
$getUserInfo = mysqli_query($con,"SELECT * FROM user where user_mail='$user_mail'") or die(mysqli_error($con));
while($row = mysqli_fetch_array($getUserInfo))
{
	$username = $row['username'];
	$current_question = $row['current_question'];
	$points = $row['points'];
	$i_1 = $row['i_1'];
	$i_2 = $row['i_2'];
	$i_3 = $row['i_3'];
	$criminal1 = $row['criminal1'];
	$criminal2 = $row['criminal2'];
	$criminal3 = $row['criminal3'];
}

if($current_question != 0 && $current_question != 99 && $current_question != 100)
{
	$getPoint = mysqli_query($con,"SELECT * FROM question where q_id = $current_question");
	while ($row2 = mysqli_fetch_array($getPoint)) {
		$q_name=$row2['q_problem'];
		$q_points = $row2['q_points'];
		$q_next = $row['q_next'];
	}
}

if($current_question == 0)
{
	//echo "<script>window.alert($current_question)</script>";
	echo "<script>$('#newModal').modal('show')</script>";
}

if($current_question == 98)
{
	echo "<script>$('#criminalModal').modal('show')</script>";
}

if($current_question == 99)
{
	if($i_1==1 && $i_2==1 && $i_3==1)
		echo "<script>$('#diffModal').modal('show')</script>";
	else
		echo "<script>$('#optionModal').modal('show')</script>";
}

if($current_question == 100)
{
	echo "<script>$('#revealModal').modal('show')</script>";
}

if($current_question == 999)
{
	echo "<script>$('#endModal').modal('show')</script>";
}
?>
	<script type="text/javascript">
		$(document).ready(function(){
			var dataString="page=leaderboard_data";
			$.ajax({
				type:'POST',
				cache:'false',
				url:'save_details.php',
				data:dataString,
				success:function(response)
				{
					$("#leaderboard").html(response);
				}
			});
		});
	</script>
		<div class="row text-center">
		<h1 style="font-family:hack;margin-bottom:20px;color:white;">ONLINE TREASURE HUNT</h1>
		<p class='text-center' style="font-family:hack;color:white;margin-bottom:20px;">For technical support call us at:<br>+91-7506698934</p>
		<h3 style="font-family:hack;">USERNAME : <?php echo $username; ?></h3>
                <h3 style="font-family:hack;">POINTS : <?php echo $points; ?></h3>
		<div class='text-center' style="margin-bottom:20px;"><button class='btn btn-default' onclick="logout()" style="background-color:transparent;border-color:#00ff00;color:#00ff00;font-family:hack;">LOGOUT</button></div>
	</div>
<div class='container-fluid'>
	<div class="row">
		<div class="col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-1" style="font-family:hack;background-color:black;border-radius:5px;">
			<h2 class="text-center">LeaderBoard</h2>
			<table class="table text-center" id="leaderboard">

			</table>
		</div>
		<div class="col-lg-5 col-md-5">
			<?php if($current_question != 1000)
			{
			?>
			<div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10">
				<img src="images/<?php echo $q_name;?>.png" alt="Question image" style="width:100%;height:inherit;">
			</div>
			<div class="col-lg-offset-3 col-lg-9 col-md-offset-3 col-md-9" style="margin-top:10px;">
				<p><b>NOTE</b> : Answer should be in small letters</p>
				<form class="form-inline" style="margin-bottom:20px;">
				  <div class="form-group">
				    <label class="sr-only" for="ans">Answer:</label>
				    <input type="text" class="form-control" id="ans">
				  </div>
				  <button class="btn btn-default" onclick="update()" style="background-color:transparent;border-color:#00ff00;color:#00ff00;font-family:hack;">Submit</button>
				</form>
			</div>
			<?php
			}
			else
			{
			?>
				<h1 class='text-center' style="font-family:hack;">You have successfully solved the case!</h1>
				<h1 class='text-center' style="font-family:hack;">CONGRATULATIONS!</h1>
			<?php
			}
			?>
		</div>
		<div class="col-lg-3" style="font-family:hack;">
			<h4 class="text-center">CRIMINALS APPREHENDED:</h4>
			<ol>
			<?php
			if($criminal1 == 1)
			{
				echo "<li><button class='btn btn-link' data-toggle='modal' data-target='#revealModal1'>Leon Marnel</button></li>";
			}
			if($criminal2 == 1)
			{
				echo "<li><button class='btn btn-link' data-toggle='modal' data-target='#revealModal2'>Vitor Fernando</button></li>";
			}
			if($criminal3 == 1)
			{
				echo "<li><button class='btn btn-link' data-toggle='modal' data-target='#revealModal3'>Adrian Muller</button></li>";
			}
			?>
			</ol>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
	<div class="col-lg-10" style="margin:0 auto;float:none;">
		<?php
		$sql=mysqli_query($con,"select * from user where user_mail='".$_SESSION["email"]."'");
		$result=mysqli_fetch_assoc($sql);
		if($result["criminal1"]==1 && $result["criminal2"]==1 && $result["criminal3"]==1)
		{
			echo "<img src='map/Final.png' style='width:100%;'>";
		}
		else if($result["i_1"]==0 && $result["i_2"]==0 && $result["i_3"]==0)
		{
			echo "<img src='map/501.png' style='width:100%;'>";
		}
		else if($result["i_1"]==0 && $result["i_2"]==0 && $result["i_3"]==1)
		{
			echo "<img src='map/507.png' style='width:100%;'>";
		}
		else if($result["i_1"]==0 && $result["i_2"]==1 && $result["i_3"]==0)
		{
			echo "<img src='map/505.png' style='width:100%;'>";
		}
		else if($result["i_1"]==0 && $result["i_2"]==1 && $result["i_3"]==1)
		{
			echo "<img src='map/508.png' style='width:100%;'>";
		}
		else if($result["i_1"]==1 && $result["i_2"]==0 && $result["i_3"]==0)
		{
			echo "<img src='map/502.png' style='width:100%;'>";
		}
		else if($result["i_1"]==1 && $result["i_2"]==0 && $result["i_3"]==1)
		{
			echo "<img src='map/506.png' style='width:100%;'>";
		}
		else if($result["i_1"]==1 && $result["i_2"]==1 && $result["i_3"]==0)
		{
			echo "<img src='map/503.png' style='width:100%;'>";
		}
		else if($result["i_1"]==1 && $result["i_2"]==1 && $result["i_3"]==1)
		{
			echo "<img src='map/504.png' style='width:100%;'>";
		}
		?>
		</div>
	</div>
</div>

</body>
</html>
<?php
}
?>