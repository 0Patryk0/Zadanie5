<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
header('Location: /z5/logowanie/index3.php');
exit();
}

//pobieranie z katalogu gluwnego
if(isset($_POST['downloadfile'])){
$filename = $_POST['downloadfile'];
$path = $_SESSION ['ur_name'].'/'.$filename;
if(file_exists($path))
{
  header('Content-Disposition: attachment; filename=' . $filename);  
  readfile($path); 
  exit;
}
else
{
  echo 'File does not exists on given path';
}
}

//pobieranie z subkatalogu
if(isset($_POST['downloadfilesub'])){
    $filename = $_POST['downloadfilesub'];
    $subpath = $_POST['subdirehelper'];
    $path = $_SESSION ['ur_name'].'/'.$subpath.'/'.$filename;
    if(file_exists($path))
    {
      header('Content-Disposition: attachment; filename=' . $filename);  
      readfile($path); 
      exit;
    }
    else
    {
      echo 'File does not exists on given path';
    }
}


?>