<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
    header('Location: /z5/logowanie/index3.php');
exit();
}

echo "Logged in as ";
echo $_SESSION['ur_name'];

echo '<br><a href="/z5/logowanie/logout.php"> logout</a><br>';
echo '<br><a href="/z5/uploads/upload.php"> add file</a><br>';



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