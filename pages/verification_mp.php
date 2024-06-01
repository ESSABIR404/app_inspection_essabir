<?php
session_start();
include_once 'cnx.php';

if (!isset($_SESSION['email'])) {
    header('Location: connexion.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nouveau_motdepasse = $_POST['nouveau_motdepasse'] ?? '';
    $confirmation_motdepasse = $_POST['confirmation_motdepasse'] ?? '';

    if ($nouveau_motdepasse === $confirmation_motdepasse) {
        $email = $_SESSION['email'];
        
        // Utilisation de password_hash pour hacher les mots de passe de manière sécurisée
        $mot_de_passe =  md5($nouveau_motdepasse);

        // Préparer et exécuter la requête de mise à jour du mot de passe
        $stmt = $conn->prepare('UPDATE inspecteurs SET mot_de_passe = :mot_de_passe WHERE email = :email');
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        $stmt->bindParam(':email', $email);
        if ($stmt->execute()) {
            // Détruire la session après la mise à jour du mot de passe
            $_SESSION = [];
            session_destroy();

            header('Location: connexion.php?message=Mot de passe réinitialisé avec succès');
            exit;
        } else {
            $erreur = 'Erreur lors de la mise à jour du mot de passe.';
        }
    } else {
        $erreur = 'Les mots de passe ne correspondent pas.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 5px;
            background-color: #f4f4f4;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .alert {
            margin-bottom: 20px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .footer .grid {
            font-size: 80%;
            overflow-x: hidden;
            scroll-padding-top: 7rem;
            scroll-behavior: smooth;
            text-align: center;
        }
        nav {
            width: 100%;
        }
        .nav-con {
            display: flex;
            width: 80%;
            margin-left: 10%;
            background-color: #eee;
            border-radius: 22px;
        }
        .nav-a {
            width: 100%;
            margin-left: 5%;
        }
        .nav-a ul {
            display: flex;
            list-style-type: none;
        }
        .nav-a ul li {
            position: relative;
            margin-left: 5%;
            margin-top: 1%;
            marker: none;
        }
        .nav-a ul li a {
            color: black !important;
            text-decoration: none;
        }
        .containerRm {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="email"] {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .c-m {
            height: 472px;
            margin-top: 150px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="nav-con">
        <div>
            <img src="../pictures/logo3-removebg-preview.png" width="48px" height="42px" style="margin-left: 20px; margin-top: 15px;">
        </div>
        <div class="nav-a">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#">Notre Site</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="c-m">
    <div class="container">
        <h2>Réinitialisation du mot de passe</h2>
        <?php if (isset($erreur)): ?>
            <div class="alert alert-danger"><?php echo $erreur; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="nouveau_motdepasse">Nouveau mot de passe :</label>
                <input type="password" id="nouveau_motdepasse" name="nouveau_motdepasse" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirmation_motdepasse">Confirmer le nouveau mot de passe :</label>
                <input type="password" id="confirmation_motdepasse" name="confirmation_motdepasse" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Réinitialiser le mot de passe</button>
        </form>
    </div>
</div>
</body>
</html>