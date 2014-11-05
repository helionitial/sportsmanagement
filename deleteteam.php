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
      <div class="sidebar">
        <!-- insert your sidebar items here -->
        <p>Welcome back <b><?php echo $_SESSION['user']; ?></b>!</p>
		<p>Today is <?php echo(gmdate("l dS \of F Y h:i:s A") . "<br />"); ?></p> 
		<h1>Latest News</h1>
        <h2>IMSS Re-designed</h2>
        <h3>April 1st, 2012</h3>
        <p>April Fool's Day sees the redesign of our website. Take a look around and let us know what you think.<br /></p>
        <h1>Useful Links</h1>
        <ul>
          <li><a href="http://www.virginia.edu/ims/">IMRec Sports Homepage</a></li>
          <li><a href="http://www.virginia.edu/ims/facilities/index.php">Facilities</a></li>
          <li><a href="http://www.virginia.edu/ims/facilities/semester_schedule.php">Schedules</a></li>
          <li><a href="http://www.virginia.edu/emergency/">UVA Emergency Alerts</a></li>
        </ul>
        <h1>Contact Us</h1>
        <p>Please contact Eugene Moy at em2ae@virginia.edu for any questions or comments relating to this website.</p>
		</div>
      <div id="content">
        <!-- insert the page content here -->
        
	
		<?php	
			if (isset($_GET['tid'], $_GET['lid'])) {
			$lid = $_GET['lid'];
			$tid = $_GET['tid'];	
		}
		
		//Delete Sport
		$sql = "DELETE FROM contest WHERE league_id='".$lid."' AND $tid='".$tid."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());

				
		?>
		
			
		
		
      
      </div>
    <div id="site_content_bottom"></div>
    </div>
    <div id="footer">Copyright &copy; HTCuva. All Rights Reserved. | <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.dcarter.co.uk">design by dcarter</a></div>
  </div>
</body>
</html>

