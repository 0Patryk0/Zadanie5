<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</HEAD>
<BODY>

<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
    header('Location: /z5/logowanie/index3.php');
exit();
}

echo '<br><a href="/z5/uploads/menu.php">Wstecz</a><br>';
if ($_SERVER['HTTP_REFERER'] === 'https://kirianpll.beep.pl/z5/uploads/menu.php'){
  $_SESSION ['subdir'] = $_POST['subdir'];
}

?>
<h4> Dodaj plik </h4>
<form method="POST" action="upload.php" enctype="multipart/form-data"><br>
File:   <input type="file" name="file">
<input type="hidden" name="subdir" value="<?php echo $_SESSION ['subdir']?>"/>
<input type="submit" value="Send"/>
</form> 
<?php


$myfiles = array_diff(scandir($_SESSION ['ur_name']."/".$_SESSION ['subdir']), array('..', '.')); 


for($x = 0; $x<count($myfiles); $x++){
$y=$x+2;
echo $myfiles[$y];
        //wyswietlanie pliku
        ?>
        <form id="<?php echo $myfiles[$y] ?>" action="display.php" method="post">
        <input type="hidden" name="fileToDisplay" value="<?php echo $myfiles[$y] ?>"/>
        <input type="hidden" name="subdire" value="<?php echo $_SESSION ['subdir'] ?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y] ?>').submit();">wyświetl</a>
        </form>
        <?php
        //usuwanie pliku
        ?>
        <form id="<?php echo $myfiles[$y].'de' ?>" action="delete.php" method="post">
        <input type="hidden" name="deletefilesub" value="<?php echo $myfiles[$y]?>"/>
        <input type="hidden" name="subdirehelper" value="<?php echo $_SESSION ['subdir'] ?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y].'de' ?>').submit();">usuń</a>
        </form>
        <?php

}



?>
</BODY>
</HTML>