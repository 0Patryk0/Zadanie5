<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
    header('Location: /z5/logowanie/index3.php');
exit();
}

$name = $_SESSION ['ur_name'];
if (!is_dir($name)){
mkdir($name);
} 

$dirname = $_POST['dirname'];
$newdir = $name.'/'.$dirname;
if(isset($_POST['dirname'])){
    if (!is_dir($newdir)){
    mkdir($newdir);
    }
}

header("Location: menu.php");

?>