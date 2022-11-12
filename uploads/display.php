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

$displayFile = $_POST['fileToDisplay'];
$subdire = $_POST['subdire'];
$fileExt = explode('.', $displayFile);
$fileActualExt = strtolower(end($fileExt));

if ($_SERVER['HTTP_REFERER'] === 'https://kirianpll.beep.pl/z5/uploads/subdirectory.php') {
    echo '<br><a href="/z5/uploads/subdirectory.php"> Wróć</a><br>';
    if($fileActualExt == "jpg" OR $fileActualExt == "gif"){
        echo '<img src="'.$_SESSION ['ur_name'].'/'.$subdire.'/'.$displayFile.'" >';
    }elseif($fileActualExt == "mp4"){
        echo "<video controls> <source src=".$_SESSION ['ur_name']."/".$subdire.$displayFile." type='video/mp4'> </video>";
    }elseif($fileActualExt == "mp3"){
        echo "<audio controls> <source src=".$_SESSION ['ur_name'].'/'.$subdire.$displayFile." </audio>";
    }
} else{
    echo '<br><a href="/z5/uploads/menu.php"> Wróć</a><br>';
    if($fileActualExt == "jpg" OR $fileActualExt == "gif"){
        echo '<img src="'.$_SESSION ['ur_name'].'/'.$displayFile.'" >';
    }elseif($fileActualExt == "mp4"){
        echo "<video controls> <source src=".$_SESSION ['ur_name']."/".$displayFile." type='video/mp4'> </video>";
    }elseif($fileActualExt == "mp3"){
        echo "<audio controls> <source src=".$_SESSION ['ur_name'].'/'.$displayFile." </audio>";
    }
}







?>
</BODY>
</HTML>