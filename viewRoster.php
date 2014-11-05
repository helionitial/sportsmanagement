<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "View Rosters"
);
require_once "header.php";


?>


<head>
  <title>View Roster</title>
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
          <h1>Recreational <span class="green">Sports Management System</span></h1>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="myTeams.php">My Teams</a></li>
          <li><a href="registerTeam.php">Create Team</a></li>
          <li class="selected">><a href="viewRoster.php">View Rosters</a></li>
          <li><a href="getschedule.php">Leagues</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        <h1>View Rosters</h1>
	
		<!-- PHP dropdown -->
		<form>
		<select name="teams" onchange="showRoster(this.value)">
		<option value="">Select a team:</option>
		<?
			
			$sql = "SELECT * FROM Team ORDER BY team_name";
			$result = mysql_query($sql);
			$dd="";
			while($row = mysql_fetch_assoc($result))
			{
				 $dd .= "<option value='{$row['team_id']}'>{$row['team_name']}</option>";
			} 
			echo $dd;
		?>


		</select>
		</form>
		<br />
		<div id="txtHint"><b></b></div>
      
      </div>
    <div id="site_content_bottom"></div>
    </div>
  </div>
</body>
</html>

