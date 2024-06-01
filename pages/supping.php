<?php
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
if (isset($_GET['id_ingénieur'])) {
    $id_ingénieur = $_GET['id_ingénieur'];
$sql="DELETE FROM ingénieurseninspection  WHERE id_ingénieur = $id_ingénieur";
$rsl=$conn->query($sql);}
header("Location: ../pages/ingenieurs.php");
?>