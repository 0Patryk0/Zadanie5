<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
    header('Location: /z5/logowanie/index3.php');
exit();
}

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
    echo '<script>alert("'.$takeAccidentDate[0].' nastąpiła nieudana pruba logowania na konto z IP '.$takeAccidentIP[0].'")</script>';
    mysqli_query($link, "UPDATE suspects SET actual = '0' WHERE user ='{$_SESSION ['ur_name']}' AND actual = '1';");
}
mysqli_close($link);

//witaj + linki
echo "Logged in as ";
echo $_SESSION['ur_name'];

echo '<br><a href="/z5/logowanie/logout.php"> logout</a><br>';
echo '<br><a href="/z5/uploads/upload.php"> add file</a><br>';
//witaj + linki


$myfiles = array_diff(scandir($_SESSION ['ur_name']), array('..', '.')); 

for($x = 0; $x<count($myfiles); $x++){
$y=$x+2;
echo $myfiles[$y];
$file = $_SESSION ['ur_name']."/".$myfiles[$y];
    if(is_dir($file)) {
        ?>
        <form id="<?php echo $myfiles[$y] ?>" action="subdirectory.php" method="post">
        <input type="hidden" name="subdir" value="<?php echo $myfiles[$y]?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y] ?>').submit();">Przejdź</a>
        </form>
        <?php
    } else {
        ?>
        <form id="<?php echo $myfiles[$y] ?>" action="display.php" method="post">
        <input type="hidden" name="fileToDisplay" value="<?php echo $myfiles[$y]?>"/>
        <a href="#" onclick="document.getElementById('<?php echo $myfiles[$y] ?>').submit();">wyświetl</a>
        </form>
        <?php
    }
}

?>