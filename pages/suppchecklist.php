<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_inspection";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
if (isset($_GET['idcheck'])) {
    $idcheck = $_GET['idcheck'];
$sql="DELETE FROM cheklist  WHERE id = $idcheck";
$rsl=$conn->query($sql);}
header("Location: ../pages/cheklist.php");
?>