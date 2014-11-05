<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "Edit Stats"
);
require_once "header.php";


?>

	<?php	
		$tn = $_GET['tn'];
		$played = $_GET['played'];
		$wins = $_GET['wins'];
		$losses = $_GET['losses'];			
	    $draws = $_GET['draws'];	
		$ncs = $_GET['ncs'];
		
		$sql = "SELECT team_id FROM Team WHERE team_name='".$tn."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$tid = mysql_result($result, 0);
		
		//Update game... 
		$sql = "UPDATE Stats SET played='".$played."', wins='".$wins."', losses='".$losses."', draws='".$draws."', ncs='".$ncs."' WHERE team_id='".$tid."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		//$sql = "SELECT game_id FROM Game WHERE game_date='".$date."' AND game_time='".$time."' AND game_location='".$location."';";
		
		
		//Redirect back to getteam.php
		header("Location: getteam.php?teamname=".$tn."");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
		

	?>
		
			
		