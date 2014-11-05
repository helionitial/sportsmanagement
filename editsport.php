<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "Edit Sport"
);
require_once "header.php";


?>

	<?php	
		
		$mr = $_GET['mr'];
		$sport = $_GET['sport'];			
		
		
	

		
		//Update game... 
		$sql = "UPDATE Sport SET min_roster='".$mr."' WHERE sport_name='".$sport."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		//$sql = "SELECT game_id FROM Game WHERE game_date='".$date."' AND game_time='".$time."' AND game_location='".$location."';";
		
		
		//Redirect back to sports.php
		header("Location: sports.php");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
		

	?>
		
			
		