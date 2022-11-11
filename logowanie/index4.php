<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<?php 
//declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
header('Location: index3.php');
exit();
}

echo "Logged in as ";
echo $_SESSION['ur_name'];

echo '<br><a href="/z5/logowanie/logout.php"> logout</a>';


echo "<br> Historia logowań";

$dbhost='mysql02.kirianpll.beep.pl'; $dbuser='szkolna5'; $dbpassword='street'; $dbname='z5_';
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$connection)
{
echo " MySQL Connection error." . PHP_EOL;
echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Error: " . mysqli_connect_error() . PHP_EOL;
exit;
}
$result = mysqli_query($connection, "SELECT * from goscieportalu WHERE user!='admin' Order by id Desc ") or die ("DB error: $dbname");
print "<TABLE CELLPADDING=5 BORDER=1>";
print "<TR><TD>User</TD><TD>Date/Time</TD><TD>IP</TD><TD>Browser</TD></TR>\n";
while ($row = mysqli_fetch_array ($result))
{
$user = $row[2];
$date = $row[1];
$ip= $row[3];
$browser = $row[4];
print "<TR><TD>$user</TD><TD>$date</TD><TD>$ip</TD><TD>$browser</TD></TR>\n";
}
print "</TABLE>";
mysqli_close($connection);


?>
</BODY>
</HTML>