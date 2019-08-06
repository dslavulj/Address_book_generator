<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Danijel Slavulj">
    <title>XML</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <h1>XML uspješno kreiran</h1>
    <form method="post">
        <input name="submit" type="submit" value="Preuzmi datoteku">
        <input name="submit" style="margin-top:10px;" type="submit" value="Pogledaj datoteku">
    </form>
    <button style="width:100px;position: absolute;bottom: 10px;right: 10px;" onclick="window.location.href='index.php'">Nazad na generator</button>
</body>
</html>

<?php
if(file_exists("file.xml")) if ((time()-filectime("file.xml"))>30) unlink("file.xml");


function dwn(){
    if(file_exists("file.xml")) {
        ob_clean();
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=imenik.xml");
        header("Content-Type: text/xml");
        header("Content-Transfer-Encoding: binary");
        readfile("file.xml");
        exit;
    }
}
function opn(){
    header("Location: file.xml");
    die();
}


if (isset($_POST["submit"])) if ($_POST["submit"] =="Preuzmi datoteku") dwn();
else opn();

?>