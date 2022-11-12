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




$myfiles = scandir('/logowanie'); 


for($x = 0; $x<count($myfiles); $x++){
    $y=$x+2;
    echo $myfiles[$y];
    echo '<br>';
}



?>
</BODY>
</HTML>