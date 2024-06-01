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

// Vérifier si les données du formulaire ont été reçues
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs d'entrée
    $id = $_POST['id'];
    $recommandation = $_POST['recommandation'];
    $annomalie = $_POST['annomalie'];
    $verification = $_POST['verification'];

    try {
        // Préparer la requête de mise à jour
        $stmt = $conn->prepare("UPDATE rapports SET 
                                recommandation = :recommandation, 
                                annomalie = :annomalie, 
                                verification = :verification 
                                WHERE id = :id");

        // Exécuter la requête de mise à jour
        $stmt->execute([
            ':recommandation' => $recommandation,
            ':annomalie' => $annomalie,
            ':verification' => $verification,
            ':id' => $id
        ]);

        // Supprimer les champs d'entrée de la ligne mise à jour
        echo json_encode(['success' => true, 'message' => 'Mise à jour réussie']);
    } catch(PDOException $e) {
        // Envoyer une réponse JSON en cas d'erreur lors de la mise à jour
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour : ' . $e->getMessage()]);
    }
} else {
    // Envoyer une réponse JSON si les données du formulaire ne sont pas reçues
    echo json_encode(['success' => false, 'message' => 'Données du formulaire non reçues']);
}
?>