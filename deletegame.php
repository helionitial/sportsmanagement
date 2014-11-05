<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "View Team"
);
require_once "header.php";


?>

	<?php	
		
		if (isset($_GET['date'], $_GET['time'], $_GET['loc'])) {
		
			$date = $_GET['date'];
			$time = $_GET['time'];
			$location = $_GET['loc'];	
		
			echo "Date: " . $date . "<br>";
			echo "Time: " . $time . "<br>";
			echo "Location: " . $location . "<br>";
		}
		
		
	
		

		
		//Delete Game
		$sql = "DELETE FROM Game WHERE game_date='".$date."' AND game_time='".$time."' AND game_location='".$location."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
/*		$sql = "SELECT game_id FROM Game WHERE game_date='".$date."' AND game_time='".$time."' AND game_location='".$location."';";
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
		
*/			
		//Redirect back to game.php
		header("Location: game.php");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
	

	?>
		