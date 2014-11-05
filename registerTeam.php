<?php
include('dbconnect.php');

$md5c = "sdfawe23q45gsfd533fgad";
session_start();
session_commit();	

$headerOptions = array(
  "title" => "Create Team"
);
require_once "header.php";
?>


<head>
  <title>Create Team</title>
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
          <h1>Recreational<span class="green">Sports Management System</span></h1>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="myTeams.php">My Teams</a></li>
          <li class="selected">><a href="registerTeam.php">Create Team</a></li>
          <li><a href="viewRoster.php">View Rosters</a></li>
          <li><a href="getschedule.php">Leagues</a></li>
		  <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        <h1>Register Team</h1>
        
		<?php
	 $captain = $_SESSION['user'];

	$error = false;
	/* Ensure all form variables (teamname and league) are set */
	if (isset($_POST['teamname'], $_POST['league']))
	{
	  $teamname = $_POST['teamname'];
	  $leagueid = $_POST['league'];	
	 
	  
	  $sql = "SELECT * FROM League WHERE league_id = '".$leagueid."';";
	  $result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
	  $league = mysql_fetch_row($result);	
	
	  $leagueid = $league[0];
	  $leaguetype = $league[1];
	  $sport = $league[2];
	  
	  echo "<br>";
	  echo "Teamname: " . $teamname;
	  echo "<br>";
	  echo "League id: " . $leagueid;
	  echo "<br>";
	  echo "League type: " . $leaguetype;
	  echo "<br>";
	  echo "Sport: " . $sport;
	  echo "<br>";
//	  echo "Error? " . $error;
//	  echo "<br>";
  
	  if ($error === false)
	  {
	  
		$sql="SELECT * FROM member_of NATURAL JOIN contest WHERE user_id='".$captain."' AND league_id='".$leagueid."';";
		$result = mysql_query($sql);
		if (mysql_num_rows($result) > 0){ 
			$error = "<br><h2><b>ERROR: YOU'RE ALREADY ON A TEAM IN THIS LEAGUE! If you want to create your own team, leave your existing one first.</b></h2>";
			echo $error;
		//	header("Location: myTeams.php");
			exit; 
		}
		
		// query database to see if teamname is already in use
		// INSERT CODE HERE <-------------------------------------------------------
		$sql = "SELECT team_id FROM Team WHERE team_name = '".$teamname."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		
  
		
		if (mysql_num_rows($result) > 0)
		  //echo mysql_num_rows($result);
		  $error = "<br><h2><b>ERROR: Team name already registered!!!</b></h2>";
		  echo $error;
	  }

	  if ($error === false)
	  {
		// insert user into database
		// INSERT CODE HERE <-------------------------------------------------------
		$sql = "INSERT INTO Team (team_name) VALUES ('".$teamname."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$sql = "SELECT team_id FROM Team WHERE team_name='".$teamname."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$row = mysql_fetch_assoc($result);
		$teamid = $row['team_id'];
		
		/*
		$sql = "INSERT INTO Captain (team_id, captain) VALUES ('".$teamid."', '".$captain."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$sql = "INSERT INTO member_of (user_id, team_id) VALUES ('".$captain."', '".$teamid."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$sql = "INSERT INTO Stats (team_id, played, wins, losses, draws, ncs) VALUES ('".$teamid."', '0', '0', '0', '0', '0');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		$sql4 = "INSERT INTO contest (team_id, league_id) VALUES ('".$teamid."', '".$leagueid."')";
		$result = mysql_query($sql4);
		*/
		
		$sql="CALL createTeam('".$teamid."', '".$captain."', '".$leagueid."');";
		$result = mysql_query($sql);

		header('refresh: 5; url=/~pal4ka/cs4750/index.php');
		echo '<h1>Team registered - You will be re-directed in 5 seconds...</h1>';
		
		if ($result !== false)
		{

		  		  
		  
		  /*
		  // redirect to index
		  //header("Location: index.php");
		  header('refresh: 5; url=/~pal4ka/cs4750/index.php');
		  echo '<h1>Unknown Error: You will be re-directed in 5 seconds...</h1>';
		  exit; 	// ensure script terminates immediately 
		  */
		}
		else
		{
		  $error = "We're sorry, but an unexpected error prevented us from ".
			  "finalizing your registration.";
		  // DEBUGGING ONLY !!! REMOVE AFTER HAND TESTING!
		  $error = mysql_error(); // retrieve error message from server
		}
		 
		 
		
	  }
	  

	}
	
	
	else if (! empty($_POST))
		echo "missing required info!";
	//	  $error = "Missing required information";
?>
<!--	
		<script type = "text/javascript" src = "scripts/registerTeam.js" defer = "defer" > </script>
-->
    
		<form method="post" action="registerTeam.php" id="teamForm">
       			
			<label for ="teamnameInput">Team Name:</label>
            <input id="teamnameInput" name ="teamname" type ="text" value=""/><br />
			<br>
			<!-- PHP dropdown -->
			
			<label for ="leagueInput">League:</label>
			<select id="leagueInput" name="league" onchange="showRoster(this.value)">
			<option value="">-----------------------------</option>
			<?
				
				$sql = "SELECT * FROM League ORDER BY league_type";
				$result = mysql_query($sql);
				$dd="";
				while($row = mysql_fetch_assoc($result))
				{
					 $dd .= "<option value='{$row['league_id']}'>{$row['league_type']} {$row['sport_name']}</option>";
				} 
				echo $dd;
			?>
			</select>
			
			<br><br>
			
            <input type="submit" name="submit" value="Register Team">
        </form>
		
      </div>
    <div id="site_content_bottom"></div>
    </div>
  </div>
</body>
</html>

