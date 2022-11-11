<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
    header('Location: index3.php');
exit();
}
$link = mysqli_connect('mysql02.kirianpll.beep.pl', 'szkolna5', 'street', 'z5_'); // połączenie z BD 
if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }else{ // obsługa błędu połączenia z BD
mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków

session_start();
 // ip 
 $ip = $_SERVER["REMOTE_ADDR"];

 //useragent
 $browser = $_SERVER['HTTP_USER_AGENT'];

//pobieranie rozdzielczości i kolorów  <<<
$width = $_COOKIE["width"];
$height = $_COOKIE["height"];
$pageresolution = $width . 'x' . $height;
$availwidth = $_COOKIE["availWidth"];
$availheight = $_COOKIE["availHeight"];
$windowresolution = $availwidth . 'x' . $availheight;
$collor = $_COOKIE["colorDepth"];
//pobieranie rozdzielczości i kolorów  >>>

//ciasteczka, java, język <<<
$isCookiesEnable = $_COOKIE["cookies"];
$isJavaEnable = $_COOKIE["java"];
$userLanguage = $_COOKIE["language"];
//ciasteczka, java, język >>>

$username = mysqli_fetch_array(mysqli_query($link, "SELECT username FROM users WHERE id='{$_SESSION['u_id']}'"));
mysqli_query($link, "INSERT INTO goscieportalu (user, ipaddress, browser) VALUES ('$username[0]', '$ip', '$browser');");
mysqli_close($link);

header('Location: /z5/uploads/createdir.php');
}
 
?>
</BODY>
</HTML>