<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_inspection";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['idp'])) {
        
        echo "id est présent dans l'URL";
        $idp = $_GET['idp'];
        $sql = "DELETE FROM planisnp WHERE idp = $idp";
        $rsl = $conn->query($sql);
    } else {
        echo "id n'est pas présent dans l'URL";
    }

    header("Location: ../pages/planing.php");
    exit(); // Assure que le script s'arrête après la redirection

} catch(PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
