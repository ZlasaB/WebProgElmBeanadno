<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');

$conn = new mysqli("localhost", "root", "", "adatb");
$conn->set_charset("utf8");

// A kérés metódusa (GET, POST vagy DELETE)
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // LISTÁZÁS
        $result = $conn->query("SELECT * FROM gep");
        $adatok = [];
        while($row = $result->fetch_assoc()) {
            $adatok[] = $row;
        }
        echo json_encode($adatok);
        break;

    case 'POST':
        // HOZZÁADÁS
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
        // TÖRLÉS
        $id = $_GET['id'];
        // Mivel a képeden nincs 'id' mező a szerkezetnél, feltételezem, hogy a 'Gyarto' 
        // vagy egy egyedi mező alapján törölnél. Ha van ID-d, hagyd így:
        $sql = "DELETE FROM gep WHERE id = $id";
        
        // HA NINCS ID meződ, akkor pl. Típus alapján (vigyázat, több azonosat is törölhet):
        // $sql = "DELETE FROM gep WHERE Tipus = '$id'";

        if($conn->query($sql)) {
            echo json_encode(["status" => "torolve"]);
        }
        break;
}

$conn->close();
?>