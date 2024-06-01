<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_inspection";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        // Récupérer l'identifiant depuis l'URL
        $id = $_GET['id'];

        // Préparer la requête de suppression
        $sql = "DELETE FROM rapports WHERE id = :id";
        $stmt = $conn->prepare($sql);

        // Liaison de la valeur de l'identifiant
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Redirection vers la page des rapports après la suppression
        header("Location: ../pages/rapport.php");
        exit(); // Assure que le script s'arrête après la redirection
    } else {
        // Si l'identifiant n'est pas présent dans l'URL
        echo "L'identifiant n'est pas présent dans l'URL.";
    }
} catch(PDOException $e) {
    // En cas d'erreur de connexion à la base de données
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>