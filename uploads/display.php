<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</HEAD>
<BODY>

<?php

session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (!isset($_SESSION['loggedin']))
{
    header('Location: /z5/logowanie/index3.php');
exit();
}

echo '<br><a href="/z5/uploads/menu.php"> Wróć</a><br>';

$displayFile = $_POST['fileToDisplay'];
$subdire = $_POST['subdire'];

if ($_SERVER['HTTP_REFERER'] === 'https://kirianpll.beep.pl/z5/uploads/subdirectory.php') {
    $image = "https://kirianpll.beep.pl/z5/uploads/".$_SESSION ['ur_name']."/".$subdire."/".$displayFile;
    
} else{
    $image = "https://kirianpll.beep.pl/z5/uploads/".$_SESSION ['ur_name']."/".$displayFile;
    
}


// Read image path, convert to base64 encoding
$imageData = base64_encode(file_get_contents($image));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

// Echo out a sample image

echo '<img src="' . $src . '">';



?>
</BODY>
</HTML>