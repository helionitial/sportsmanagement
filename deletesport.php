<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "View Team"
);
require_once "header.php";


?>

	<?php	
		
		if (isset($_GET['mr'], $_GET['sport'])) {
			$mr = $_GET['mr'];
			$sport = $_GET['sport'];	
		}
		
		//Delete Sport
		$sql = "DELETE FROM Sport WHERE sport_name='".$sport."' AND min_roster='".$mr."';";
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
		//Redirect back to sports.php
		header("Location: sports.php");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
	

	?>
		