<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>OG Games - Customer</title>
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
	<img alt="customer button" src="buttons/customer.JPG" />
	<a href="distribution.php"><img alt="distribution button" class="dist" src="buttons/dist.JPG" /></a>
	<a href="games.php"><img alt="games button" class="games" src="buttons/games.JPG" /></a>
	<a href="genres.php"><img alt="genres button" class="genres" src="buttons/genres.JPG" /></a><br />
	<a href="order.php"><img alt="order button" class="order" src="buttons/order.JPG" /></a>
	<a href="publisher.php"><img alt="publisher button" class="publisher" src="buttons/publisher.JPG" /></a>
	<a href="system.php"><img alt="system button" class="system" src="buttons/system.JPG" /></a>
</div>

<br />
<div align="center" style="background-color: white; margin: 0px 375px 0px 375px">	
	<h1>Customers</h1>
</div>
<div id="accordion" style="background-color: white; margin: 0px 100px 0px 100px">

	<h3>Insert a new Customer</h3>
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
					$lname=$_POST['lname'];
					$fname=$_POST['fname'];
					$address=$_POST['address'];
					$city=$_POST['city'];
					$state=$_POST['state'];
					$zip=$_POST['zip'];
					$error=0;
					
					if($lname==NULL||$fname==NULL||$address==NULL||$city==NULL||$state=='none'||$zip==NULL)
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
						$lletters = $lname[0];
						$fletters = $fname[0];
						$lupperletters = strtoupper($lletters);
						$fupperletters = strtoupper($fletters);
						$digits = rand(10, 99);
						$digitstring = strval($digits);
						$new_id = $fupperletters.$lupperletters.$digitstring;
							
						$query= mysql_query("INSERT INTO CUSTOMER VALUES ('$new_id','$lname','$fname','$address','$city','$state','$zip')");
						$viewquery= "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = '$new_id'";

						if($r=mysql_query($viewquery))
						{
							echo "<center>";
								echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
									<tr bgcolor='white'>
										<th>Customer ID</th>
										<th>Last Name</th>
										<th>First Name</th>
										<th>Address</th>
										<th>City</th>
										<th>State</th>
										<th>Zip</th>
									</tr>";
										$row=mysql_fetch_array($r);


										echo"<p>Insertion successful. <br />The new data for Customer ID ".$row['CUSTOMER_ID']." is displayed below.</p>";
										echo"<tr>";
										echo"<td>" .$row['CUSTOMER_ID'] ."</td>";
										echo"<td>" .$row['LAST_NAME'] ."</td>";
										echo"<td>" .$row['FIRST_NAME'] ."</td>";
										echo"<td>" .$row['ADDRESS'] ."</td>";
										echo"<td>" .$row['CITY'] ."</td>";
										echo"<td>" .$row['STATE'] ."</td>";
										echo"<td>" .$row['ZIP'] ."</td>";
									echo"</tr>";
								echo "</table>";
							echo"</center>";
							$fname=NULL;
							$lname=NULL;
							$address=NULL;
							$city=NULL;
							$state=NULL;
							$zip=NULL;
						}		
					}
				}	
			?>
			
			Last Name: <input name="lname" type="text" value="<?php echo $lname; ?>"/><br /><br />
			First Name: <input name="fname" type="text" value="<?php echo $fname; ?>"/><br /><br />
			Address: <input name="address" type="text" value="<?php echo $address; ?>"/><br /><br />
			City: <input name="city" type="text" value="<?php echo $city; ?>"/><br /><br />
			State: 
			<?php include 'states.php';?>
			<br /><br />
			Zip: <input name="zip" size="5" maxlength="5" type="text" value="<?php echo $zip; ?>"/><br /><br />				
			<input name="insert" type="submit" value="" class="insert"/>
		</form>
	</div>

	<h3>All Customer Data</h3>
	<div>

		<?php
			
			if(isset($_POST['delete']))
			{
				$id=$_POST['id'];
				
				mysql_query("DELETE FROM CUSTOMER WHERE CUSTOMER_ID='$id'");
				
				echo '<script type="text/javascript">alert("Customer '.$id.' has been deleted.");</script>';
				
				$query = "SELECT * FROM CUSTOMER";			
				$r=mysql_query($query);
					echo "<center>";
					echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
						<tr bgcolor='white'>
						<th>Customer ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Zip</th>
						</tr>";
						while($row=mysql_fetch_array($r))
						{
							$id = $row['CUSTOMER_ID'];
							$lname = $row['LAST_NAME'];
							$fname = $row['FIRST_NAME'];
							$address = $row['ADDRESS'];
							$city = $row['CITY'];
							$state = $row['STATE'];
							$zip = $row['ZIP'];
							
							echo"<tr>";
								echo"<form method='post'>";
									echo"<td>$id</td>";
									echo"<input name='id' type='hidden' value='".$id."' />";
									echo"<td><input name='lname' type='text' value='".$lname."' /></td>";
									echo"<td><input name='fname' type='text' value='".$fname."' /></td>";
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
				$lname=$_POST['lname'];
				$fname=$_POST['fname'];
				$address=$_POST['address'];
				$city=$_POST['city'];
				$state=$_POST['state'];
				$zip=$_POST['zip'];
				$error = 0;

					if($lname==NULL||$fname==NULL||$address==NULL||$address==NULL||$city==NULL||$state==NULL||$zip==NULL)
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
						
						mysql_query("UPDATE CUSTOMER SET LAST_NAME ='$lname', FIRST_NAME ='$fname', ADDRESS ='$address', CITY ='$city', STATE ='$new_state', ZIP ='$zip' WHERE CUSTOMER_ID='$id'");

						echo '<script type="text/javascript">alert("Customer '.$id.' has been updated.");</script>';
						
						$query = "SELECT * FROM CUSTOMER";			
						$r=mysql_query($query);
							echo "<center>";
							echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
								<tr bgcolor='white'>
								<th>Customer ID</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Address</th>
								<th>City</th>
								<th>State</th>
								<th>Zip</th>
								</tr>";
								while($row=mysql_fetch_array($r))
								{
									$id = $row['CUSTOMER_ID'];
									$lname = $row['LAST_NAME'];
									$fname = $row['FIRST_NAME'];
									$address = $row['ADDRESS'];
									$city = $row['CITY'];
									$state = $row['STATE'];
									$zip = $row['ZIP'];
									
									echo"<tr>";
										echo"<form method='post'>";
											echo"<td>$id</td>";
											echo"<input name='id' type='hidden' value='".$id."' />";
											echo"<td><input name='lname' type='text' value='".$lname."' /></td>";
											echo"<td><input name='fname' type='text' value='".$fname."' /></td>";
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
			
				$query = "SELECT * FROM CUSTOMER";			
				$r=mysql_query($query);
					echo "<center>";
					echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
						<tr bgcolor='white'>
						<th>Customer ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Zip</th>	
						</tr>";
						while($row=mysql_fetch_array($r))
						{
							$id = $row['CUSTOMER_ID'];
							$lname = $row['LAST_NAME'];
							$fname = $row['FIRST_NAME'];
							$address = $row['ADDRESS'];
							$city = $row['CITY'];
							$state = $row['STATE'];
							$zip = $row['ZIP'];
							
							echo"<tr>";
								echo"<form method='post'>";
									echo"<td>$id</td>";
									echo"<input name='id' type='hidden' value='".$id."' />";
									echo"<td><input name='lname' type='text' value='".$lname."' /></td>";
									echo"<td><input name='fname' type='text' value='".$fname."' /></td>";
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
			Search Customer by ID: <input name="id" type="text" maxlength="4" size="4"/>
			<input name="search_id" type="submit" value="" class="search"/>
		</p>
		<p>
			Search Customer by State: 
			<?php include 'states.php';?>			
			<input name="search_state" type="submit" value="" class="search"/>
		</p>

		<?php
			if(isset($_POST['search_id']))
			{
				if(empty($_REQUEST['id']))
				{
					echo '<script type="text/javascript">alert("Please enter a Customer ID");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$id=$_POST['id'];
				$query = "SELECT * FROM CUSTOMER
				WHERE CUSTOMER_ID= '$id'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['id']))
						{
							$message = "Invalid Customer ID";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{

								echo "<center>";
									echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
										<tr bgcolor='white'>
											<th>Last Name</th>
											<th>First Name</th>
											<th>Address</th>
											<th>City</th>
											<th>State</th>
											<th>Zip</th>
										</tr>";
											$row=mysql_fetch_array($r);
											echo"<p>The data for Customer ID ".$row['CUSTOMER_ID']." is displayed below.</p>";
											echo"<tr>";
											echo"<td>" .$row['LAST_NAME'] ."</td>";
											echo"<td>" .$row['FIRST_NAME'] ."</td>";
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
				$query = "SELECT * FROM CUSTOMER
				WHERE STATE = '$state'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0 && $state != 'none')
						{
							$message = "There are currently no Customers located in $state";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({ active: 2, heightStyle: 'content'});</script>";
						}
						else
						{

								echo "<center>";
									echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
										<tr bgcolor='white'>
											<th>Last name</th>
											<th>First Name</th>
											<th>Address</th>
											<th>City</th>
											<th>State</th>
											<th>Zip</th>
										</tr>";
											$row=mysql_fetch_array($r);
											echo"<p>The data for all Customers in ".$row['STATE']." are displayed below.</p>";
											echo"<tr>";
											echo"<td>" .$row['LAST_NAME'] ."</td>";
											echo"<td>" .$row['FIRST_NAME'] ."</td>";
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