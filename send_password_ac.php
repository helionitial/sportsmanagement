<?

require_once "dbconnect.php";


// value sent from form
$email_to=$_POST['email_to'];

// table name
$tbl_name="User";

// retrieve password from table 
$sql="SELECT password FROM $tbl_name WHERE email='".$email_to."'";
$result=mysql_query($sql)or die('Query failed: ' . mysql_error() . "<br />\n$sql");;

// if found this e-mail address, row must be 1 row
// keep value in variable name "$count"
$count=mysql_num_rows($result);

// compare if $count =1 row
if($count==1){

$rows=mysql_fetch_array($result);

// keep password in $your_password
$your_password=$rows['password'];

// ---------------- SEND MAIL FORM ----------------

// send e-mail to ...
$to=$email_to;

// Your subject
$subject="Reset your password for IMSS";

// From
$header="from: IMSS-Admin <em2ae@virginia.edu>";

// Your message
$messages="Your password is $your_password \r\n";


// send email
$sentmail = mail($to,$subject,$messages,$header);

}

// else if $count not equal 1
else {
echo "Your e-mail could not be found in the database.";
}

// if your email succesfully sent
if($sentmail){
echo "<p><font color='green'>Your password has been sent to your e-mail address.</font> <a href='login.php'>Click here</a> to login.</p>";
}
else {
echo "Cannot send password to your e-mail address";
}

?>