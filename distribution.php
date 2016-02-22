<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>OG Games - Distribution</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<link rel="SHORTCUT ICON" href="logo.ico"/>
		<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script  type='text/javascript'>
			$(document).ready(function(){
				$(".cust").hover(function() {
					$(this).attr("src","buttons/customer2.JPG");
						}, function() {
					$(this).attr("src","buttons/customer.JPG");
				});
				$(".dist").hover(function() {
					$(this).attr("src","buttons/dist2.JPG");
						}, function() {
					$(this).attr("src","buttons/dist.JPG");
				});
				$(".games").hover(function() {
					$(this).attr("src","buttons/games2.JPG");
						}, function() {
					$(this).attr("src","buttons/games.JPG");
				});
				$(".order").hover(function() {
					$(this).attr("src","buttons/order2.JPG");
						}, function() {
					$(this).attr("src","buttons/order.JPG");
				});
				$(".genres").hover(function() {
					$(this).attr("src","buttons/genres2.JPG");
						}, function() {
					$(this).attr("src","buttons/genres.JPG");
				});
				$(".publisher").hover(function() {
					$(this).attr("src","buttons/publisher2.JPG");
						}, function() {
					$(this).attr("src","buttons/publisher.JPG");
				});	
				$(".system").hover(function() {
					$(this).attr("src","buttons/system2.JPG");
						}, function() {
					$(this).attr("src","buttons/system.JPG");
				});				
			});
		</script>
		<script>
			$(function() {
				$( "#accordion" ).accordion({
				heightStyle: "content",
				collapsible: true});
			});		
		</script>
	</head>

<body>
<div align="center" style="background-color: white; margin: 0px 375px 0px 375px">
	<a href="index.html"><img alt="header" src="header.JPG"/></a>
	<br />
	<a href="customer.php"><img alt="customer button" class="cust" src="buttons/customer.JPG" /></a>
	<img alt="distribution button" src="buttons/dist.JPG" />
	<a href="games.php"><img alt="games button" class="games" src="buttons/games.JPG" /></a>
	<a href="genres.php"><img alt="genres button" class="genres" src="buttons/genres.JPG" /></a><br />
	<a href="order.php"><img alt="order button" class="order" src="buttons/order.JPG" /></a>
	<a href="publisher.php"><img alt="publisher button" class="publisher" src="buttons/publisher.JPG" /></a>
	<a href="system.php"><img alt="system button" class="system" src="buttons/system.JPG" /></a>
</div>

<br />
<div align="center" style="background-color: white; margin: 0px 375px 0px 375px">	
	<h1>Distribution Centers</h1>
