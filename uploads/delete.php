<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
header('Location: /z5/logowanie/index3.php');
exit();
}

//usuwanie plików i katalogów
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
//usuwanie plików i katalogów

?>