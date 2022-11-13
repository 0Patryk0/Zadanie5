<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
header('Location: /z5/logowanie/index3.php');
exit();
}

$fileName = $_POST['deletefilename'];
if (file_exists($_SESSION ['currentdir'].'/'.$fileName)){
    if(is_dir($_SESSION ['currentdir'].'/'.$fileName)){
        rmdir($_SESSION ['currentdir'].'/'.$fileName);
        header("Location: ".$_SESSION ['header']."?delete_dir_success");
        exit();
    } else {
        unlink($_SESSION ['currentdir'].'/'.$fileName);
        header("Location: ".$_SESSION ['header']."?delete_file_success");
        exit();
    }
    
}


// //usuwanie podkatalogów
// if(isset($_POST['subdir'])){
//     $subdir = $_POST['subdir'];
//     rmdir($_SESSION ['ur_name'].'/'.$subdir);
//     header("Location: menu.php?delete_dir_success");
//     exit();
// }
// //usuwanie plików w katalogu gluwnym
// if(isset($_POST['deletefile'])){
//     $file = $_POST['deletefile'];
//     unlink($_SESSION ['ur_name'].'/'.$file);
//     header("Location: menu.php?delete_file_success");
//     exit();
// }
// //usuwanie plików w podkatalogu
// if(isset($_POST['deletefilesub'])){
//     $file = $_POST['deletefilesub'];
//     $subdire = $_POST['subdirehelper'];
//     unlink($_SESSION ['ur_name'].'/'.$subdire.'/'.$file);
//     header("Location: subdirectory.php?delete_sub_file_success");
//     exit();
// }


?>