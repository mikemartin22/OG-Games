<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>OG Games - Games</title>
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
	<img alt="games button" src="buttons/games.JPG" />
	<a href="genres.php"><img alt="genres button" class="genres" src="buttons/genres.JPG" /></a><br />
	<a href="order.php"><img alt="order button" class="order" src="buttons/order.JPG" /></a>
	<a href="publisher.php"><img alt="publisher button" class="publisher" src="buttons/publisher.JPG" /></a>
	<a href="system.php"><img alt="system button" class="system" src="buttons/system.JPG" /></a>
</div>

<br />
<div align="center" style="background-color: white; margin: 0px 375px 0px 375px">	
	<h1>Games</h1>
</div>
<div id="accordion" style="background-color: white; margin: 0px 100px 0px 100px">

	<h3>Insert a new Game</h3>
	<div>
		<form method="post" enctype="multipart/form-data">
		
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
					$title=$_POST['title'];
					$price=$_POST['price'];
					$rel_date=$_POST['rel_date'];
					$genre=$_POST['genre'];
					$publish=$_POST['publish'];
					
					$error=0;
					
					$file = $_FILES['image']['tmp_name'];
					$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					$image_name = addslashes($_FILES['image']['name']);
					$image_size = getimagesize($_FILES['image']['tmp_name']);
					if ($image_size == FALSE) 
					{
						$message = "You did not upload an image";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
					
					$viewqueryone="SELECT * FROM GENRES WHERE GENRE_ID = '$genre'";
					$viewquerytwo="SELECT * FROM PUBLISHER WHERE PUB_ID = '$publish'";
					
					if($title==NULL||$price==NULL||$rel_date==NULL||$genre==NULL||$publish==NULL)
					{
						$message = "You have not filled out all required infomation";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
					
					if(!is_numeric($price)&&$price!=NULL)
					{
						$message = "You have entered an invalid price. Please enter a numeric value.";
						echo "<script type='text/javascript'>alert('$message');</script>";	
						$error++;					
					}					
					if($genre!=NULL)
					{
						$r=mysql_query($viewqueryone);
						$num_rows =mysql_num_rows($r);
						if($num_rows==0)
						{
							$message = "You have entered an invalid Genre ID.";
							echo "<script type='text/javascript'>alert('$message');</script>";
							$error++;
						}
					}	

					if($publish!=NULL)
					{
						$r=mysql_query($viewquerytwo);
						$num_rows =mysql_num_rows($r);
						if($num_rows==0)
						{
							$message = "You have entered an invalid Publisher ID.";
							echo "<script type='text/javascript'>alert('$message');</script>";
							$error++;
						}
					}
					
					if($error==0)
					{
						$myquery = mysql_query("SELECT MAX(GAME_ID) FROM GAMES");
						$myrow = mysql_fetch_assoc($myquery);	
						$new_id = $myrow['MAX(GAME_ID)'];				
						$new_id = $new_id + 1;
							
						$query= mysql_query("INSERT INTO GAMES VALUES ('$new_id','$title','$price','$rel_date','$genre','$publish','$image')");
						$viewquery= "SELECT * FROM GAMES WHERE GAME_ID = '$new_id'";

						if($r=mysql_query($viewquery))
						{
							echo "<center>";
								echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
									<tr bgcolor='white'>
										<th>Title</th>
										<th>Price</th>		
										<th>Release Date</th>
										<th>Genre ID</th>
										<th>Publisher ID</th>
										<th>Game Image</th>
									</tr>";
										$row=mysql_fetch_array($r);


										echo"<p>Insertion successful. <br />The new data for Game ID ".$row['GAME_ID']." is displayed below.</p>";
										echo"<tr>";
										echo"<td>" .$row['TITLE'] ."</td>";
										echo"<td>$" .number_format($row['PRICE'],2) ."</td>";
										echo"<td>" .$row['RELEASE_DATE'] ."</td>";
										echo"<td>" .$row['GENRE_ID'] ."</td>";
										echo"<td>" .$row['PUB_ID'] ."</td>";
										echo"<td><img src='getImage.php?id=".$row['GAME_ID']."' width=140 height=180 /></td>";
									echo"</tr>";
								echo "</table>";
							echo"</center>";
							echo"<br/><br/>";
							$title=NULL;
							$price=NULL;
							$rel_date=NULL;
							$genre=NULL;
							$publish=NULL;
							$image=NULL;
						}		
					}
				}	
			?>
			Title: <input name="title" type="text" size="20" value="<?php echo $title; ?>"/><br /><br />
			Price: <input name="price" type="text" size="6" value="<?php echo $price; ?>"/><br /><br />
			Release Date: <input name="rel_date" type="text" class="datepick" id="date_1" size="12" value="<?php echo $rel_date; ?>"/><br /><br />
			Genre ID: <input name="genre" type="text" size="4" value="<?php echo $genre; ?>"/><br /><br />	
			Publisher ID: <input name="publish" type="text" size="4" value="<?php echo $publish; ?>"/><br /><br />			
			Game Image: <input type="file" name="image"><br /><br />	
			<input name="insert" type="submit" value="" class="insert"/>
		</form>
	</div>

	<h3>All Games Data</h3>
	<div>

		<?php
			
			if(isset($_POST['delete']))
			{
				$game_id=$_POST['game_id'];
				
				mysql_query("DELETE FROM GAMES WHERE GAME_ID='$game_id'");
				
				echo '<script type="text/javascript">alert("Game '.$game_id.' has been deleted.");</script>';
				
				$query = "SELECT * FROM GAMES";			
				$r=mysql_query($query);
					echo "<center>";
					echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
						<tr bgcolor='white'>
							<th>Game ID</th>
							<th>Title</th>
							<th>Price</th>		
							<th>Release Date</th>
							<th>Genre ID</th>
							<th>Publisher ID</th>
							<th>Game Image</th>
						</tr>";
						
						while($row=mysql_fetch_array($r))
						{
							$game_id = $row['GAME_ID'];
							$title = $row['TITLE'];
							$price = $row['PRICE'];
							$rel_date = $row['RELEASE_DATE'];
							$genre = $row['GENRE_ID'];
							$publish = $row['PUB_ID'];
							
							echo"<tr>";
								echo"<form method='post' enctype='multipart/form-data'>";
									echo"<td>$game_id</td>";
									echo"<input name='game_id' type='hidden' value='".$game_id."' />";
									echo"<td><input name='title' type='text' size='20' value='".$title."' /></td>";
									echo"<td><input name='price' type='text' size='6' value='".$price."' /></td>";
									echo"<td><input name='rel_date' type='text' size='12' value='".$rel_date."' /></td>";
									echo"<td><input name='genre' type='text' size='3' value='".$genre."' /></td>";
									echo"<td><input name='publish' type='text' size='3' value='".$publish."'/></td>";
									echo"<td><br/>Are you updating this image?<br/><br/><input type='radio' name='picture' value='yes'/>Yes
										<input type='radio' name='picture' value='no'/>No<br/><br/>
										<input type='file' name='image'><br/><br/><br/>
										<img src='getImage.php?id=".$game_id."' width=140 height=180 /></td>";
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
				$game_id=$_POST['game_id'];
				$title=$_POST['title'];
				$price=$_POST['price'];
				$rel_date=$_POST['rel_date'];
				$genre=$_POST['genre'];
				$publish=$_POST['publish'];
				$picture=$_POST['picture'];
				$error=0;
				
				if ($picture=='yes')
				{
					$file = $_FILES['image']['tmp_name'];
					$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					$image_name = addslashes($_FILES['image']['name']);
					$image_size = getimagesize($_FILES['image']['tmp_name']);
				}
				
				if ($picture!='yes'&&$picture!='no')
				{
					$message = "Please select whether or not you are going to replace the game image";
					echo "<script type='text/javascript'>alert('$message');</script>";
					$error++;
				}
				
				$viewqueryone="SELECT * FROM GENRES WHERE GENRE_ID = '$genre'";
				$viewquerytwo="SELECT * FROM PUBLISHER WHERE PUB_ID = '$publish'";
				
				if($title==NULL||$price==NULL||$rel_date==NULL||$genre==NULL||$publish==NULL)
				{
					$message = "You have not filled out all required infomation";
					echo "<script type='text/javascript'>alert('$message');</script>";
					$error++;
				}
				
				if(!is_numeric($price)&&$price!=NULL)
				{
					$message = "You have entered an invalid price. Please enter a numeric value.";
					echo "<script type='text/javascript'>alert('$message');</script>";	
					$error++;					
				}					
				if($genre!=NULL)
				{
					$r=mysql_query($viewqueryone);
					$num_rows =mysql_num_rows($r);
					if($num_rows==0)
					{
						$message = "You have entered an invalid Genre ID.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
				}	

				if($publish!=NULL)
				{
					$r=mysql_query($viewquerytwo);
					$num_rows =mysql_num_rows($r);
					if($num_rows==0)
					{
						$message = "You have entered an invalid Publisher ID.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$error++;
					}
				}
					
				if($error==0)
				{
					if ($picture=='no') 
					{
						mysql_query("UPDATE GAMES SET TITLE ='$title', PRICE ='$price', RELEASE_DATE ='$rel_date', GENRE_ID ='$genre', PUB_ID ='$publish' WHERE GAME_ID='$game_id'");
					}
					else
					{
						mysql_query("UPDATE GAMES SET TITLE ='$title', PRICE ='$price', RELEASE_DATE ='$rel_date', GENRE_ID ='$genre', PUB_ID ='$publish', IMAGE ='$image' WHERE GAME_ID='$game_id'");
					}

					echo '<script type="text/javascript">alert("Game '.$game_id.' has been updated.");</script>';
					
					$query = "SELECT * FROM GAMES";			
					$r=mysql_query($query);
						echo "<center>";
						echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
							<tr bgcolor='white'>
							<th>Game ID</th>
							<th>Title</th>
							<th>Price</th>		
							<th>Release Date</th>
							<th>Genre ID</th>
							<th>Publisher ID</th>
							<th>Game Image</th>
							</tr>";
							while($row=mysql_fetch_array($r))
							{
								
								$game_id = $row['GAME_ID'];
								$title = $row['TITLE'];
								$price = $row['PRICE'];
								$rel_date = $row['RELEASE_DATE'];
								$genre = $row['GENRE_ID'];
								$publish = $row['PUB_ID'];
								
								echo"<tr>";
									echo"<form method='post' enctype='multipart/form-data'>";
										echo"<td>$game_id</td>";
										echo"<input name='game_id' type='hidden' value='".$game_id."' />";
										echo"<td><input name='title' type='text' size='20' value='".$title."' /></td>";
										echo"<td><input name='price' type='text' size='6' value='".$price."' /></td>";
										echo"<td><input name='rel_date' type='text' size='12' value='".$rel_date."' /></td>";
										echo"<td><input name='genre' type='text' size='3' value='".$genre."' /></td>";
										echo"<td><input name='publish' type='text' size='3' value='".$publish."'/></td>";
										echo"<td><br/>Are you updating this image?<br/><br/><input type='radio' name='picture' value='yes'/>Yes
											<input type='radio' name='picture' value='no'/>No<br/><br/>
											<input type='file' name='image'><br/><br/><br/>
											<img src='getImage.php?id=".$game_id."' width=140 height=180 /></td>";
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
			
				$query = "SELECT * FROM GAMES";			
				$r=mysql_query($query);
					echo "<center>";
					echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
						<tr bgcolor='white'>
						<th>Game ID</th>
						<th>Title</th>
						<th>Price</th>		
						<th>Release Date</th>
						<th>Genre ID</th>
						<th>Publisher ID</th>
						<th>Game Image</th>
						</tr>";
						while($row=mysql_fetch_array($r))
						{
							
							$game_id = $row['GAME_ID'];
							$title = $row['TITLE'];
							$price = $row['PRICE'];
							$rel_date = $row['RELEASE_DATE'];
							$genre = $row['GENRE_ID'];
							$publish = $row['PUB_ID'];
							
							echo"<tr>";
								echo"<form method='post' enctype='multipart/form-data'>";
									echo"<td>$game_id</td>";
									echo"<input name='game_id' type='hidden' value='".$game_id."' />";
									echo"<td><input name='title' type='text' size='20' value='".$title."' /></td>";
									echo"<td><input name='price' type='text' size='6' value='".$price."' /></td>";
									echo"<td><input name='rel_date' type='text' size='12' value='".$rel_date."' /></td>";
									echo"<td><input name='genre' type='text' size='3' value='".$genre."' /></td>";
									echo"<td><input name='publish' type='text' size='3' value='".$publish."'/></td>";
									echo"<td><br/>Are you updating this image?<br/><br/><input type='radio' name='picture' value='yes'/>Yes
										<input type='radio' name='picture' value='no'/>No<br/><br/>
										<input type='file' name='image'><br/><br/><br/>
										<img src='getImage.php?id=".$game_id."' width=140 height=180 /></td>";
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
			Search for Games by title: <input name="title" type="text" id="titles" maxlength="25" size="20"/>
			<input name="search_title" type="submit" value="" class="search"/>
		</p>
		<p>
			Search Game by Game ID: <input name="game_id" type="text" maxlength="3" size="3"/>
			<input name="search_id" type="submit" value="" class="search"/>
		</p>
		<p>
			Search Game by Publisher ID: <input name="pub_id" type="text" maxlength="3" size="3"/>		
			<input name="search_pub" type="submit" value="" class="search"/>
		</p>
		<p>
			Search Game by Genre ID: <input name="genre_id" type="text" maxlength="3" size="3"/>		
			<input name="search_genre" type="submit" value="" class="search"/>
		</p>
		<p>
			Search for Games released between: <input name="first_date" type="text" class='datepick' id='date_3' maxlength="12" size="12"/>
			and <input name="second_date" type="text" class='datepick' id='date_4' maxlength="12" size="12"/>
			<input name="search_dates" type="submit" value="" class="search"/>
		</p>
		
		<?php
			if(isset($_POST['search_title']))
			{
				if(empty($_REQUEST['title']))
				{
					echo '<script type="text/javascript">alert("Please enter a Title");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$title=$_POST['title'];
				$query = "SELECT * FROM GAMES
				WHERE TITLE= '$title'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['title']))
						{
							$message = "Invalid Title";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{
								$query2 = "SELECT GAME_ID, TITLE, PRICE, RELEASE_DATE, GENRES.GENRE, PUBLISHER.NAME
								FROM GAMES, GENRES, PUBLISHER
								WHERE TITLE='$title' AND GAMES.GENRE_ID = GENRES.GENRE_ID AND GAMES.PUB_ID = PUBLISHER.PUB_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Game ID</th>
												<th>Price</th>
												<th>Release Date</th>
												<th>Genre</th>
												<th>Publisher</th>
												<th>Game Image</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for ".$row['TITLE']." is displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['GAME_ID']. "</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";
													echo"<td>" .$row['RELEASE_DATE'] ."</td>";
													echo"<td>" .$row['GENRE'] ."</td>";
													echo"<td>" .$row['NAME'] ."</td>";
													echo"<td><br/><img src='getImage.php?id=".$game_id."' width=140 height=180 /></td>";													
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
								$query2 = "SELECT TITLE, PRICE, RELEASE_DATE, GENRES.GENRE, PUBLISHER.NAME
								FROM GAMES, GENRES, PUBLISHER
								WHERE GAME_ID='$game_id' AND GAMES.GENRE_ID = GENRES.GENRE_ID AND GAMES.PUB_ID = PUBLISHER.PUB_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Title</th>
												<th>Price</th>
												<th>Release Date</th>
												<th>Genre</th>
												<th>Publisher</th>
												<th>Game Image</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for Game ID ".$row['GAME_ID']." is displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['TITLE']. "</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";
													echo"<td>" .$row['RELEASE_DATE'] ."</td>";
													echo"<td>" .$row['GENRE'] ."</td>";
													echo"<td>" .$row['NAME'] ."</td>";
													echo"<td><br/><img src='getImage.php?id=".$game_id."' width=140 height=180 /></td>";													
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
			if(isset($_POST['search_pub']))
			{
				if(empty($_REQUEST['pub_id']))
				{
					echo '<script type="text/javascript">alert("Please enter a Publisher ID");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$pub_id=$_POST['pub_id'];
				$query = "SELECT * FROM PUBLISHER
				WHERE PUB_ID= '$pub_id'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['pub_id']))
						{
							$message = "Invalid Publisher ID";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{
								$query2 = "SELECT GAME_ID, TITLE, PRICE, RELEASE_DATE, GENRES.GENRE, PUBLISHER.NAME
								FROM GAMES, GENRES, PUBLISHER
								WHERE PUBLISHER.PUB_ID='$pub_id' AND GAMES.GENRE_ID = GENRES.GENRE_ID AND GAMES.PUB_ID = PUBLISHER.PUB_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Game ID</th>
												<th>Title</th>
												<th>Price</th>
												<th>Release Date</th>
												<th>Genre</th>
												<th>Game Image</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for all games published by ".$row['NAME']." are displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['GAME_ID']. "</td>";
													echo"<td>" .$row['TITLE']. "</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";
													echo"<td>" .$row['RELEASE_DATE'] ."</td>";
													echo"<td>" .$row['GENRE'] ."</td>";
													echo"<td><br/><img src='getImage.php?id=".$row['GAME_ID']."' width=140 height=180 /></td>";													
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
			if(isset($_POST['search_genre']))
			{
				if(empty($_REQUEST['genre_id']))
				{
					echo '<script type="text/javascript">alert("Please enter a Genre ID");</script>';
					echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
				}
				else 
				{
				$genre_id=$_POST['genre_id'];
				$query = "SELECT * FROM GENRES
				WHERE GENRE_ID= '$genre_id'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['genre_id']))
						{
							$message = "Invalid Genre ID";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{
								$query2 = "SELECT GAME_ID, TITLE, PRICE, RELEASE_DATE, GENRES.GENRE, PUBLISHER.NAME
								FROM GAMES, GENRES, PUBLISHER
								WHERE GENRES.GENRE_ID='$genre_id' AND GAMES.GENRE_ID = GENRES.GENRE_ID AND GAMES.PUB_ID = PUBLISHER.PUB_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Game ID</th>
												<th>Title</th>
												<th>Price</th>
												<th>Release Date</th>
												<th>Publisher</th>
												<th>Game Image</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for all  ".$row['GENRE']." games are displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['GAME_ID']. "</td>";
													echo"<td>" .$row['TITLE']. "</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";
													echo"<td>" .$row['RELEASE_DATE'] ."</td>";
													echo"<td>" .$row['NAME'] ."</td>";
													echo"<td><br/><img src='getImage.php?id=".$row['GAME_ID']."' width=140 height=180 /></td>";													
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
				$query = "SELECT * FROM GAMES
				WHERE RELEASE_DATE BETWEEN '$first_date' AND '$second_date'";

					if($r=mysql_query($query))
					{
						$num_rows =mysql_num_rows($r);
						if($num_rows==0&&!empty($_REQUEST['first_date'])&&!empty($_REQUEST['second_date']))
						{
							$message = "There were no games released between $first_date and $second_date";
							echo "<script type='text/javascript'>alert('$message');</script>";
							echo "<script type='text/javascript'>$('#accordion').accordion({active: 2, heightStyle: 'content'});</script>";
						}
						else
						{
								$query2 = "SELECT GAME_ID, TITLE, PRICE, RELEASE_DATE, GENRES.GENRE, PUBLISHER.NAME
								FROM GAMES, GENRES, PUBLISHER
								WHERE GAMES.RELEASE_DATE BETWEEN '$first_date' AND '$second_date' AND GAMES.GENRE_ID = GENRES.GENRE_ID AND GAMES.PUB_ID = PUBLISHER.PUB_ID ORDER BY RELEASE_DATE, GAME_ID";
								if($r2=mysql_query($query2))
								{
									echo "<center>";
										echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: black; border-style: outset; padding: 5px; text-align:center'>
											<tr bgcolor='white'>
												<th>Release Date</th>
												<th>Game ID</th>
												<th>Title</th>
												<th>Price</th>
												<th>Publisher</th>
												<th>Game Image</th>
											</tr>";
												$row=mysql_fetch_array($r);
												echo"<p>The data for all games released between $first_date and $second_date are displayed below.</p>";
												while($row=mysql_fetch_array($r2))
												{
													echo"<tr>";
													echo"<td>" .$row['RELEASE_DATE'] ."</td>";
													echo"<td>" .$row['GAME_ID']. "</td>";
													echo"<td>" .$row['TITLE']. "</td>";
													echo"<td>$" .number_format($row['PRICE'],2) ."</td>";
													echo"<td>" .$row['NAME'] ."</td>";
													echo"<td><br/><img src='getImage.php?id=".$row['GAME_ID']."' width=140 height=180 /></td>";													
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