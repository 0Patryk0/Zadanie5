<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
header('Location: /z5/logowanie/index3.php');
exit();
}
// Variables making, from $_POST and $_FILES
$subdir = $_POST['subdir'];
$file = $_FILES['file'];
$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];

$fileExt = explode('.', $_FILES['file']['name']);
$fileActualExt = strtolower(end($fileExt));
$allowed = array('png', 'gif', 'jpg', 'mp4', 'mp3');

// is file exist
if ($fileError > 0){
    header("Location: menu.php?empty_request");
    exit();
}

//Dodawanie pliku
    if (file_exists($_SESSION ['currentdir'].'/'.$fileName)){
        header("Location: menu.php?file_exist");
        exit();
    }
    $fileDestination = $_SESSION ['currentdir'].'/'.$fileName;


move_uploaded_file($fileTmpName, $fileDestination);
//Dodawanie pliku

header("Location: ".$_SESSION ['header']."?uploadsuccess");

?>