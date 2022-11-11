<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku

 $user=$_POST['user']; // login z formularza
 $pass=$_POST['pass']; // hasło z formularza
 $pass2=$_POST['pass2']; // hasło z formularza
 if($pass != $pass2){
    echo "Podane Hasła nie są takie same";
    echo '<a href="/z5/logowanie/rejestruj.php">wróć do rejestracji</a><br>';
 }else{
 $link = mysqli_connect('mysql02.kirianpll.beep.pl', 'szkolna5', 'street', 'z5_'); // połączenie z BD – wpisać swoje dane
 if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD
 mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
 $result = mysqli_query($link, "SELECT * FROM users WHERE username='$user'"); // wiersza, w którym login=login z formularza
 $rekord = mysqli_fetch_array($result);
 if(!$rekord)
 {
    mysqli_query($link, "INSERT INTO users (username, password) VALUES ('$user', '$pass');"); 
    echo "Rejestracja powiodła się";
    echo '<a href="/z5/logowanie/index3.php">Przejdź do logowania</a><br>';
 }else{
    echo "Istnieje już użytkownik o takiej nazwie";
    echo '<a href="/z5/logowanie/rejestruj.php">wróć do rejestracji</a><br>';
 }
 mysqli_close($link); // zamknięcie połączenia z BD
}
?>
</BODY>
</HTML>