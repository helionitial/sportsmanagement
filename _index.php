<?
include('dbconnect.php');

if (isset($_SESSION["user"])) {
	header("Location: myTeams.php");
	exit; 	// ensure script terminates immediately
}
require_once "header.php";


?>

<html>
<head>
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

<title>IMSS - Member Area</title>
</head>

<body>

<div align="center">
		
        <p>Welcome back <b><?php echo $_SESSION['user']; ?></b>!</p>
		<p>Hey are you logged in? <b><?php echo $_SESSION['loggedin']; ?></b>!</p>
        <p>Today is <?php echo(gmdate("l dS \of F Y h:i:s A") . "<br />"); ?></p> 
 		<p>More features coming soon!</p>
		<p><a href='registerTeam.php'>Create a Team</a></p>
        <p><a href='logout.php'>Logout</a></p>
		
<h3>View Rosters</h3>

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

</body>
</html>
