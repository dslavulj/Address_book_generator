
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Danijel Slavulj">
    <title>Generator imenika</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <h1>Generator imenika</h1>
    <form method="post">
        <input type="number" min="1" name="brojformi" required>
        <input type="submit" value="Odaberi broj osoba">
    </form>  
</body>
</html>

<?php

function napraviforme($brf){
    for ($i=1;$i<$brf+1;$i++){
        echo '
            <div>   
                    <h3>Osoba '. $i  .' </h3> <br>
                    Ime:<br>
                    <input type="text" name="ime[]" required><br>
                    Prezime:<br>
                    <input type="text" name="prezime[]" required><br>
                    Adresa:<br>
                    <input type="text" name="adresa[]"><br>
                    Email:<br>
                    <input type="email" name="email[]"><br>
                    Broj Telefona:<br>
                    <input type="tel" name="brtelefona[]" pattern="[0-9]{10}"><br>
            </div>
        ';
    }
}

function napravixml(){
    $xw = xmlwriter_open_memory();
    xmlwriter_set_indent($xw, 1);
    xmlwriter_start_document($xw, '1.0', 'UTF-8');
    xmlwriter_start_element($xw, 'imenik'); //start_imenik

    for ($i=0;$i<count($_POST["ime"]);$i++){
        xmlwriter_start_element($xw, 'osoba'); //start_osoba

            xmlwriter_start_attribute($xw, 'id');
                xmlwriter_text($xw, $i+1);
            xmlwriter_end_attribute($xw);

            xmlwriter_start_element($xw, 'ime');
                xmlwriter_text($xw, $_POST["ime"][$i]);
            xmlwriter_end_element($xw);
            xmlwriter_start_element($xw, 'prezime');
                xmlwriter_text($xw, $_POST["prezime"][$i]);
            xmlwriter_end_element($xw);
            xmlwriter_start_element($xw, 'adresa');
                xmlwriter_text($xw, $_POST["adresa"][$i]);
            xmlwriter_end_element($xw);
            xmlwriter_start_element($xw, 'email');
                xmlwriter_text($xw, $_POST["email"][$i]);
            xmlwriter_end_element($xw);
            xmlwriter_start_element($xw, 'broj_telefona');
                xmlwriter_text($xw, $_POST["brtelefona"][$i]);
            xmlwriter_end_element($xw);

        xmlwriter_end_element($xw); // end_osoba
    }
    xmlwriter_end_element($xw); // end_imenik
    xmlwriter_end_document($xw);
    file_put_contents("file.xml",xmlwriter_output_memory($xw));
    header("Location: xmlsucc.php");
    die();
}

function napravijson(){
    $arr=[]; // >PHP 5.4
    //$arr = array(); <=PHP 5.4
    for ($i=0;$i<count($_POST["ime"]);$i++){
        $a = array( "ime"=>$_POST["ime"][$i],
                    "prezime"=>$_POST["prezime"][$i],
                    "adresa"=>$_POST["adresa"][$i],
                    "email"=>$_POST["email"][$i],
                    "broj_telefona"=>$_POST["brtelefona"][$i]
                );
        array_push($arr,$a);
    }
    $arr = array("imenik" => $arr);
    $json = json_encode($arr);
    file_put_contents("file.json",$json);
    header("Location: jsonsucc.php");
    die();
}
if (isset($_POST["brojformi"])) $brf=$_POST["brojformi"];
else $brf=1;

echo '<form style="width:100%" method="post">';
napraviforme($brf);
echo '  
        <span>
                <input type="submit" name="submit" value="Napravi XML" />
                <input style="margin-top:10px;" type="submit" name="submit" value="Napravi JSON" />
        </span>
        </form>
    ';
if (isset($_POST["submit"])) if ($_POST["submit"] =="Napravi XML") napravixml();
else napravijson();
?>