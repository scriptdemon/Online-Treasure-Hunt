<?php
if(!isset($_SESSION['id']))
header('Location :index.php');
include "database_connection.php";
$user_mail = $_SESSION['email'];
$getPathStatus = mysqli_query($con,"SELECT * FROM user WHERE user_mail='$user_mail'");
while($row = mysqli_fetch_array($getPathStatus))
{
	$i_1 = (int)$row['i_1'];
	$i_2 = (int)$row['i_2'];
	$i_3 = (int)$row['i_3'];
}
?>
<script type="text/javascript">
	$(document).ready(function(){
			$('.option').click(function(){
			if($(this).hasClass('disabled') == false)
			{
				var index = $('.option').index(this);
						var dataString = 'index='+index;
						// alert(index);
			
						$.ajax({
						type : 'post',
						url : 'set_path.php',
						data : dataString,
						cache: false,
						success : function(response){
							if(String(response) == 'Successful')
							{
								// alert('Updated Successfully');
								location.reload();
							}
							else
							{
								// alert(response);
							}
						}
				});
			}
		});

		$('.diff').click(function(){
			if($(this).hasClass('disabled') == false)
			{
				var index = $('.diff').index(this);
						var dataString = 'index='+index;
						// alert(index);
			
						$.ajax({
						type : 'post',
						url : 'set_diff.php',
						data : dataString,
						cache: false,
						success : function(response){
							if(String(response) == 'Successful')
							{
								// alert('Updated Successfully');
								location.reload();
							}
							else
							{
								// alert(response);
							}
						}
				});
			}
		});
    });
</script>
<div id="newModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content" style="background-color:#27ae60;color:white;font-family:hack;">
		      <div class="modal-header">
		        <h2 class="modal-title">ANAMOLY DETECTED!</h2>
		      </div>
		      <div class="modal-body">
		        <h3>According to the latest intel received from RAW, the database containing 
					highly classified library on Agni missiles has been hacked. As the head of cybersecurity cell of India, you have been assigned on a task to trace the hackers in the network.</h3>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" onclick="update()" data-dismiss="modal">Proceed</button>
		      </div>
		    </div>

		  </div>
</div>

<div id="optionModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content" style="background-color:#27ae60;color:white;font-family:hack;">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h3 class="modal-title">A RAY OF HOPE IN THE DARK</h3>
		      </div>
		      <div class="modal-body">
		      <div class='container-fluid'>
		      	<div class='row'>
		      		<div class='col-lg-12'>
		      			<h4>After Thorough network analysis, it is found that we are facing the cybersecurtiy threat from some of the most genius black hat hackers. Even with the highly encrypted connection used in hacking, we have tracked down 3 suspicious IP addresses and their locations are as follows:</h4>
		      		</div>
		      		<div class='col-lg-4 text-center'>
		      			<img src="manila.jpg" style="width:100%;height:150px;"><br>
		      			<p>Manila, Phillpines</p>
		      			<?php
					       if($i_1 == 1) 
					       		echo "<button class='btn btn-default option disabled'>Investigated</button><br>";
					       	else
					       		echo "<button class='btn btn-default option'><span style='text-align:center;'>Investigate</span></button><br>";
					      ?>
		      		</div>
		      		<div class='col-lg-4 text-center'>
		      			<img src="sao_paulo.jpeg" style="width:100%;height:150px;"><br>
		      			<p>Sao Paulo, Barzil</p>
		      			<?php
					       if($i_2 == 1) 
					       		echo "<button class='btn btn-default option disabled'>Investigated</button><br>";
					       	else
					       		echo "<button class='btn btn-default option'><span style='text-align:center;'>Investigate</span></button><br>"
					      ?>
		      		</div>
		      		<div class='col-lg-4 text-center'>
		      			<img src="frankfurt.jpg" style="width:100%;height:150px;"><br>
		      			<p>Frankfurt, Germany</p>
		      			<?php
					       if($i_3 == 1) 
					       		echo "<button class='btn btn-default option disabled'>Investigated</button>";
					       	else
					       		echo "<button class='btn btn-default option'><span style='text-align:center;'>Investigate</span></button>";
					     ?>
		      		</div>
		      	</div>
		      </div>
		      </div>
		    </div>
		  </div>
</div>

<div id="diffModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content" style="background-color:#27ae60;color:white;font-family:hack;">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h2 class="modal-title">Where decsion matters the most</h2>
		      </div>
		      <div class="modal-body">
		      	<h3>All the 3 suspects have been taken into custody for interrogation.
There is only enough time to interrogate one of the criminals.
According to the latest feed from RAW, these hackers have been dancing along the tunes played by a person in Shanghai who goes by the name, ‘THE DOLPHIN’.</h4>
<h3>Considering the intel recovered from the convicts, we have reached the following conclusion:</h3>
				<ol>
				<li>
				<h4>Adrian has the least connection and will give to interrogation quite easily. There will be more questions, but easy and mostly unfruitful answers.</h4>
				<button class='btn btn-default diff'>Select</button>	
				</li>
				<li>
				<h4>Leon has a call history with an untraceable number with only incoming calls coming at a considerable frequency. He might be a bit difficult to crack, and may answer some less but crucial questions.</h4>
				<button class='btn btn-default diff'>Select</button>	
				</li>
				<li>
				<h4>Vitor is the most hardened of them all. The jail time he has spent in Chile has made him immune to physical pain. Getting the answers will be a real challenge from him, but he is suspected to have the closest ties with THE DOLPHIN. His questions will be the least but the most difficult to get answers to.</h4>
				<button class='btn btn-default diff'>Select</button>
				</li>
				</ol>
		      </div>
		    </div>
		  </div>
