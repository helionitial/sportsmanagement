<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "Add Sport"
);
require_once "header.php";


?>

	<?php	
		

		$sport = $_GET['sport'];			
		$mr = $_GET['mr'];
		
		//echo $leagueid . $leaguetype . $sport;
		
	
		//Create new game... insert into Sport
		$sql = "INSERT INTO Sport (sport_name, min_roster) 
			VALUES ('".$sport."', '".$mr."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		
		
		//Redirect back to sports.php
		header("Location: sports.php");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
		

	?>
		
			
		