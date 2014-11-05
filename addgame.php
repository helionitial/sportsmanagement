<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "View Team"
);
require_once "header.php";


?>

	<?php	
		
		$leaguetype = $_GET['leaguetype'];
		$sport = $_GET['sport'];			
		$date = $_GET['date'];
		$time = $_GET['time'];
		//$ampm = $_GET['ampm'];
		$location = $_GET['loc'];
		$team1 = $_GET['team1'];
		$team2 = $_GET['team2'];
		
		echo "Date: " . $date . "<br>";
		echo "time: " . $time . "<br>";
		//echo "ampm: " . $ampm . "<br>";
		echo "location: " . $location . "<br>";
		echo "team1: " . $team1 . "<br>";
		echo "team2: " . $team2 . "<br>";
		
		//Insert into Game
		$sql = "INSERT INTO Game (game_date, game_time, game_location, team1_id, team2_id, team1_score, team2_score) 
			VALUES ('".$date."', '".$time."', '".$location."', '".$team1."', '".$team2."', '0', '0');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$sql = "SELECT game_id FROM Game WHERE game_date='".$date."' AND game_time='".$time."' AND game_location='".$location."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$row = mysql_fetch_assoc($result);
		
		$game_id = $row["game_id"];	
		
		//GET League ID
		$sql = "SELECT league_id FROM League NATURAL JOIN arranges WHERE league_type='".$leaguetype."' AND sport_name='".$sport."' LIMIT 1;"; 
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$league_id = mysql_result($result, 0);
		echo $league_id;
	
		//INSERT game into arranges
		$sql = "INSERT INTO arranges (league_id, game_id) 
			VALUES ('".$league_id."', '".$game_id."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		
		
		//Redirect back to game.php
		header("Location: game.php");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
		

	?>
		
			
		