<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "Add Player"
);
require_once "header.php";


?>

	<?php	
		
		$tn = $_GET['tn'];
		$uid = $_GET['userid'];
		
		$sql = "SELECT team_id FROM Team WHERE team_name='".$tn."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$tid = mysql_result($result,0);
		
		//Insert into member_of
		$sql = "INSERT INTO member_of (user_id, team_id) 
			VALUES ('".$uid."', '".$tid."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		
		//Redirect back to getteam.php
		header("Location: getteam.php?teamname=".$tn."");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
		

	?>
		
			
		