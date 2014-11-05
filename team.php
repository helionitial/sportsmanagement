<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "View Team"
);
require_once "header.php";


?>


<head>
  <title>simple_square template</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  
  <script type="text/javascript">
function showRoster(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getroster.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>

<body>
  <div id="main">
    <div id="links"></div>
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="green", allows you to change the colour of the text - other classes are: "blue", "orange", "red", "purple" and "yellow" -->
          <h1>Intramural<span class="green">Sports System</span></h1>
          <h2>your gateway to IM Sports</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="myTeams.php">My Teams</a></li>
          <li><a href="registerTeam.php">Create Team</a></li>
          <li><a href="viewRoster.php">View Rosters</a></li>
          <li><a href="leagues.php">Leagues</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        
	
		<?php	
							
				$teamname=$_GET["teamname"];
				//$teamname="Young Jedi Knights";
				
	
			
			echo "<h1>" . $teamname . "</h1>";
			echo "<br>";
			echo "<h2>Team Schedule</h2>";
			
			$sql="SELECT game_id, game_date, game_time, game_location, Team.team_name as team1_name, X.team_name as team2_name, team1_id, team2_id, team1_score, team2_score
				FROM `arranges` 
				NATURAL JOIN Game
				NATURAL JOIN contest NATURAL JOIN League
				NATURAL JOIN Team, Team AS X
				WHERE Team.team_id = Game.team1_id
				AND X.team_id = Game.team2_id AND (Team.team_name = '".$teamname."' OR X.team_name = '".$teamname."')";

				$result = mysql_query($sql);

							echo "<table border='1'>
							<tr>
							
							<th>Game ID</th>
							<th>Date</th>
							<th>Time</th>
							<th>Location</th>
							<th>Team 1</th>
							<th>Team 1 Score</th>
							<th>Team 2 Score</th>
							<th>Team 2</th>
							
							
							

							</tr>";

				while($row = mysql_fetch_array($result))
				  {
				  echo "<tr>";
				  echo "<td>" . $row['game_id'] . "</td>";
				  echo "<td>" . $row['game_date'] . "</td>";
				  echo "<td>" . $row['game_time'] . "</td>";
				  echo "<td>" . $row['game_location'] . "</td>";
				  echo "<td>" . $row['team1_name'] . "</td>";
				  echo "<td>" . $row['team1_score'] . "</td>";
				  echo "<td>" . $row['team2_score'] . "</td>";
				  echo "<td>" . $row['team2_name'] . "</td>";
				  echo "</tr>";
				  }
				echo "</table>";
			
			
				$sql="SELECT * FROM Team NATURAL JOIN Stats WHERE team_name='".$teamname."'";

				$result = mysql_query($sql);

				

				while($row = mysql_fetch_array($result))
				  {
				  
				  
							echo "<table border='1'>
							<tr>
							<th>Played</th>
							<th>Wins</th>
							<th>Losses</th>
							<th>Draws</th>
							<th>NCS</th>
							</tr>";
				  
				  echo "<h2>Team Stats</h2>";
				  echo "<tr>";
				  echo "<td>" . $row['played'] . "</td>";
				  echo "<td>" . $row['wins'] . "</td>";
				  echo "<td>" . $row['losses'] . "</td>";
				  echo "<td>" . $row['draws'] . "</td>";
				  echo "<td>" . $row['ncs'] . "</td>";
				  echo "</tr>";
				  }
				echo "</table>";
				
		
			
				$sql="CALL TeamRoster('".$teamname."')";

				$result = mysql_query($sql);

				
				echo "<br>";
				echo "<h2>Roster</h2>";
				echo "<table border='1'>
				<tr>
				<th>User ID</th>
				<th>Firstname</th>
				<th>Lastname</th>

				</tr>";

				while($row = mysql_fetch_array($result))
				  {
				  echo "<tr>";
				  echo "<td>" . $row['user_id'] . "</td>";
				  echo "<td>" . $row['first_name'] . "</td>";
				  echo "<td>" . $row['last_name'] . "</td>";
				  echo "</tr>";
				  }
				echo "</table>";
				
			?>
		
			
		
		
      
      </div>
    <div id="site_content_bottom"></div>
    </div>
  </div>
</body>
</html>

