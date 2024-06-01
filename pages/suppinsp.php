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
if (isset($_GET['id_inspecteur'])) {
    $id_inspecteur = $_GET['id_inspecteur'];
$sql="DELETE FROM inspecteurs  WHERE id_inspecteur = $id_inspecteur";
$rsl=$conn->query($sql);}
header("Location: ../pages/inspecteurs.php");
?>