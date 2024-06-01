<?php
session_start();
include_once 'cnx.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: Acceuil.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ancien_motdepasse = $_POST['ancien_motdepasse'];
    $nouveau_motdepasse = $_POST['nouveau_motdepasse'];
    $confirmer_motdepasse = $_POST['confirmer_motdepasse'];

    if ($nouveau_motdepasse !== $confirmer_motdepasse) {
        $erreur = "Les nouveaux mots de passe ne correspondent pas.";
    } else {
        $email = $_SESSION['email'];
        $type_utilisateur = $_SESSION['type_utilisateur'];

        // Déterminer la table et le champ corrects en fonction du type d'utilisateur
        if ($type_utilisateur === 'inspecteur') {
            $table = 'inspecteurs';
        } elseif ($type_utilisateur === 'ingénieur_en_inspection') {
            $table = 'ingénieurseninspection';
        } else {
            $erreur = "Type d'utilisateur inconnu.";
            exit();
        }

        // Vérifier l'ancien mot de passe
        $stmt = $conn->prepare("SELECT mot_de_passe FROM $table WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            // Vérifier si l'ancien mot de passe correspond
            if (md5($ancien_motdepasse) === $resultat['mot_de_passe']) {
                // Mettre à jour le mot de passe
                $nouveau_motdepasse_hash = md5($nouveau_motdepasse);
                $stmt = $conn->prepare("UPDATE $table SET mot_de_passe = :nouveau_motdepasse WHERE email = :email");
                $stmt->execute([':nouveau_motdepasse' => $nouveau_motdepasse_hash, ':email' => $email]);
                $message = "Mot de passe mis à jour avec succès.";
                header("Location: profile.php");
                exit();
            } else {
                $erreur = "L'ancien mot de passe est incorrect.";
            }
        } else {
            $erreur = "Aucun utilisateur trouvé avec cet email.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <title>Modifier le mot de passe</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid shadow" style="border-radius: 20px;">
        <img src="../pictures/logoinsp.jpg" width="170px" height="45px" style="margin-left: 20px; margin-bottom: 10px;">
        <a class="navbar-brand" href="index.php"></a>
    </div>
</nav>

<section class="vh-100" style="background-color: #ffffff; background-size: contain;">
    <div class="container py-xxl-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card shadow-lg" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="../pictures/fotos9.webp" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; margin-top: 200px; height: 500px; width: 900px;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <div class="d-flex align-items-center mb-3 pb-1">
                                    <span class="h1 fw-bold mb-0" style="color: rgb(30, 1, 84);">Modifier le mot de passe</span>
                                </div>

                                <?php if (isset($erreur)) { ?>
                                    <div class="alert alert-danger"><?php echo $erreur; ?></div>
                                <?php } ?>
                                <?php if (isset($message)) { ?>
                                    <div class="alert alert-success"><?php echo $message; ?></div>
                                <?php } ?>

                                <form action="modifier_mot_de_passe.php" method="post">
                                    <div class="form-outline mb-4">
                                        <label for="ancien_motdepasse" class="form-label" style="color: rgb(54, 19, 120);"><strong>Ancien mot de passe :</strong></label>
                                        <input type="password" id="ancien_motdepasse" name="ancien_motdepasse" class="form-control form-control-lg" required>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="nouveau_motdepasse" class="form-label" style="color: rgb(54, 19, 120);"><strong>Nouveau mot de passe :</strong></label>
                                        <input type="password" id="nouveau_motdepasse" name="nouveau_motdepasse" class="form-control form-control-lg" required>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="confirmer_motdepasse" class="form-label" style="color: rgb(54, 19, 120);"><strong>Confirmer le nouveau mot de passe :</strong></label>
                                        <input type="password" id="confirmer_motdepasse" name="confirmer_motdepasse" class="form-control form-control-lg" required>
                                    </div>

                                    <div class="button-container">
                                        <button class="btn btn-dark btn-lg btn-block" id="button" type="submit" name="submit">
                                            <i class="bi bi-key"></i> Modifier le mot de passe
                                        </button>
                                        <button type="button" onclick="window.location.href='profile.php'" class="btn btn-dark btn-lg btn-block" id="button2">
                                            <i class="bi bi-x"></i> Annuler
                                        </button>
                                    </div>
                                </form>

                                <style>
                                    #button {
                                        background-color: #2995b9;
                                        border-color: #2995b9;
                                    }
                                    #button2 {
                                        background-color: #2995b9;
                                        border-color: #2995b9;
                                        color: white;
                                    }
                                    .container {
                                        position: relative;
                                        min-height: 100vh;
                                        padding-bottom: 40px;
                                    }
                                    .button-container {
                                        position: absolute;
                                        bottom: 20px;
                                        right: 20px;
                                    }
                                    button {
                                        padding: 10px 20px;
                                        border: none;
                                        border-radius: 5px;
                                        cursor: pointer;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>