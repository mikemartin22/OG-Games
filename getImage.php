<?php

ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);

if ($connection = @mysql_connect ('localhost', 'MM1238', 'elvis921')){
	 
}
else {
	die('<p>Could not connect to MySQL because: <b>' .mysql_error() .
	'</b></p>');
}
if (@mysql_select_db("MM1238_PROJECT2", $connection)){

}
else {
	die('<p>Cound not select the _PROJECT2 database because: <b>' .mysql_error().'</b></p>');
}


$id = $_REQUEST['id'];


$image = mysql_query("SELECT * FROM GAMES WHERE GAME_ID = $id");
$imageArray=mysql_fetch_assoc($image);
$image=$imageArray['IMAGE'];


$filename=$imageArray['NAME'];
$ext=end(explode('.',$filename));
header("content-type:$ext");
echo $image;


?>