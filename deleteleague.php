<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "View Team"
);
require_once "header.php";


?>

	<?php	
		
		if (isset($_GET['lid'], $_GET['lt'], $_GET['sport'])) {
		
			$lid = $_GET['lid'];
			$lt = $_GET['lt'];
			$sport = $_GET['sport'];	
		
			echo "League ID: " . $lid . "<br>";
			echo "League type: " . $lt . "<br>";
			echo "Sport: " . $sport . "<br>";
		}
		
		
	
		

	
		//Delete League
		$sql = "DELETE FROM League WHERE league_id='".$lid."' AND league_type='".$lt."' AND sport_name='".$sport."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
/*			$sql = "SELECT game_id FROM Game WHERE game_date='".$date."' AND game_time='".$time."' AND game_location='".$location."';";
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
		//Redirect back to leagues.php
		header("Location: leagues.php");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
	

	?>
		