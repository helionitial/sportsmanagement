<?php
require_once "dbconnect.php";

$leaguetype=$_GET["lt"];
$sport=$_GET["sport"];

//$leaguetype="Mens";
//$sport="Basketball";

$sql="CALL LeagueTeamsFull('".$leaguetype."','".$sport."')";
//$sql="SELECT * FROM Team NATURAL JOIN contest NATURAL JOIN League WHERE league_type='".$leaguetype."' AND sport_name='".$sport."'";

$result = mysql_query($sql);

		    echo "<table border='1'>
			<tr>
			
			<th>League ID</th>
			<th>League Type</th>
			<th>Sport Name</th>
			<th>Team Name</th>
			<th>Team ID</th>

			</tr>";
//getsport.php?lt="+leaguetype+"&sport="+sport
$w = "getschedule.php?lt=";
$e = "&sport=";
$web = $w . $leaguetype . $e . $sport;
echo $web;
while($row = mysql_fetch_array($result))
  {

  echo "<tr>";
  echo "<td>" . "<a href='".$web."'>" . $row['league_id'] . "</a>" . "</td>";
  echo "<td>" . $row['league_type'] . "</td>";
  echo "<td>" . $row['sport_name'] . "</td>";
  echo "<td>" . $row['team_name'] . "</td>";
  echo "<td>" . $row['team_id'] . "</td>";
  echo "</tr>";
  }
echo "</table>";


?>