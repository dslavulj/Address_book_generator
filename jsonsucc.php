<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Danijel Slavulj">
    <title>JSON</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <h1>JSON uspješno kreiran</h1>
    <form method="post">
        <input name="submit" type="submit" value="Preuzmi datoteku">
        <input name="submit" style="margin-top:10px;" type="submit" value="Pogledaj datoteku">
    </form>
    <button style="width:100px;position: absolute;bottom: 10px;right: 10px;" onclick="window.location.href='index.php'">Nazad na generator</button>
</body>
</html>

<?php
if(file_exists("file.json")) if ((time()-filectime("file.json"))>30) unlink("file.json");


function dwn(){  
    if(file_exists("file.json")) {
        ob_clean();
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=imenik.json");
        header("Content-Type: text/json");
        header("Content-Transfer-Encoding: binary");
        readfile("file.json");
        exit;
    }
}
function opn(){
    header("Location: file.json");
    die();
}


if (isset($_POST["submit"])) if ($_POST["submit"] =="Preuzmi datoteku") dwn();
else opn();

?>