<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
    header('Location: /z5/logowanie/index3.php');
exit();
}
//katalog gluwny urzytkownika tworzony przy logowaniu
$name = $_SESSION ['ur_name'];
if (!is_dir($name)){
mkdir($name);
} 
//katalog gluwny urzytkownika tworzony przy logowaniu

//tworzenie podkatalogu
$dirname = $_POST['dirname'];
$newdir = $name.'/'.$dirname;
if(isset($_POST['dirname'])){
    if (!is_dir($newdir)){
    mkdir($newdir);
    }
}
//tworzenie podkatalogu

header("Location: menu.php");

?>