<?php
$conn = new mysqli("localhost", "root", "", "adatb");
if ($conn->connect_error) {
    die("Hiba! Nem érem el az adatbázist: " . $conn->connect_error);
}
echo "Siker! A PHP látja a MySQL-ben lévő 'adatb' adatbázist.";
$res = $conn->query("SELECT COUNT(*) as db FROM gep");
$row = $res->fetch_assoc();
echo " A 'gep' táblában jelenleg " . $row['db'] . " sor van.";
?>