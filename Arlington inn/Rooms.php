<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Booking</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-
1" />
  </head>
  <body> <?php
if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['phone_number']) || empty($_POST['email']) || empty($_POST['room_type']) || empty($_POST['special']))
    echo "
		<p>You must enter all the details! Click
your browser's Back button to return to the
Booking form.</p>";
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
if (!@mysql_select_db($DBName, $DBConnect)) {
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
$TableName = "bookings";
$SQLstring = "SHOW TABLES LIKE '$TableName'";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if (mysql_num_rows($QueryResult) == 0) {
$SQLstring = "CREATE TABLE $TableName (countID
SMALLINT
NOT NULL AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(40),last_name VARCHAR(40), phone_number VARCHAR(40), email VARCHAR(40), room_type VARCHAR(30), special VARCHAR(40))";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if ($QueryResult === FALSE)
echo "
		<p>Unable to create the table.</p>"
. "
		<p>Error code " . mysql_errno($DBConnect)
. ": " . mysql_error($DBConnect) . "</p>";
}
$FirstName = stripslashes($_POST['first_name']);
$LastName = stripslashes($_POST['last_name']);
$PhoneNumber = stripslashes($_POST['phone_number']);
$Email = stripslashes($_POST['email']);
$Room = stripslashes($_POST['room_type']);
$SpecialRequests = stripslashes($_POST['special']);

$SQLstring = "INSERT INTO $TableName VALUES(NULL, '$FirstName', '$LastName', '$PhoneNumber', '$Email', '$Room', '$SpecialRequests')";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if ($QueryResult === FALSE)
echo "
		<p>Unable to execute the query.</p>"
. "
		<p>Error code " . mysql_errno($DBConnect)
. ": " . mysql_error($DBConnect) . "</p>";
else
	echo '<h3>Thank you for your reservation. Back to home page: <a href="index.html"> Home </a></h3>';
mysql_close($DBConnect);
}
}
?>
</body>
</html>