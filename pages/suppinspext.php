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

if (isset($_GET['idinsp'])) {
    $idinsp = $_GET['idinsp'];

    // Supprimer les lignes dans la table `rapports` associées à cette inspection externe
    $sql1 = "DELETE FROM rapports WHERE id_insp_ie = :idinsp AND categorie = 'externe'";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(':idinsp', $idinsp, PDO::PARAM_INT);
    $stmt1->execute();

    // Supprimer la ligne dans la table `inspections_externe`
    $sql2 = "DELETE FROM inspections_externe WHERE id = :idinsp";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(':idinsp', $idinsp, PDO::PARAM_INT);
    $stmt2->execute();
}

header("Location: ../pages/inspection-externe.php");
exit();
?>