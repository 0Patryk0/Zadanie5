<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
header('Location: /z5/logowanie/index3.php');
exit();
}
if(isset($_POST['subdir'])){
    $subdir = $_POST['subdir'];
    rmdir($_SESSION ['ur_name'].'/'.$subdir);
    header("Location: menu.php?uploadsuccess");
    exit();
}


?>