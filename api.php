<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');

$conn = new mysqli("localhost", "root", "", "adatb");
$conn->set_charset("utf8");


$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
       
        $result = $conn->query("SELECT * FROM gep");
        $adatok = [];
        while($row = $result->fetch_assoc()) {
            $adatok[] = $row;
        }
        echo json_encode($adatok);
        break;

    case 'POST':
     
        $gyarto = $_POST['Gyarto'];
        $tipus = $_POST['Tipus'];
        $kijelzo = $_POST['Kijelzo'];
        $memoria = $_POST['Memoria'];
        $vincsi = $_POST['Merevlemez'];
        $video = $_POST['Videovezerlo'];
        $ar = $_POST['Ar'];

        $sql = "INSERT INTO gep (Gyarto, Tipus, Kijelzo, Memoria, Merevlemez, Videovezerlo, Ar) 
                VALUES ('$gyarto', '$tipus', '$kijelzo', '$memoria', '$vincsi', '$video', '$ar')";
        
        if($conn->query($sql)) {
            echo json_encode(["status" => "siker"]);
        } else {
            echo json_encode(["status" => "hiba", "uzenet" => $conn->error]);
        }
        break;

    case 'DELETE':
        
        $id = $_GET['id'];

        $sql = "DELETE FROM gep WHERE id = $id";
        
    

        if($conn->query($sql)) {
            echo json_encode(["status" => "torolve"]);
        }
        break;
}

$conn->close();
?>