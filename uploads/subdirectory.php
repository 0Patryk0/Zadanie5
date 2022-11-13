<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</HEAD>
<BODY>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
    header('Location: /z5/logowanie/index3.php');
exit();
}

echo '<br><a href="/z5/uploads/menu.php"><ion-icon name="arrow-back-circle-outline"></ion-icon></a><br>';

//zmienna z nazwą podkatalogu
if ($_SERVER['HTTP_REFERER'] === 'https://kirianpll.beep.pl/z5/uploads/menu.php'){
  $_SESSION ['subdir'] = $_POST['subdir'];
}
$_SESSION ['currentdir'] = $_SESSION['ur_name'].'/'.$_SESSION ['subdir'];
$_SESSION ['header'] = "subdirectory.php";
//zmienna z nazwą podkatalogu

//dodawanie pliku
?>
<h4> Dodaj plik </h4>
<form method="POST" action="upload.php" enctype="multipart/form-data"><br>
File:   <input type="file" name="file">
<input type="submit" value="Send"/>
</form> 
<?php
//dodawanie pliku

//listowanie katalogu i posty
$myfiles = array_diff(scandir($_SESSION ['currentdir']), array('..', '.')); 
for($x = 0; $x<count($myfiles); $x++){
$y=$x+2;
$fileExt = explode('.', $myfiles[$y]);
$fileActualExt = strtolower(end($fileExt));
$allowed = array('png', 'jpg', 'mp4', 'mp3');
echo $myfiles[$y];
        //wyswietlanie pliku
        if(in_array($fileActualExt, $allowed)){
        ?>
        <div style="display: flex; margin-left: 20px;">
        <form id="<?php echo $myfiles[$y] ?>" action="display.php" method="post">
        <input type="hidden" name="fileToDisplay" value="<?php echo $myfiles[$y] ?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y] ?>').submit();"><ion-icon name="eye-outline"></ion-icon></a>
        </form>
        <?php
        }
        //usuwanie pliku
        echo "<->";
        ?>
        <form id="<?php echo $myfiles[$y].'de' ?>" action="delete.php" method="post">
        <input type="hidden" name="deletefilename" value="<?php echo $myfiles[$y]?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y].'de' ?>').submit();"><ion-icon name="trash-outline"></ion-icon></a>
        </form>
        <?php
        //pobieaie pliku
        echo "<->";
        ?>
        <form id="<?php echo $myfiles[$y].'p' ?>" action="download.php" method="post">
        <input type="hidden" name="downloadfile" value="<?php echo $myfiles[$y]?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y].'p' ?>').submit();"><ion-icon name="cloud-download-outline"></a>
        </form>
        </div>
        <?php
}
//listowanie katalogu i posty
?>
</BODY>
</HTML>