</div>

<div id="revealModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content" style="background-color:#27ae60;color:white;font-family:hack;">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h2 class="modal-title">unmasked</h2>
		      </div>
		      <div class="modal-body">
		       <h3>Information obtained from arrested criminals has proven to be valuable which has helped finally unmasking the real identity of mastermind</h3>
		       <table class='table' style="background-color:black;color:white;font-size:20px;">
		       		<tr>
		       		<td>Name:</td>
		       		<td>Lei Jianlin</td>
		       		</tr>
		       		<tr>
		       		<td>Age:</td>
		       		<td>37</td>
		       		</tr>

		       		<tr>
		       		<td>Nationality:</td>
		       		<td>Chinese</td>
		       		</tr>

		       		<tr>
		       		<td>Description:</td>
		       		<td>Was an ethical hacker working for the The Government of the People's Republic of China. Played a crucial role in the ban of social networks in China, so that sites like renren.com and baidu can generate revenue for him in exchange for the clearance. He was planning to sell the missile launch codes and the statistics to the highest bidder.
					</td>
		       		</tr>
		       </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" onclick="update()" data-dismiss="modal">Proceed</button>
		      </div>
		    </div>
		  </div>
</div>

<div id="endModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content" style="background-color:#27ae60;color:white;font-family:hack;">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h2 class="modal-title">White hat won,black hat lost</h2>
		      </div>
		      <div class="modal-body">
		       <h3>Based on the reports obtained from previous reports, Beijing police traced and breached the residence of Mastermind of all the mess. Secrets of Agni missiles are now safe and thus the international peace</h3>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" onclick="update()" data-dismiss="modal">Proceed</button>
		      </div>
		    </div>
		  </div>
</div>

<div id="criminalModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content" style="background-color:#27ae60;color:white;font-family:hack;">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h2 class="modal-title">CRIMINAL APPREHENDED</h2>
		      </div>
		      <div class="modal-body">
		       <h3>Check the criminal details in the 'Criminals Apprehended' Section:</h3>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" onclick="update()" data-dismiss="modal">Proceed</button>
		      </div>
		    </div>
		  </div>
</div>

<div id="revealModal1" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content" style="background-color:#27ae60;color:white;font-family:hack;">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h2 class="modal-title">unmasked</h2>
		      </div>
		      <div class="modal-body">
		       <table class='table' style="background-color:black;color:white;font-size:20px;">
		       		<tr>
		       		<td>Name:</td>
		       		<td>Leon Marnel</td>
		       		</tr>
		       		<tr>
		       		<td>Age:</td>
		       		<td>25</td>
		       		</tr>

		       		<tr>
		       		<td>Nationality:</td>
		       		<td>Phillipino</td>
		       		</tr>

		       		<tr>
		       		<td>Description:</td>
		       		<td>Tried for hacking into google playstore to generate huge revenue for his app, dismissed due to lack of proof against him. Has been underground for 2 years since.
					</td>
		       		</tr>
		       		<tr>
		       		<td>Family Background:</td>
		       		<td>Only son of the multibillionaire business tycoon, Andrew Gokongwei.</td>
		       		</tr>
		       </table>
		      </div>
		     
		    </div>
		  </div>
</div>


<div id="revealModal2" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content" style="background-color:#27ae60;color:white;font-family:hack;">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h2 class="modal-title">unmasked</h2>
		      </div>
		      <div class="modal-body">
		       <table class='table' style="background-color:black;color:white;font-size:20px;">
		       		<tr>
		       		<td>Name:</td>
		       		<td>Vitor Fernando</td>
		       		</tr>
		       		<tr>
		       		<td>Age:</td>
		       		<td>33</td>
		       		</tr>

		       		<tr>
		       		<td>Nationality:</td>
		       		<td>Chilean</td>
		       		</tr>

		       		<tr>
		       		<td>Description:</td>
		       		<td>Charged for smuggling drugs in Chile, moved to Brazil after release. Started hiring people to do his dirty work for him.
					</td>
		       		</tr>

		       		<tr>
		       		<td>Family Background:</td>
		       		<td>single father, single child, owned a farm in Chile.</td>
		       		</tr>

		       </table>
		      </div>
		  
		    </div>
		  </div>
</div>


<div id="revealModal3" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content" style="background-color:#27ae60;color:white;font-family:hack;">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h2 class="modal-title">unmasked</h2>
		      </div>
		      <div class="modal-body">
		       <table class='table' style="background-color:black;color:white;font-size:20px;">
		       		<tr>
		       		<td>Name:</td>
		       		<td>Adrian Muller</td>
		       		</tr>
		       		<tr>
		       		<td>Age:</td>
		       		<td>29</td>
		       		</tr>

		       		<tr>
		       		<td>Nationality:</td>
		       		<td>German</td>
		       		</tr>

		       		<tr>
		       		<td>Description:</td>
		       		<td>No previous criminal data, graduated from Frankfurt University.
					</td>
		       		</tr>

		       		<tr>
		       		<td>Family Background:</td>
		       		<td>Lower middle class, 2 brothers.</td>
		       		</tr>

		       </table>
		      </div>
		      
		    </div>
		  </div>
</div>


