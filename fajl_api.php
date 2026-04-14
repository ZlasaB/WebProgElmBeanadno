<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST');

$fajl = 'adatok/gep.txt';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $adatok = [];
    $sorok = file($fajl, FILE_IGNORE_NEW_LINES);
    $fejlec = explode("\t", $sorok[0]); 

    for ($i = 1; $i < count($sorok); $i++) {
        $ertekek = explode("\t", $sorok[$i]);
        if (count($ertekek) == count($fejlec)) {
            $adatok[] = array_combine($fejlec, $ertekek);
        }
    }
    echo json_encode($adatok);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $ujAdat = "\n" . implode("\t", [
        $_POST['gyarto'], 
        $_POST['tipus'], 
        $_POST['kijelzo'], 
        $_POST['memoria'], 
        $_POST['merevlemez'], 
        $_POST['videovezerlo'], 
        $_POST['ar'],
        "1", "1", "1" 
    ]);


    if (file_put_contents($fajl, $ujAdat, FILE_APPEND)) {
        echo json_encode(["status" => "Sikeres mentés a gep.txt-be!"]);
    } else {
        echo json_encode(["status" => "Hiba a mentésnél!"]);
    }
}
?>