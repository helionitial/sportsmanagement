<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "Edit Game"
);
require_once "header.php";


?>

	<?php	
		
		$lid = $_GET['lid'];
		$sport = $_GET['sport'];			
		$lt = $_GET['lt'];
		$start = $_GET['start'];
		$end = $_GET['end'];			
		$reg = $_GET['reg'];
	
	
		
		echo "League ID: " . $lid . "<br>";
		echo "League Type: " . $lt . "<br>";
		echo "Sport: " . $sport . "<br>";
		echo "Start: " . $start . "<br>";
		echo "End: " . $end . "<br>";
		echo "Registration Deadline: " . $reg . "<br>";
		
		
		//Update league... 
		$sql = "UPDATE League 
			SET league_type='".$lt."', sport_name='".$sport."'
			WHERE league_id='".$lid."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
//		$sql = "SELECT game_id FROM Game WHERE game_date='".$date."' AND game_time='".$time."' AND game_location='".$location."';";
		
		$sql = "UPDATE Schedule 
			SET start_date='".$start."', end_date='".$end."', reg_deadline='".$reg."'
			WHERE league_id='".$lid."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());

		
		//Redirect back to leagues.php
		header("Location: leagues.php");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
		

	?>
		
			
		