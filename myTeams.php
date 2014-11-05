<?php
include('dbconnect.php');



$md5c = "sdfawe23q45gsfd533fgad";
session_start();
session_commit();	

/*
if ($_SESSION['admin'] === 1){
	header("Location: admin.php");
}
*/

$headerOptions = array(
  "title" => "My Teams"
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
function leaveTeam(teamid, leagueid)
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
xmlhttp.open("GET","leaveTeam.php?tid="+teamid+"&lid="+leagueid,true);
xmlhttp.send();
}  
  
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
          <h1>Recreational <span class="green">Sports Management System</span></h1>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="myTeams.php">My Teams</a></li>
          <li>><a href="registerTeam.php">Create Team</a></li>
          <li><a href="viewRoster.php">View Rosters</a></li>
          <li><a href="getschedule.php">Leagues</a></li>
          <li><a href="logout.php">Logout</a></li>

        </ul>
      </div>
    </div>
    <div id="site_content">

      <div id="content">
        <!-- insert the page content here -->
        <h1>My Teams</h1>
        
		<?php
	 $myID = $_SESSION['user'];

	$sql = "SELECT * FROM member_of NATURAL JOIN Team NATURAL JOIN Stats NATURAL JOIN contest NATURAL JOIN League WHERE user_id = '".$myID."';";
	$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());

	  echo "<table border='1'>
		<tr>
		<th>Team ID</th>
		<th>Team Name</th>
		<th>League</th>
		<th># Games Played</th>
		<th>Wins</th>
		<th>Losses</th>
		<th>Draws</th>
		<th>No Contests</th>
		<th>Action</th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  $tid = $row['team_id'];
		  $lid = $row['league_id'];
		   echo "<td>" . $tid . "</td>";
		  $ba = "getteam.php?teamname=";
		  $ke = $ba . $row['team_name'];
				
	      echo "<td><a href='".$ke."'>" . $row['team_name'] . "</a></td>";
		 
		  $ba = "getschedule.php?leaguetype=";
		  $ke = $ba . $row['league_type'] . "&sport=" . $row['sport_name'];
		 
		  echo "<td><a href='".$ke."'>" . $row['league_type'] . " " . $row['sport_name'] . "</a></td>";
		  echo "<td>" . $row['played'] . "</td>";
		  echo "<td>" . $row['wins'] . "</td>";
		  echo "<td>" . $row['losses'] . "</td>";
		  echo "<td>" . $row['draws'] . "</td>";
		  echo "<td>" . $row['ncs'] . "</td>";
		  echo "<td>" . "<a href='leaveTeam.php?tid=".$tid."&lid=".$lid."'>Leave</a>" . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
	  ?>
<!--	
		<script type = "text/javascript" src = "scripts/registerTeam.js" defer = "defer" > </script>
-->
    
		
		
      </div>
    <div id="site_content_bottom"></div>
    </div>

  </div>
</body>
</html>

