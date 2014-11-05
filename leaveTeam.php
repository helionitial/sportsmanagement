<?php
require_once "dbconnect.php";
require_once "header.php";
$teamid=$_GET["tid"];
$leagueid=$_GET["lid"];

//$teamid="3";
//$leagueid="111";

$userid = $_SESSION['user'];
//echo $userid;
//$sql="CALL LeagueTeamsFull('".$leaguetype."','".$sport."')";
//$sql="SELECT * FROM Team NATURAL JOIN contest NATURAL JOIN League WHERE league_type='".$leaguetype."' AND sport_name='".$sport."'";

$sql="SELECT * FROM member_of NATURAL JOIN contest WHERE league_id=".$leagueid." AND user_id=".$userid.";";

$result = mysql_query($sql);


	$sql="DELETE FROM member_of WHERE user_id='".$userid."' AND team_id='".$teamid."';";
	$result = mysql_query($sql);

	$sql="SELECT * FROM Captain WHERE captain='".$userid."' AND team_id='".$teamid."';";
	$result = mysql_query($sql);
	
	if (mysql_num_rows($result) != 0){ 
		$sql="DELETE FROM Team WHERE team_id='".$teamid."';";
		$result = mysql_query($sql);	
	}

	header("Location: myTeams.php");

		    
?>