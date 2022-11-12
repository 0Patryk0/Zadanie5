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

// is file exist
if ($fileError > 0){
    header("Location: menu.php?empty_request");
    exit();
}
// plik z subdirectory    
if ($_SERVER['HTTP_REFERER'] === 'https://kirianpll.beep.pl/z5/uploads/subdirectory.php'){
    if (file_exists($_SESSION ['ur_name'].'/'.$subdir.'/'.$fileName)){
        header("Location: subdirectory.php?file_exist_sub");
        exit();
    }
    $fileDestination = $_SESSION ['ur_name'].'/'.$subdir.'/'.$fileName;
} 
// plik z katalogu glównego
else {
    if (file_exists($_SESSION ['ur_name'].'/'.$fileName)){
        header("Location: menu.php?file_exist");
        exit();
    }
    $fileDestination = $_SESSION ['ur_name'].'/'.$fileName;
}
// zapisz jesli poprednie sa prawdziwe
move_uploaded_file($fileTmpName, $fileDestination);


if ($_SERVER['HTTP_REFERER'] === 'https://kirianpll.beep.pl/z5/uploads/subdirectory.php'){
header("Location: subdirectory.php?uploadsuccess_sub");
} else {
    header("Location: menu.php?uploadsuccess");
}
?>