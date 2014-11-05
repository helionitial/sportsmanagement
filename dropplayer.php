<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "Drop Player"
);
require_once "header.php";


?>

	<?php	
		
		if (isset($_GET['tn'], $_GET['uid'])) {
			$tn = $_GET['tn'];
			$uid = $_GET['uid'];	
		}
		
		//Get teamid
		$sql="SELECT team_id FROM Team WHERE team_name='".$tn."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$tid = mysql_result($result, 0);
		
		//Delete Sport
		$sql = "DELETE FROM member_of WHERE user_id='".$uid."' AND team_id='".$tid."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());

		//Redirect back to getteam.php
		header("Location: getteam.php?teamname=".$tn."");//?leaguetype='".$leaguetype."'&sport='".$sport."'&submit=Set+League");
	

	?>
		