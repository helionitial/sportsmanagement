<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "Edit Game"
);
require_once "header.php";


?>

	<?php	
		
		$leaguetype = $_GET['leaguetype'];
		$sport = $_GET['sport'];			
		$date = $_GET['date'];
		$time = $_GET['time'];
		$location = $_GET['loc'];
		$team1 = $_GET['team1'];
		$score1= $_GET['s1'];
		$score2 = $_GET['s2'];
		$team2 = $_GET['team2'];
		
		echo "Date: " . $date . "<br>";
		echo "time: " . $time . "<br>";
		echo "location: " . $location . "<br>";
		echo "team1: " . $team1 . "<br>";
		echo "team1score: " . $score1 . "<br>";
		echo "team2score: " . $score2 . "<br>";
		echo "team2: " . $team2 . "<br>";

		
		//Update game... 
		$sql = "UPDATE Game 
			SET game_date='".$date."', game_time='".$time."', game_location='".$location."', team1_id='".$team1."', team2_id='".$team2."', team1_score='".$score1."', team2_score='".$score2."' 
			WHERE game_id='".$_GET['gameid']."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$sql = "SELECT game_id FROM Game WHERE game_date='".$date."' AND game_time='".$time."' AND game_location='".$location."';";
		
		
		//Redirect back to game.php
		header("Location: game.php");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
		

	?>
		
			
		