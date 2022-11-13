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

//Alert jeśli nastąpiły 3 nieudane logowania
$link = mysqli_connect('mysql02.kirianpll.beep.pl', 'szkolna5', 'street', 'z5_'); // połączenie z BD 
if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD
mysqli_query($link, "SET NAMES 'utf8'");
$listAccident = mysqli_query($link, "SELECT actual FROM suspects WHERE actual='1' Order by id Desc ");
$takeAccident = mysqli_fetch_array($listAccident);

if ($takeAccident[0] == 1){
    $listAccidentDate = mysqli_query($link, "SELECT accidentDate FROM suspects WHERE actual='1' Order by id Desc ");
    $listAccidentIP = mysqli_query($link, "SELECT suspectIP FROM suspects WHERE actual='1' Order by id Desc ");
    $takeAccidentDate = mysqli_fetch_array($listAccidentDate);
    $takeAccidentIP = mysqli_fetch_array($listAccidentIP);
    echo '<script>alert("'.$takeAccidentDate[0].' nastąpiły nieudane pruby logowania na konto z IP '.$takeAccidentIP[0].'")</script>';
    mysqli_query($link, "UPDATE suspects SET actual = '0' WHERE user ='{$_SESSION ['ur_name']}' AND actual = '1';");
}
mysqli_close($link);
//Alert jeśli nastąpiły 3 nieudane logowania

//witaj + linki
echo "Logged in as ";
echo $_SESSION['ur_name'];

echo '<br><a href="/z5/logowanie/logout.php"> logout</a><br>';
//witaj + linki

//Tworzenie podkatalogu
?>
<h4> stwórz katalog </h4>
<form method="POST" action="createdir.php"><br>
dir name:<input type="text" name="dirname" maxlength="90" size="90"><br>
<input type="submit" value="Send"/>
</form> 
<?php
//Tworzenie podkatalogu

//Dodawanie pliku
?>
<h4> Dodaj plik </h4>
<form method="POST" action="upload.php" enctype="multipart/form-data"><br>
File:   <input type="file" name="file">
<input type="submit" value="Send"/>
</form> 
<?php
//Dodawanie pliku

//Listowanie katalogu i posty
$myfiles = array_diff(scandir($_SESSION ['ur_name']), array('..', '.')); 

for($x = 0; $x<count($myfiles); $x++){
    echo "<br><br>";
$y=$x+2;
$fileExt = explode('.', $myfiles[$y]);
$fileActualExt = strtolower(end($fileExt));
$allowed = array('png', 'jpg', 'mp4', 'mp3', "gif");
echo $myfiles[$y];

$file = $_SESSION ['ur_name']."/".$myfiles[$y];
    if(is_dir($file)) {
        //przejście do katalogu
        ?>
        <div style="display: flex; margin-left: 20px;">
        <form id="<?php echo $myfiles[$y] ?>" action="subdirectory.php" method="post">
        <input type="hidden" name="subdir" value="<?php echo $myfiles[$y]?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y] ?>').submit();"><ion-icon name="folder-open-outline"></ion-icon></a>
        </form>
        
        <?php
        //usuwanie katalogu
        echo "<->";
        ?>
        <form id="<?php echo $myfiles[$y].'u' ?>" action="delete.php" method="post">
        <input type="hidden" name="subdir" value="<?php echo $myfiles[$y]?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y].'u' ?>').submit();"><ion-icon name="trash-outline"></ion-icon></a>
        </form>
        </div>
        <?php
    } else {
        //wyświetlenie pliku
        if(in_array($fileActualExt, $allowed)){
        ?>
        <div style="display: flex; margin-left: 20px;">
        <form id="<?php echo $myfiles[$y].'w' ?>" action="display.php" method="post">
        <input type="hidden" name="fileToDisplay" value="<?php echo $myfiles[$y]?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y].'w' ?>').submit();"><ion-icon name="eye-outline"></ion-icon></a>
        </form>
        <?php
        }
        //usuwanie pliku
        echo "<->";
        ?>
        <form id="<?php echo $myfiles[$y].'d' ?>" action="delete.php" method="post">
        <input type="hidden" name="deletefile" value="<?php echo $myfiles[$y]?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y].'d' ?>').submit();"><ion-icon name="trash-outline"></ion-icon></a>
        </form>
        <?php
        //pobieranie pliku
        echo "<->";
        ?>
        <form id="<?php echo $myfiles[$y].'p' ?>" action="download.php" method="post">
        <input type="hidden" name="downloadfile" value="<?php echo $myfiles[$y]?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y].'p' ?>').submit();"><ion-icon name="cloud-download-outline"></ion-icon></a>
        </form>
        </div>
        <?php
    }
    if($fileActualExt == "jpg" OR $fileActualExt == "gif"){
        echo '<img width="100" height="100" src="'.$_SESSION ['ur_name'].'/'.$myfiles[$y].'" >';
    }if($fileActualExt == "mp4"){
        echo "<video width='100' height='100' > <source src=".$_SESSION ['ur_name']."/".$myfiles[$y]." type='video/mp4'> </video>";
    }
}
//Listowanie katalogu i posty

?>
</BODY>
</HTML>