</div>
<div id="accordion" style="background-color: white; margin: 0px 200px 0px 200px">

	<h3>Insert a new Distribution Center</h3>
	<div>
		<form method="post">
		
		<?php

			ini_set('display_errors',1);
			error_reporting(E_ALL & ~E_NOTICE);

			if($connection=@mysql_connect('localhost','MM1238','elvis921'))
			{

			}
			else
			{
				die('<p>Could not connect to MySQL becuase: <b>' .mysql_error().'</b></p>');
			}

			if(@mysql_select_db("MM1238_PROJECT2",$connection))
			{
				
			}
			else
			{
				die('<p>Could not select the MM1238_PROJECT2 database becuase: <b>' .mysql_error().'</b></p>');
			}

		?>	
		
		<?php

				if(isset($_POST['insert']))
				{
					$name=$_POST['name'];
					$address=$_POST['address'];
					$city=$_POST['city'];
					$state=$_POST['state'];
					$zip=$_POST['zip'];
					$error=0;
					
					if($name==NULL||$address==NULL||$city==NULL||$state=='none'||$zip==NULL)
					{
						$message = "You have not filled out all required infomation";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
					
					if(!is_numeric($zip)&&$zip!=NULL)
					{
						$message = "You have entered an invalid zip code. Please enter a numeric value.";
						echo "<script type='text/javascript'>alert('$message');</script>";	
						$error++;					
					}
					
					elseif($error==0)
					{
						$myquery = mysql_query("SELECT MAX(CENTER_ID) FROM DIST_CENTERS");
						$myrow = mysql_fetch_assoc($myquery);	
						$new_id = $myrow['MAX(CENTER_ID)'];				
						$new_id = $new_id + 1;
							
						$query= mysql_query("INSERT INTO DIST_CENTERS VALUES ('$new_id','$name','$address','$city','$state','$zip')");
						$viewquery= "SELECT * FROM DIST_CENTERS WHERE CENTER_ID = '$new_id'";

						if($r=mysql_query($viewquery))
						{
							echo "<center>";
								echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
									<tr bgcolor='white'>
										<th>Center ID</th>
										<th>Center Name</th>
										<th>Address</th>
										<th>City</th>
										<th>State</th>
										<th>Zip</th>
									</tr>";
										$row=mysql_fetch_array($r);


										echo"<p>Insertion successful. <br />The new data for Center ID ".$row['CENTER_ID']." is displayed below.</p>";
										echo"<tr>";
										echo"<td>" .$row['CENTER_ID'] ."</td>";
										echo"<td>" .$row['NAME'] ."</td>";
										echo"<td>" .$row['ADDRESS'] ."</td>";
										echo"<td>" .$row['CITY'] ."</td>";
										echo"<td>" .$row['STATE'] ."</td>";
										echo"<td>" .$row['ZIP'] ."</td>";
									echo"</tr>";
								echo "</table>";
							echo"</center>";
							$name=NULL;
							$address=NULL;
							$city=NULL;
							$state=NULL;
							$zip=NULL;
						}		
					}
				}	
			?>
			
			Center Name: <input name="name" type="text" value="<?php echo $name; ?>"/><br /><br />
			Address: <input name="address" type="text" value="<?php echo $address; ?>"/><br /><br />
			City: <input name="city" type="text" value="<?php echo $city; ?>"/><br /><br />
			State: 
			<?php include 'states.php';?>
			<br /><br />
			Zip: <input name="zip" size="5" maxlength="5" type="text" value="<?php echo $zip; ?>"/><br /><br />				
			<input name="insert" type="submit" value="" class="insert"/>
		</form>
	</div>

	<h3>All Distribution Center Data</h3>
	<div>

		<?php
			
			if(isset($_POST['delete']))
			{
				$id=$_POST['id'];
				
				mysql_query("DELETE FROM DIST_CENTERS WHERE CENTER_ID='$id'");
				
				echo '<script type="text/javascript">alert("Center '.$id.' has been deleted.");</script>';
				
				$query = "SELECT * FROM DIST_CENTERS";			
				$r=mysql_query($query);
					echo "<center>";
					echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
						<tr bgcolor='white'>
						<th>Center ID</th>
						<th>Name</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Zip</th>
						</tr>";
						while($row=mysql_fetch_array($r))
						{
							$id = $row['CENTER_ID'];
							$name = $row['NAME'];
							$address = $row['ADDRESS'];
							$city = $row['CITY'];
							$state = $row['STATE'];
							$zip = $row['ZIP'];
							
							echo"<tr>";
								echo"<form method='post'>";
									echo"<td>$id</td>";
									echo"<input name='id' type='hidden' value='".$id."' />";
									echo"<td><input name='name' type='text' value='".$name."' /></td>";
									echo"<td><input name='address' type='text' value='".$address."' /></td>";
									echo"<td><input name='city' type='text' value='".$city."' /></td>";
									echo"<td><input name='state' type='text' size='2' value='".$state."' /></td>";
									echo"<td><input name='zip' type='text' size='6' value='".$zip."'/></td>";
									echo"<td><input name='update' type='submit' value='' class='update' onclick='return confirm(\"Are you sure you would like to update this entry?\")'/></td>";
									echo"<td><input name='delete' type='submit' value='' class='delete' onclick='return confirm(\"Are you sure you would like to delete this entry?\")'/></td>";
								echo"</form>";
							echo"</tr>";
						}
					echo "</table>";
				echo"</center>";
				echo"<br /><br />";
				$display = 'none';

			}
			
			if(isset($_POST['update']))
			{
				
				$id=$_POST['id'];
				$name=$_POST['name'];
				$address=$_POST['address'];
				$city=$_POST['city'];
				$state=$_POST['state'];
				$zip=$_POST['zip'];
				$error = 0;

					if($name==NULL||$address==NULL||$address==NULL||$city==NULL||$state==NULL||$zip==NULL)
					{
						$message = "You have not filled out all required infomation";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
					
					if(!is_numeric($zip)&&$zip!=NULL)
					{
						$message = "You have entered an invalid zip code. Please enter a numeric value.";
						echo "<script type='text/javascript'>alert('$message');</script>";	
						$error++;					
					}

					$state_length = strlen($state);

					if(($state_length != 2 || is_numeric($state))&&$state!=NULL)
					{
						$message = "You have entered an invalid state. Please enter a two letter representation of the state.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;													
					}
					
					elseif($error==0)
					{
						$new_state = strtoupper($state);
						
						mysql_query("UPDATE DIST_CENTERS SET NAME ='$name', ADDRESS ='$address', CITY ='$city', STATE ='$new_state', ZIP ='$zip' WHERE CENTER_ID='$id'");

						echo '<script type="text/javascript">alert("Center '.$id.' has been updated.");</script>';
						
						$query = "SELECT * FROM DIST_CENTERS";			
						$r=mysql_query($query);
							echo "<center>";
							echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
								<tr bgcolor='white'>
								<th>Center ID</th>
								<th>Name</th>
								<th>Address</th>
								<th>City</th>
								<th>State</th>
								<th>Zip</th>
								</tr>";
								while($row=mysql_fetch_array($r))
								{
									$id = $row['CENTER_ID'];
									$name = $row['NAME'];
									$address = $row['ADDRESS'];
									$city = $row['CITY'];
									$state = $row['STATE'];
									$zip = $row['ZIP'];
									
									echo"<tr>";
										echo"<form method='post'>";
											echo"<td>$id</td>";
											echo"<input name='id' type='hidden' value='".$id."' />";
											echo"<td><input name='name' type='text' value='".$name."' /></td>";
											echo"<td><input name='address' type='text' value='".$address."' /></td>";
											echo"<td><input name='city' type='text' value='".$city."' /></td>";
											echo"<td><input name='state' type='text' size='2' value='".$state."' /></td>";
											echo"<td><input name='zip' type='text' size='6' value='".$zip."'/></td>";
											echo"<td><input name='update' type='submit' value='' class='update' onclick='return confirm(\"Are you sure you would like to update this entry?\")'/></td>";
											echo"<td><input name='delete' type='submit' value='' class='delete' onclick='return confirm(\"Are you sure you would like to delete this entry?\")'/></td>";
										echo"</form>";
									echo"</tr>";
								}
							echo "</table>";
						echo"</center>";
						echo"<br /><br />";
						$display = 'none';
					}
			}
		
			if ($display != 'none')
			{
			
				$query = "SELECT * FROM DIST_CENTERS";			
				$r=mysql_query($query);
					echo "<center>";
					echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
						<tr bgcolor='white'>
						<th>Center ID</th>
						<th>Name</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Zip</th>	
						</tr>";
						while($row=mysql_fetch_array($r))
						{
							$id = $row['CENTER_ID'];
							$name = $row['NAME'];
							$address = $row['ADDRESS'];
							$city = $row['CITY'];
							$state = $row['STATE'];
							$zip = $row['ZIP'];
							
							echo"<tr>";
								echo"<form method='post'>";
									echo"<td>$id</td>";
									echo"<input name='id' type='hidden' value='".$id."' />";
									echo"<td><input name='name' type='text' value='".$name."' /></td>";
									echo"<td><input name='address' type='text' value='".$address."' /></td>";
									echo"<td><input name='city' type='text' value='".$city."' /></td>";
									echo"<td><input name='state' type='text' size='2' value='".$state."' /></td>";
									echo"<td><input name='zip' type='text' size='6' value='".$zip."'/></td>";
									echo"<td><input name='update' type='submit' value='' class='update' onclick='return confirm(\"Are you sure you would like to update this entry?\")'/></td>";
									echo"<td><input name='delete' type='submit' value='' class='delete' onclick='return confirm(\"Are you sure you would like to delete this entry?\")'/></td>";
								echo"</form>";
							echo"</tr>";
						}
					echo "</table>";
				echo"</center>";
				echo"<br /><br />";
			}
			
		?>
	
	</div>

	
	<h3>Query Data</h3>
	<div>
	<form method="post">
		<p>
			Search Center by ID: <input name="id" type="text" maxlength="3" size="3"/>
			<input name="search_id" type="submit" value="" class="search"/>
		</p>
		<p>
			Search Center by State: 
			<?php include 'states.php';?>			
			<input name="search_state" type="submit" value="" class="search"/>
		</p>

		<?php
			if(isset($_POST['search_id']))
			{
				if(empty($_REQUEST['id']))
				{
					echo '<script type="text/javascript">alert("Please enter a Center ID");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$id=$_POST['id'];
				$query = "SELECT * FROM DIST_CENTERS
				WHERE CENTER_ID= '$id'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['id']))
						{
							$message = "Invalid Center ID";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{

								echo "<center>";
									echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
										<tr bgcolor='white'>
											<th>Name</th>
											<th>Address</th>
											<th>City</th>
											<th>State</th>
											<th>Zip</th>
										</tr>";
											$row=mysql_fetch_array($r);
											echo"<p>The data for Center ID ".$row['CENTER_ID']." is displayed below.</p>";
											echo"<tr>";
											echo"<td>" .$row['NAME'] ."</td>";
											echo"<td>" .$row['ADDRESS'] ."</td>";
											echo"<td>" .$row['CITY'] ."</td>";
											echo"<td>" .$row['STATE'] ."</td>";
											echo"<td>" .$row['ZIP'] ."</td>";
										echo"</tr>";
									echo "</table>";
								echo"</center>";
								echo "<script type='text/javascript'>$('#accordion').accordion({ active: 2, heightStyle: 'content'});</script>";
						}
					}
				}
			}
		?>
		
		<?php
			if(isset($_POST['search_state']))
			{
				$state=$_POST['state'];
				if($state=='none')
				{
					echo '<script type="text/javascript">alert("Please choose a State");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$query = "SELECT * FROM DIST_CENTERS
				WHERE STATE= '$state'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0 && $state != 'none')
						{
							$message = "There are currently no distribution centers located in $state";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({ active: 2, heightStyle: 'content'});</script>";
						}
						else
						{

								echo "<center>";
									echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
										<tr bgcolor='white'>
											<th>Name</th>
											<th>Address</th>
											<th>City</th>
											<th>State</th>
											<th>Zip</th>
										</tr>";
											$row=mysql_fetch_array($r);
											echo"<p>The data for all distribution centers in ".$row['STATE']." are displayed below.</p>";
											echo"<tr>";
											echo"<td>" .$row['NAME'] ."</td>";
											echo"<td>" .$row['ADDRESS'] ."</td>";
											echo"<td>" .$row['CITY'] ."</td>";
											echo"<td>" .$row['STATE'] ."</td>";
											echo"<td>" .$row['ZIP'] ."</td>";
										echo"</tr>";
									echo "</table>";
								echo"</center>";
								echo"<br /><br />";
								echo "<script type='text/javascript'>$('#accordion').accordion({ active: 2, heightStyle: 'content'});</script>";
						}
					}
				}
			}
		?>

	</form>
	</div>
		
</div>

</body>
</html>