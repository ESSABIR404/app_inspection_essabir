<?php
// Vérifier si le numéro d'équipement a été envoyé depuis le formulaire
if (isset($_GET['num_equipement'])) {
    // Récupérer le numéro d'équipement depuis la requête GET
    $num_equipement = $_GET['num_equipement'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "app_inspection";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer et exécuter la requête SQL pour récupérer les informations sur l'équipement correspondant au numéro spécifié
        $stmt = $conn->prepare("SELECT * FROM equipemnts WHERE ideq = :num_equipement");
        $stmt->bindParam(':num_equipement', $num_equipement);
        $stmt->execute();

        // Vérifier s'il y a des résultats
        if ($stmt->rowCount() > 0) {
            // Afficher les résultats de la recherche
            echo "<h2>Résultats de la recherche pour l'équipement N° $num_equipement</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>N° Equipement</th>
                        <th>Tag d'équipement</th>
                        <th>Description</th>
                        <th>Type</th>
                    </tr>";

            // Afficher chaque ligne de résultat
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['ideq'] . "</td>";
                echo "<td>" . $row['tagequipe'] . "</td>";
                echo "<td>" . $row['descriptioneq'] . "</td>";
                echo "<td>" . $row['typeeq'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Aucun résultat trouvé pour le numéro d'équipement $num_equipement.";
        }

        // Fermer la connexion à la base de données
        $conn = null;

    } catch(PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
} else {
    // Si aucun numéro d'équipement n'a été spécifié, afficher un message d'erreur ou rediriger vers une autre page
    echo "<h2>Aucun numéro d'équipement spécifié</h2>";
}
?>
