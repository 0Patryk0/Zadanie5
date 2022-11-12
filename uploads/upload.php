<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
header('Location: /z5/logowanie/index3.php');
exit();
}
// Variables making, from $_POST and $_FILES
$userFrom = $_SESSION ['ur_name'];
$userTo = $_SESSION['userTo'];
$file = $_FILES['file'];
$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];

$fileExt = explode('.', $_FILES['file']['name']);
$fileActualExt = strtolower(end($fileExt));
$allowed = array('png', 'gif', 'jpg', 'mp4', 'mp3');


// Immage and users dirextory dealing
if ($fileError <= 0){
    if (in_array($fileActualExt, $allowed)){
        if ($fileSize < 10000000){
            $fileNameNew = uniqid('', true).".".$fileActualExt;
            $fileDestination = 'uploads/'.$_SESSION ['ur_name'].'/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);      
        } else {
            header("Location: createdir.php?file_is_to_big");
            exit();
        }
    } else {
        header("Location: createdir.php?Wrong_file_type");
        exit();
    }
} else {
    header("Location: createdir.php?empty_request");
}


// Exit
header("Location: createdir.php?uploadsuccess");
?>