<?php
require_once "dbconnect.php";
/*
$stmt = >prepare("CALL TeamRoster(?)");
$stmt->bindParam(1, $q);
$stmt->execute();
$result = $stmt->fetch();
*/
$q=$_GET["q"];
//$sql="CALL TeamRoster('".$q."')";
$sql = "SELECT user_id, first_name, last_name FROM User NATURAL JOIN member_of NATURAL JOIN Team WHERE team_id = '".$q."'";

$result = mysql_query($sql);

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