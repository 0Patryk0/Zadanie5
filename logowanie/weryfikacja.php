<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</HEAD>
<BODY>
<?php session_start(); ?>


<script>
    //Skrypt tworzący ciasteczka (cookies).
    let width = screen.width;
    let height = screen.height;
    let availWidth = screen.availWidth;
    let availHeight = screen.availHeight;
    let colorDepth = screen.colorDepth;
    let cookies = navigator.cookieEnabled;
    let java = navigator.javaEnabled();
    let language = navigator.language;


$(document).ready(function () {
    createCookie("width", width, "1");
    createCookie("height", height, "1");
    createCookie("availWidth", availWidth, "1");
    createCookie("availHeight", availHeight, "1");
    createCookie("colorDepth", colorDepth, "1");
    createCookie("cookies", cookies, "1");
    createCookie("java", java, "1");
    createCookie("language", language, "1");
    window.location.replace("https://kirianpll.beep.pl/z5/logowanie/spydata.php");
});


function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}

</script>
<?php

//polączenie z baza oraz pobranie rekordów do weryfikacji
$user=$_POST['user']; // login z formularza
$pass=$_POST['pass']; // hasło z formularza
$link = mysqli_connect('mysql02.kirianpll.beep.pl', 'szkolna5', 'street', 'z5_'); // połączenie z BD 
if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD
mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$result = mysqli_query($link, "SELECT * FROM users WHERE username='$user'"); // pobieranie wiersza, w którym login=login z formularza
$listid = mysqli_query($link, "SELECT id FROM users WHERE username='$user'");
$listname = mysqli_query($link, "SELECT username FROM users WHERE username='$user'");
$listattempt = mysqli_query($link, "SELECT failedAttempt FROM users WHERE username = '$user'");
$listBlock = mysqli_query($link, "SELECT endDate FROM suspects WHERE user = '$user' Order by id Desc");
$rekord = mysqli_fetch_array($result); // pobieranie wiersza z BD, struktura zmiennej jak w BD 
$takeid = mysqli_fetch_array($listid);
$takename = mysqli_fetch_array($listname);
$takeattempt = mysqli_fetch_array($listattempt);
$takeBlock = mysqli_fetch_array($listBlock);
//polączenie z baza oraz pobranie rekordów do weryfikacji

//blokada brute force
if($takeBlock[0] > date('Y-m-d H:i:s')){
    header('Location: index3.php?sussy');
    exit();
}
//blokada brute force

//sprawdzenie loginu
if(!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
{
mysqli_close($link); 
echo "Brak użytkownika o takim loginie !"; 
}
//sprawdzenie loginu

//poprawne logowanie
else // jeśli $rekord istnieje
{ 
if($rekord['password']==$pass) // czy hasło zgadza się z BD
{ 
    session_start();
    $_SESSION ['subdir'] = " ";
    $_SESSION ['currentdir'];
    $_SESSION ['header'];
    $_SESSION ['u_id'] = $takeid[0];
    $_SESSION ['ur_name'] = $takename[0];
    $_SESSION ['loggedin'] = true;
    $failedCount = 0;
    mysqli_query($link, "UPDATE users SET failedAttempt = '$failedCount' WHERE username = '$takename[0]';");
    
}
//poprawne logowanie

//błędne logowanie
else // w przypadku gdy hasło się nie zgadza
{

if ($takeattempt[0] < 3){
    $failedCount = $takeattempt[0] + 1;
    mysqli_query($link, "UPDATE users SET failedAttempt = '$failedCount' WHERE username = '$takename[0]';");
}elseif ($takeattempt[0] >= 3){
    $failedCount = 0;
    $suspectip = $_SERVER['REMOTE_ADDR'];
    $time  = date('Y-m-d H:i:s');
    $exptime = date('Y-m-d H:i:s', strtotime('+20 Seconds'));
    mysqli_query($link, "INSERT INTO suspects (user, suspectIP, accidentDate, endDate, actual) VALUES ('$takename[0]', '$suspectip', '$time', '$exptime', '1');");
    mysqli_query($link, "UPDATE users SET failedAttempt = '$failedCount' WHERE username = '$takename[0]';");

}
 header('Location: index3.php?błąd_logowania'); // przenieś do pliku index3
mysqli_close($link);
exit();
}
//błęde logowanie
}
mysqli_close($link);
?>
</BODY>
</HTML>