<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "Leagues"
);
require_once "header.php";


?>


<head>
  <title>simple_square template</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  
  <script type="text/javascript" src="scripts/jquery-1.7.2.min.js">
$(function() {

    $(".loadlink").click(function(event) {
        event.preventDefault();
        $("#result").load($(this).attr("href"));
    });

});?  
</script>
<script type="text/javascript">

function joinTeam(teamid, leagueid)
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
xmlhttp.open("GET","joinTeam.php?tid="+teamid+"&lid="+leagueid,true);
xmlhttp.send();
}
  
  
function showLeague(leaguetype, sport)
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
xmlhttp.open("GET","getsport.php?lt="+leaguetype+"&sport="+sport,true);
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
          <h1>Recreational <span class="green">Sports Management System</span></h1>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.php">Home</a></li>
          <li><a href="registerTeam.php">Create Team</a></li>
          <li><a href="viewRoster.php">View Rosters</a></li>
          <li class="selected"><a href="leagues.php">Leagues</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        
        
		<?php
			if(isset($_GET["lt"], $_GET["sport"])) {
				
				$leaguetype=$_GET["lt"];
				$sport=$_GET["sport"];

				echo "<h1><a href='getschedule.php?leaguetype=".$leaguetype."&sport=".$sport."'>" . $leaguetype . " " . $sport . "</a>" . " -> " . " League Schedule" . "</h1>";
				
				//$leaguetype="Mens";
				//$sport="Basketball";

				$sql="SELECT game_id, game_date, game_time, game_location, Team.team_name as team1_name, X.team_name as team2_name, team1_id, team2_id, team1_score, team2_score
				FROM `arranges` 
				NATURAL JOIN Game
				NATURAL JOIN contest NATURAL JOIN League
				NATURAL JOIN Team, Team AS X
				WHERE Team.team_id = Game.team1_id
				AND X.team_id = Game.team2_id AND league_type='".$leaguetype."' AND sport_name='".$sport."'";

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
			}
			
			else {
				//echo "<h1>" . "Leagues" . "</h1>";
			
			}

		
		$error = false;
		
		
		if (isset($_GET['leaguetype'], $_GET['sport'])) {

		  $leaguetype = $_GET['leaguetype'];
		  $sport = $_GET['sport'];	
		
	   
		  $sql="SELECT team_id, team_name, league_id FROM Team NATURAL JOIN contest NATURAL JOIN League WHERE league_type='".$leaguetype."' AND sport_name='".$sport."'";

		  $result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		 

	//	  $row = mysql_fetch_array($result);
	//	  $leagueid = $row['league_id'];
		  
		  $w = "getschedule.php?lt=";
		  $e = "&sport=";
		  $web = $w . $leaguetype . $e . $sport;
		  //$web = "getlol.php";
		  //echo $web;
		  
		  
		  
		  //echo "<div id='result'></div>";
		  //echo "<a class='loadlink' href='".$web."'>" . "Click Here" . "</a>";
		  
				  
				echo "<h1><a href='getschedule.php'>" . "Leagues" . "</a>" . " -> " . $leaguetype . " " . $sport . "</h1>";
				
				echo "<a href='getschedule.php?lt=".$leaguetype."&sport=".$sport."'>View League Schedule</a>";	
				
				echo "<table border='1'>
				<tr>
					<th>Team ID</th>
					<th>Team Name</th>
					<th>Action</th>
				</tr>";
				
			//echo "<h1><a href='".$web."'>" . $leagueid . ". " . $leaguetype . " " . $sport . "</a></h1>";
			$lid = NULL;
			
			while($row = mysql_fetch_array($result))
			  {
			  $tid = $row['team_id'];
			  $lid = $row['league_id'];
			  echo "<tr>";
			  echo "<td>" . $tid . "</td>";
			  
				$ba = "getteam.php?teamname=";
				$ke = $ba . $row['team_name'];
				
			  echo "<td><a href='".$ke."'>" . $row['team_name'] . "</a></td>";
			  
			  if ($_SESSION['admin'] != '1') {
				echo "<td>" . "<a href='joinTeam.php?tid=".$tid."&lid=".$lid."'>Join</a>" . "</td>";	
			  }
			  else {
				echo "<td>" . "<a href='deleteteam.php?tid=".$tid."&lid=".$lid."'>Remove</a>" . "</td>";
			  }
			  
			  echo "</tr>";
			  }
			echo "</table>";	
			
			if (is_null($lid)) {
				$lid = "0";
			}
			$sql="SELECT * from leaders WHERE league_id='".$lid."'";
			$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		
		  echo "<table border='1'>
			<tr>
			<th>Leading Team</th>
			</tr>";
		
		
		while($row = mysql_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td>" . $row['team_name'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";	
		
			
			
		}

	
		
		
		
		
		
		?>
	
		<!-- PHP dropdown -->
		<?php
			echo "<h1>Leagues</h1>";
		?>
		
		<form method="get" action="getschedule.php" id="teamForm">
       			
			<label for="typeInput">League Type:</label>
            <select name="leaguetype" id="leaguetype">
			<option value="">-----------------------------</option>
			<option value="Mens">Mens</option>
			<option value="Womens">Womens</option>
			<option value="Corec">Co-rec</option>
			</select><br />
			<br>
					
			<label for ="sportInput">Sport:</label>
			<select id="sportInput" name="sport">
			<option value="">-----------------------------</option>
			<?
				$sql = "SELECT sport_name FROM Sport";
				$result = mysql_query($sql);
				$dd="";
				while($row = mysql_fetch_assoc($result))
				{
					$dd .= "<option value='{$row['sport_name']}'>{$row['sport_name']}</option>";
				} 
				echo $dd;
			?>
			</select>
			
			<br><br>
			
            <input type="submit" name="submit" value="View League">
        </form>
		
		
      </div>
    <div id="site_content_bottom"></div>
    </div>
  </div>
</body>
</html>