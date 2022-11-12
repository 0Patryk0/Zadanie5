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
} else {
    header("Location: menu.php");
}
header("Location: menu.php");



?>