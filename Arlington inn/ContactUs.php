<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Contact Us</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-
1" />
  </head>
  <body> <?php
if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['phone_number']) || empty($_POST['question']))
    echo "
		<p>You must enter all the details! Click
your browser's Back button to return to the Contact Us form.</p>";
else {
$DBConnect = @mysql_connect("localhost", "is645-2323", "Lall1822sq");
if ($DBConnect === FALSE)
echo "
		<p>Unable to connect to the database server.</p>"
. "
		<p>Error code " . mysql_errno()
. ": " . mysql_error() . "</p>";
else {
$DBName = "guestbook_2323";
if (!@mysql_select_db($DBName, $DBConnect)){ 
$SQLstring = "CREATE DATABASE $DBName";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if ($QueryResult === FALSE)
echo "
		<p>Unable to execute the query.</p>"
. "
		<p>Error code " . mysql_errno($DBConnect)
. ": " . mysql_error($DBConnect) . "</p>";
else
echo "
		<p>You are the first visitor!</p>";
}
mysql_select_db($DBName, $DBConnect);
$TableName = "contacts";
$SQLstring = "SHOW TABLES LIKE '$TableName'";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if (mysql_num_rows($QueryResult) == 0) {
$SQLstring = "CREATE TABLE $TableName (countID
SMALLINT
NOT NULL AUTO_INCREMENT PRIMARY KEY,
full_name VARCHAR(40), phone_number VARCHAR(40), email VARCHAR(40), question VARCHAR(100))";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if ($QueryResult === FALSE)
echo "
		<p>Unable to create the table.</p>"
. "
		<p>Error code " . mysql_errno($DBConnect)
. ": " . mysql_error($DBConnect) . "</p>";
}
$FullName = stripslashes($_POST['full_name']);
$Phone_Number = stripslashes($_POST['phone_number']);
$Email = stripslashes($_POST['email']);
$Question = stripslashes($_POST['question']);
$SQLstring = "INSERT INTO $TableName VALUES(NULL,
'$FullName', '$Phone_Number', '$Email', '$Question')";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if ($QueryResult === FALSE)
echo "
		<p>Unable to execute the query.</p>"
. "
		<p>Error code " . mysql_errno($DBConnect)
. ": " . mysql_error($DBConnect) . "</p>";
else
echo '<h3>Thank you for your question we will get back to you in 3 to 4 business days. Back to home page: <a href="index.html"> Home </a></h3>';
mysql_close($DBConnect);
}
}
?> 
</body>
</html>