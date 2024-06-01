<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un rapport</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
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

    $id = "";
    $recommandation = "";
    $annomalie = "";
    $verification = "";
    $errorMessage = "";

    // Récupérer l'ID du rapport à partir de l'URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Requête pour récupérer les données du rapport à partir de l'ID
        $stmt = $conn->prepare("SELECT * FROM rapports WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Vérifier si le rapport existe
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Récupérer les données du rapport
            $recommandation = $row['recommandation'] ?? "";
            $annomalie = $row['annomalie'] ?? "";
            $verification = $row['verification'] ?? "";
        } else {
            // Le rapport n'existe pas, rediriger ou afficher un message d'erreur
            header("Location: rapports.php");
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
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

            // Exécuter la requête
            $stmt->execute([
                ':recommandation' => $recommandation,
                ':annomalie' => $annomalie,
                ':verification' => $verification,
                ':id' => $id
            ]);

            // Redirection vers la page des rapports après la mise à jour
            header("Location: rapport.php");
            exit();
        } catch(PDOException $e) {
            $errorMessage = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
    ?> 

    <div class="container">
        <h1>Modifier un rapport</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="recommandation">Recommandation :</label>
            <input type="text" id="recommandation" name="recommandation" value="<?php echo $recommandation; ?>"><br><br>
            <label for="annomalie">annomalie :</label>
            <input type="text" id="annomalie" name="annomalie" value="<?php echo $annomalie; ?>"><br><br>
            <label for="verification">Vérification :</label>
            <input type="text" id="verification" name="verification" value="<?php echo $verification; ?>"><br><br>
            <input type="submit" value="Enregistrer">
            <a href="rapports.php">Annuler</a>
        </form>
        <?php if ($errorMessage != ""): ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>