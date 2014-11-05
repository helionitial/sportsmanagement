<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "Add League"
);
require_once "header.php";


?>

	<?php	
		
		$leaguetype = $_GET['leaguetype'];
		$sport = $_GET['sport'];			
		$leagueid = $_GET['leagueid'];
		$start = $_GET['start'];
		$end = $_GET['end'];
		$reg = $_GET['reg'];
		
		//echo $leagueid . $leaguetype . $sport;
		
	
		//Create new game... insert into League
		$sql = "INSERT INTO League (league_id, league_type, sport_name) 
			VALUES ('".$leagueid."', '".$leaguetype."', '".$sport."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$sql = "INSERT INTO divided_into (sport_name, league_id) 
			VALUES ('".$sport."', '".$leagueid."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$sql = "INSERT INTO Schedule (league_id, start_date, end_date, reg_deadline) 
			VALUES ('".$leagueid."', '".$start."', '".$end."', '".$reg."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		
		
		//Redirect back to leagues.php
		header("Location: leagues.php");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
		

	?>
		
			
		