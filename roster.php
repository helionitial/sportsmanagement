<?
	require_once "dbconnect.php";
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
</head>
<body>

<h2>Rosters</h2>
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