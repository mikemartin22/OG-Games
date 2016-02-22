<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>OG Games - Order</title>
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
				$('.datepick').each(function() {
					$(this).datepicker({
						changeMonth: true,
						changeYear: true
					});
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
	<a href="distribution.php"><img alt="distribution button" class="dist" src="buttons/dist.JPG" /></a>
	<a href="games.php"><img alt="games button" class="games" src="buttons/games.JPG" /></a>
	<a href="genres.php"><img alt="genres button" class="genres" src="buttons/genres.JPG" /></a><br />
	<img alt="order button" src="buttons/order.JPG" />
	<a href="publisher.php"><img alt="publisher button" class="publisher" src="buttons/publisher.JPG" /></a>
	<a href="system.php"><img alt="system button" class="system" src="buttons/system.JPG" /></a>
</div>

<br />
<div align="center" style="background-color: white; margin: 0px 375px 0px 375px">	
	<h1>Order</h1>
</div>
<div id="accordion" style="background-color: white; margin: 0px 200px 0px 200px">

	<h3>Insert a new Order</h3>
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
					$system=$_POST['system'];
					$game=$_POST['game'];
					$center=$_POST['center'];
					$order_date=$_POST['order_date'];
					$est_date=$_POST['est_date'];
					$customer=$_POST['customer'];
					$error=0;
					
					$viewqueryone="SELECT * FROM SYSTEM WHERE SYSTEM_ID = '$system'";
					$viewquerytwo="SELECT * FROM GAMES WHERE GAME_ID = '$game'";
					$viewquerythree="SELECT * FROM DIST_CENTERS WHERE CENTER_ID = '$center'";
					$viewqueryfour="SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = '$customer'";
					
					if($system==NULL||$game==NULL||$center==NULL||$order_date==NULL||$est_date==NULL||$customer==NULL)
					{
						$message = "You have not filled out all required infomation";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
					
					if($system!=NULL)
					{
						$r=mysql_query($viewqueryone);
						$num_rows =mysql_num_rows($r);
						if($num_rows==0)
						{
							$message = "You have entered an invalid System ID.";
							echo "<script type='text/javascript'>alert('$message');</script>";
							$error++;
						}
					}	

					if($game!=NULL)
					{
						$r=mysql_query($viewquerytwo);
						$num_rows =mysql_num_rows($r);
						if($num_rows==0)
						{
							$message = "You have entered an invalid Game ID.";
							echo "<script type='text/javascript'>alert('$message');</script>";
							$error++;
						}
					}
					
					if($center!=NULL)
					{
						$r=mysql_query($viewquerythree);
						$num_rows =mysql_num_rows($r);
						if($num_rows==0)
						{
							$message = "You have entered an invalid Center ID.";
							echo "<script type='text/javascript'>alert('$message');</script>";
							$error++;
						}
					}	
					
					if($customer!=NULL)
					{
						$r=mysql_query($viewqueryfour);
						$num_rows =mysql_num_rows($r);
						if($num_rows==0)
						{
							$message = "You have entered an invalid Customer ID.";
							echo "<script type='text/javascript'>alert('$message');</script>";
							$error++;
						}
					}	
					
					if($error==0)
					{
						$myquery = mysql_query("SELECT MAX(ORDER_ID) FROM `ORDER`");
						$myrow = mysql_fetch_assoc($myquery);	
						$new_id = $myrow['MAX(ORDER_ID)'];				
						$new_id = $new_id + 1;
							
						$query= mysql_query("INSERT INTO `ORDER` VALUES ('$new_id','$system','$game','$center','$order_date','$est_date','$customer')");
						$viewquery= "SELECT * FROM `ORDER` WHERE ORDER_ID = '$new_id'";

						if($r=mysql_query($viewquery))
						{
							echo "<center>";
								echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
									<tr bgcolor='white'>
										<th>Order ID</th>
										<th>System ID</th>
										<th>Game ID</th>		
										<th>Center ID</th>
										<th>Order Date</th>
										<th>Estimated Arrival Date</th>
										<th>Customer ID</th>
									</tr>";
										$row=mysql_fetch_array($r);


										echo"<p>Insertion successful. <br />The new data for Order ID ".$row['ORDER_ID']." is displayed below.</p>";
										echo"<tr>";
										echo"<td>" .$row['ORDER_ID'] ."</td>";
										echo"<td>" .$row['SYSTEM_ID'] ."</td>";
										echo"<td>" .$row['GAME_ID'] ."</td>";
										echo"<td>" .$row['CENTER_ID'] ."</td>";
										echo"<td>" .$row['ORDER_DATE'] ."</td>";
										echo"<td>" .$row['EST_ARRIVAL'] ."</td>";
										echo"<td>" .$row['CUSTOMER_ID'] ."</td>";
									echo"</tr>";
								echo "</table>";
							echo"</center>";
							echo"<br/><br/>";
							$system=NULL;
							$game=NULL;
							$center=NULL;
							$order_date=NULL;
							$est_date=NULL;
							$customer=NULL;
						}		
					}
				}	
			?>
			System ID: <input name="system" type="text" size="3" value="<?php echo $system; ?>"/><br /><br />
			Game ID: <input name="game" type="text" size="3" value="<?php echo $game; ?>"/><br /><br />
			Center ID: <input name="center" type="text" size="3" value="<?php echo $center; ?>"/><br /><br />
			Order Date: <input name="order_date" type="text" class="datepick" id="date_1" size="12" value="<?php echo $order_date; ?>"/><br /><br />
			Estimated Arrival Date: <input name="est_date" type="text" class="datepick" id="date_2" size="12" value="<?php echo $est_date; ?>"/><br /><br />
			Customer ID: <input name="customer" type="text" size="6" value="<?php echo $customer; ?>"/><br /><br />			
			<input name="insert" type="submit" value="" class="insert"/>
		</form>
	</div>

	<h3>All Order Data</h3>
	<div>

		<?php
			
			if(isset($_POST['delete']))
			{
				$order_id=$_POST['order_id'];
				
				mysql_query("DELETE FROM `ORDER` WHERE ORDER_ID='$order_id'");
				
				echo '<script type="text/javascript">alert("Order '.$order_id.' has been deleted.");</script>';
				
				$query = "SELECT * FROM `ORDER`";			
				$r=mysql_query($query);
					echo "<center>";
					echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
						<tr bgcolor='white'>
							<th>Order ID</th>
							<th>System ID</th>
							<th>Game ID</th>		
							<th>Center ID</th>
							<th>Order Date</th>
							<th>Estimated Arrival Date</th>
							<th>Customer ID</th>
						</tr>";
						
						while($row=mysql_fetch_array($r))
						{
							$order_id = $row['ORDER_ID'];
							$system_id = $row['SYSTEM_ID'];
							$game_id = $row['GAME_ID'];
							$center_id = $row['CENTER_ID'];
							$order_date = $row['ORDER_DATE'];
							$est_date = $row['EST_ARRIVAL'];
							$customer_id = $row['CUSTOMER_ID'];
							
							echo"<tr>";
								echo"<form method='post'>";
									echo"<td>$order_id</td>";
									echo"<input name='order_id' type='hidden' value='".$order_id."' />";
									echo"<td><input name='system_id' type='text' size='3' value='".$system_id."' /></td>";
									echo"<td><input name='game_id' type='text' size='3' value='".$game_id."' /></td>";
									echo"<td><input name='center_id' type='text' size='3' value='".$center_id."' /></td>";
									echo"<td><input name='order_date' type='text' size='12' value='".$order_date."' /></td>";
									echo"<td><input name='est_date' type='text' size='12' value='".$est_date."'/></td>";
									echo"<td><input name='customer_id' type='text' size='6' value='".$customer_id."'/></td>";
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
				$order_id = $_POST['order_id'];
				$system_id = $_POST['system_id'];
				$game_id = $_POST['game_id'];
				$center_id = $_POST['center_id'];
				$order_date = $_POST['order_date'];
				$est_date = $_POST['est_date'];
				$customer_id = $_POST['customer_id'];
				$error = 0;

				$viewqueryone="SELECT * FROM SYSTEM WHERE SYSTEM_ID = '$system_id'";
				$viewquerytwo="SELECT * FROM GAMES WHERE GAME_ID = '$game_id'";
				$viewquerythree="SELECT * FROM DIST_CENTERS WHERE CENTER_ID = '$center_id'";	
				$viewqueryfour="SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = '$customer'";
				
				if($order_id==NULL||$system_id==NULL||$game_id==NULL||$center_id==NULL||$order_date==NULL||$est_date==NULL||$customer_id==NULL)
				{
					$message = "You have not filled out all required infomation";
					echo "<script type='text/javascript'>alert('$message');</script>";
					$error++;
				}
				
				if($system_id!=NULL)
				{
					$r=mysql_query($viewqueryone);
					$num_rows =mysql_num_rows($r);
					if($num_rows==0)
					{
						$message = "You have entered an invalid System ID.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
				}	

				if($game_id!=NULL)
				{
					$r=mysql_query($viewquerytwo);
					$num_rows =mysql_num_rows($r);
					if($num_rows==0)
					{
						$message = "You have entered an invalid Game ID.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
				}
				
				if($center_id!=NULL)
				{
					$r=mysql_query($viewquerythree);
					$num_rows =mysql_num_rows($r);
					if($num_rows==0)
					{
						$message = "You have entered an invalid Center ID.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
				}	
			
				if($customer!=NULL)
				{
					$r=mysql_query($viewqueryfour);
					$num_rows =mysql_num_rows($r);
					if($num_rows==0)
					{
						$message = "You have entered an invalid Customer ID.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
				}
				
				elseif($error==0)
				{
					
					mysql_query("UPDATE `ORDER` SET SYSTEM_ID ='$system_id', GAME_ID ='$game_id', CENTER_ID ='$center_id', ORDER_DATE ='$order_date', EST_ARRIVAL ='$est_date', CUSTOMER_ID ='$customer_id' WHERE ORDER_ID='$order_id'");

					echo '<script type="text/javascript">alert("Order '.$order_id.' has been updated.");</script>';
					
					$query = "SELECT * FROM `ORDER`";			
					$r=mysql_query($query);
						echo "<center>";
						echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
							<tr bgcolor='white'>
							<th>Order ID</th>
							<th>System ID</th>
							<th>Game ID</th>		
							<th>Center ID</th>
							<th>Order Date</th>
							<th>Estimated Arrival Date</th>
							<th>Customer ID</th>
							</tr>";
							while($row=mysql_fetch_array($r))
							{
								
								$order_id = $row['ORDER_ID'];
								$system_id = $row['SYSTEM_ID'];
								$game_id = $row['GAME_ID'];
								$center_id = $row['CENTER_ID'];
								$order_date = $row['ORDER_DATE'];
								$est_date = $row['EST_ARRIVAL'];
								$customer_id = $row['CUSTOMER_ID'];
								
								echo"<tr>";
									echo"<form method='post'>";
										echo"<td>$order_id</td>";
										echo"<input name='order_id' type='hidden' value='".$order_id."' />";
										echo"<td><input name='system_id' type='text' size='3' value='".$system_id."' /></td>";
										echo"<td><input name='game_id' type='text' size='3' value='".$game_id."' /></td>";
										echo"<td><input name='center_id' type='text' size='3' value='".$center_id."' /></td>";
										echo"<td><input name='order_date' type='text' size='12' value='".$order_date."' /></td>";
										echo"<td><input name='est_date' type='text' size='12' value='".$est_date."'/></td>";
										echo"<td><input name='customer_id' type='text' size='6' value='".$customer_id."'/></td>";
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
			
				$query = "SELECT * FROM `ORDER`";			
				$r=mysql_query($query);
					echo "<center>";
					echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
						<tr bgcolor='white'>
						<th>Order ID</th>
						<th>System ID</th>
						<th>Game ID</th>		
						<th>Center ID</th>
						<th>Order Date</th>
						<th>Estimated Arrival Date</th>
						<th>Customer ID</th>
						</tr>";
						while($row=mysql_fetch_array($r))
						{
							
							$order_id = $row['ORDER_ID'];
							$system_id = $row['SYSTEM_ID'];
							$game_id = $row['GAME_ID'];
							$center_id = $row['CENTER_ID'];
							$order_date = $row['ORDER_DATE'];
							$est_date = $row['EST_ARRIVAL'];
							$customer_id = $row['CUSTOMER_ID'];
							
							echo"<tr>";
								echo"<form method='post'>";
									echo"<td>$order_id</td>";
									echo"<input name='order_id' type='hidden' value='".$order_id."' />";
									echo"<td><input name='system_id' type='text' size='3' value='".$system_id."' /></td>";
									echo"<td><input name='game_id' type='text' size='3' value='".$game_id."' /></td>";
									echo"<td><input name='center_id' type='text' size='3' value='".$center_id."' /></td>";
									echo"<td><input name='order_date' type='text' size='12' value='".$order_date."' /></td>";
									echo"<td><input name='est_date' type='text' size='12' value='".$est_date."'/></td>";
									echo"<td><input name='customer_id' type='text' size='6' value='".$customer_id."'/></td>";
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
			Search Order by Order ID: <input name="order_id" type="text" maxlength="3" size="3"/>
			<input name="search_id" type="submit" value="" class="search"/>
		</p>
		<p>
			Search Order by Customer ID: <input name="cust_id" type="text" maxlength="4" size="5"/>		
			<input name="search_cust" type="submit" value="" class="search"/>
		</p>
		<p>
			Search Order by Center ID: <input name="center_id" type="text" maxlength="3" size="3"/>		
			<input name="search_center" type="submit" value="" class="search"/>
		</p>
		<p>
			Search Order by Game ID: <input name="game_id" type="text" maxlength="3" size="3"/>		
			<input name="search_game" type="submit" value="" class="search"/>
		</p>
		<p>
			Search for orders between: <input name="first_date" type="text" class='datepick' id='date_3' maxlength="12" size="12"/>
			and <input name="second_date" type="text" class='datepick' id='date_4' maxlength="12" size="12"/>
			<input name="search_dates" type="submit" value="" class="search"/>
		</p>
		
		<?php
			if(isset($_POST['search_dates']))
			{
				if(empty($_REQUEST['first_date'])||empty($_REQUEST['second_date']))
				{
					echo '<script type="text/javascript">alert("Please enter a value for both dates");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$first_date=$_POST['first_date'];
				$second_date=$_POST['second_date'];
				$query = "SELECT * FROM `ORDER`
				WHERE ORDER_DATE BETWEEN '$first_date' AND '$second_date'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['first_date'])&&!empty($_REQUEST['second_date']))
						{
							$message = "There are currently no games that were ordered between $first_date and $second_date";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{
								$query2 = "SELECT LAST_NAME, FIRST_NAME, GAMES.TITLE, PRICE, DIST_CENTERS.NAME, SYSTEM.NAME AS SYSTEM, ORDER.ORDER_ID, ORDER_DATE, EST_ARRIVAL 
								FROM CUSTOMER, GAMES, DIST_CENTERS, SYSTEM, `ORDER`
								WHERE ORDER_DATE BETWEEN '$first_date' AND '$second_date' AND CUSTOMER.CUSTOMER_ID = ORDER.CUSTOMER_ID AND GAMES.GAME_ID = ORDER.GAME_ID 
								AND SYSTEM.SYSTEM_ID = ORDER.SYSTEM_ID AND DIST_CENTERS.CENTER_ID = ORDER.CENTER_ID AND ORDER.ORDER_ID = ORDER.ORDER_ID ORDER BY ORDER_DATE, ORDER_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Order Date</th>
												<th>Order ID</th>
												<th>Customer</th>
												<th>System</th>
												<th>Shipping From</th>
												<th>Estimated Arrival Date</th>
												<th>Total Cost</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for all orders placed between $first_date and $second_date are displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['ORDER_DATE'] ."</td>";
													echo"<td>" .$row['ORDER_ID'] ."</td>";
													echo"<td>" .$row['FIRST_NAME']. ' ' .$row['LAST_NAME'] ."</td>";
													echo"<td>" .$row['SYSTEM'] ."</td>";
													echo"<td>" .$row['NAME'] ."</td>";
													echo"<td>" .$row['EST_ARRIVAL'] ."</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";	
													echo"</tr>";
												}
										echo "</table>";
									echo"</center>";
								}
								echo "<script type='text/javascript'>$('#accordion').accordion({ active: 2, heightStyle: 'content'});</script>";
						}
					}
				}
			}
		?>
		
		<?php
			if(isset($_POST['search_game']))
			{
				if(empty($_REQUEST['game_id']))
				{
					echo '<script type="text/javascript">alert("Please enter a Game ID");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$game_id=$_POST['game_id'];
				$query = "SELECT * FROM GAMES
				WHERE GAME_ID= '$game_id'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['game_id']))
						{
							$message = "Invalid Game ID";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{
								$query2 = "SELECT LAST_NAME, FIRST_NAME, GAMES.TITLE, PRICE, DIST_CENTERS.NAME, SYSTEM.NAME AS SYSTEM, ORDER.ORDER_ID, ORDER_DATE, EST_ARRIVAL 
								FROM CUSTOMER, GAMES, DIST_CENTERS, SYSTEM, `ORDER`
								WHERE GAMES.GAME_ID='$game_id' AND CUSTOMER.CUSTOMER_ID = ORDER.CUSTOMER_ID AND GAMES.GAME_ID = ORDER.GAME_ID 
								AND SYSTEM.SYSTEM_ID = ORDER.SYSTEM_ID AND DIST_CENTERS.CENTER_ID = ORDER.CENTER_ID AND ORDER.ORDER_ID = ORDER.ORDER_ID ORDER BY ORDER_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Order ID</th>
												<th>Customer</th>
												<th>System</th>
												<th>Shipping From</th>
												<th>Order Date</th>
												<th>Estimated Arrival Date</th>
												<th>Total Cost</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for all ".$row['TITLE']." orders are displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['ORDER_ID'] ."</td>";
													echo"<td>" .$row['FIRST_NAME']. ' ' .$row['LAST_NAME'] ."</td>";
													echo"<td>" .$row['SYSTEM'] ."</td>";
													echo"<td>" .$row['NAME'] ."</td>";
													echo"<td>" .$row['ORDER_DATE'] ."</td>";
													echo"<td>" .$row['EST_ARRIVAL'] ."</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";	
													echo"</tr>";
												}
										echo "</table>";
									echo"</center>";
								}
								echo "<script type='text/javascript'>$('#accordion').accordion({ active: 2, heightStyle: 'content'});</script>";
						}
					}
				}
			}
		?>
		
		<?php
			if(isset($_POST['search_center']))
			{
				if(empty($_REQUEST['center_id']))
				{
					echo '<script type="text/javascript">alert("Please enter a Center ID");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$center_id=$_POST['center_id'];
				$query = "SELECT * FROM DIST_CENTERS
				WHERE CENTER_ID= '$center_id'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['center_id']))
						{
							$message = "Invalid Center ID";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{
								$query2 = "SELECT LAST_NAME, FIRST_NAME, GAMES.TITLE, PRICE, DIST_CENTERS.NAME, SYSTEM.NAME AS SYSTEM, ORDER.ORDER_ID, ORDER_DATE, EST_ARRIVAL 
								FROM CUSTOMER, GAMES, DIST_CENTERS, SYSTEM, `ORDER`
								WHERE DIST_CENTERS.CENTER_ID='$center_id' AND CUSTOMER.CUSTOMER_ID = ORDER.CUSTOMER_ID AND GAMES.GAME_ID = ORDER.GAME_ID 
								AND SYSTEM.SYSTEM_ID = ORDER.SYSTEM_ID AND DIST_CENTERS.CENTER_ID = ORDER.CENTER_ID AND ORDER.ORDER_ID = ORDER.ORDER_ID ORDER BY ORDER_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Order ID</th>
												<th>Customer</th>
												<th>Title</th>
												<th>System</th>
												<th>Order Date</th>
												<th>Estimated Arrival Date</th>
												<th>Total Cost</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for all orders being shipped from ".$row['NAME']." are displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['ORDER_ID'] ."</td>";
													echo"<td>" .$row['FIRST_NAME']. ' ' .$row['LAST_NAME'] ."</td>";
													echo"<td>" .$row['TITLE'] ."</td>";
													echo"<td>" .$row['SYSTEM'] ."</td>";
													echo"<td>" .$row['ORDER_DATE'] ."</td>";
													echo"<td>" .$row['EST_ARRIVAL'] ."</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";	
													echo"</tr>";
												}
										echo "</table>";
									echo"</center>";
								}
								echo "<script type='text/javascript'>$('#accordion').accordion({ active: 2, heightStyle: 'content'});</script>";
						}
					}
				}
			}
		?>
		
		<?php
			if(isset($_POST['search_id']))
			{
				if(empty($_REQUEST['order_id']))
				{
					echo '<script type="text/javascript">alert("Please enter an Order ID");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$order_id=$_POST['order_id'];
				$query = "SELECT * FROM `ORDER`
				WHERE ORDER_ID= '$order_id'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['order_id']))
						{
							$message = "Invalid Order ID";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{
								$query2 = "SELECT LAST_NAME, FIRST_NAME, GAMES.TITLE, PRICE, DIST_CENTERS.NAME, SYSTEM.NAME AS SYSTEM, ORDER.ORDER_DATE, EST_ARRIVAL 
								FROM CUSTOMER, GAMES, DIST_CENTERS, SYSTEM, `ORDER`
								WHERE ORDER_ID='$order_id' AND CUSTOMER.CUSTOMER_ID = ORDER.CUSTOMER_ID AND GAMES.GAME_ID = ORDER.GAME_ID 
								AND SYSTEM.SYSTEM_ID = ORDER.SYSTEM_ID AND DIST_CENTERS.CENTER_ID = ORDER.CENTER_ID AND ORDER.ORDER_ID = ORDER.ORDER_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Customer</th>
												<th>Game Title</th>
												<th>System</th>
												<th>Shipping From</th>
												<th>Order Date</th>
												<th>Estimated Arrival Date</th>
												<th>Total Cost</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for Order ID ".$row['ORDER_ID']." is displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['FIRST_NAME']. ' ' .$row['LAST_NAME'] ."</td>";
													echo"<td>" .$row['TITLE'] ."</td>";
													echo"<td>" .$row['SYSTEM'] ."</td>";
													echo"<td>" .$row['NAME'] ."</td>";
													echo"<td>" .$row['ORDER_DATE'] ."</td>";
													echo"<td>" .$row['EST_ARRIVAL'] ."</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";	
													echo"</tr>";
												}
										echo "</table>";
									echo"</center>";
								}
								echo "<script type='text/javascript'>$('#accordion').accordion({ active: 2, heightStyle: 'content'});</script>";
						}
					}
				}
			}
		?>

		<?php
			if(isset($_POST['search_cust']))
			{
				if(empty($_REQUEST['cust_id']))
				{
					echo '<script type="text/javascript">alert("Please enter a Customer ID");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$cust_id=$_POST['cust_id'];
				$query = "SELECT * FROM CUSTOMER
				WHERE CUSTOMER_ID= '$cust_id'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['cust_id']))
						{
							$message = "Invalid Customer ID";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{
								$query2 = "SELECT LAST_NAME, FIRST_NAME, GAMES.TITLE, PRICE, DIST_CENTERS.NAME, SYSTEM.NAME AS SYSTEM, ORDER.ORDER_ID, ORDER_DATE, EST_ARRIVAL 
								FROM `ORDER`, GAMES, DIST_CENTERS, SYSTEM, CUSTOMER
								WHERE CUSTOMER.CUSTOMER_ID='$cust_id' AND CUSTOMER.CUSTOMER_ID = ORDER.CUSTOMER_ID AND GAMES.GAME_ID = ORDER.GAME_ID 
								AND SYSTEM.SYSTEM_ID = ORDER.SYSTEM_ID AND DIST_CENTERS.CENTER_ID = ORDER.CENTER_ID AND ORDER.ORDER_ID = ORDER.ORDER_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Order ID</th>
												<th>Game Title</th>
												<th>System</th>
												<th>Shipping From</th>
												<th>Order Date</th>
												<th>Estimated Arrival Date</th>
												<th>Total Cost</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for " .$row['FIRST_NAME']. ' ' .$row['LAST_NAME'] ."'s order is displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['ORDER_ID'] ."</td>";
													echo"<td>" .$row['TITLE'] ."</td>";
													echo"<td>" .$row['SYSTEM'] ."</td>";
													echo"<td>" .$row['NAME'] ."</td>";
													echo"<td>" .$row['ORDER_DATE'] ."</td>";
													echo"<td>" .$row['EST_ARRIVAL'] ."</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";	
													echo"</tr>";
												}
										echo "</table>";
									echo"</center>";
								}
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