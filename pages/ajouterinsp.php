<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "app_inspection";

// Connexion à la base de données MySQL
try {
    $bdd = new PDO("mysql:host=$serveur;dbname=$base", $utilisateur, $motdepasse);
    // Configuration de PDO pour qu'il lève des exceptions en cas d'erreur
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérification de l'existence et de la validité des champs du formulaire
    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-Z]+[a-zA-Z]*@ocpgroup\.ma$/", $_POST['email'])) {
        $erreur = "L'adresse email est invalide ou n'est pas au format nomprenom@ocpgroup.ma !";
    } elseif (strlen($_POST['motdepasse']) < 6) {
        $erreur = 'Le mot de passe doit contenir au moins 6 caractères !';
    } elseif (!isset($_POST['nom']) || !isset($_POST['prenom'])) {
        $erreur = 'Le nom et le prénom sont obligatoires !';
    } elseif (!isset($_POST['entreprise']) || !isset($_POST['adresseent'])) {
        $erreur = 'L\'entreprise et l\'adresse de l\'entreprise sont obligatoires !';
    } elseif (!isset($_POST['poste_occupe'])) {
        $erreur = 'Le poste occupé est obligatoire !';
    } elseif (!isset($_POST['tele']) || !preg_match("/^[0-9]{10}$/", $_POST['tele'])) {
        $erreur = 'Le numéro de téléphone est invalide (format attendu : 10 chiffres) !';
    } elseif (!isset($_POST['departement'])) {
        $erreur = 'Le département est obligatoire !';
    } else {
        // Préparation de la requête SQL
        $req = $bdd->prepare('INSERT INTO inspecteurs (email, mot_de_passe, nom, prenom, entreprise, adresseent, poste_occupe, departement, telephone, type_utilisateur) 
                            VALUES (:email, MD5(:motdepasse), :nom, :prenom, :entreprise, :adresseent, :poste_occupe, :departement, :telephone, :type_utilisateur)');

        // Exécution de la requête SQL avec les valeurs des champs du formulaire
        $insertion = $req->execute(array(
            'email' => $_POST['email'], 
            'motdepasse' => $_POST['motdepasse'],
            'nom' => $_POST['nom'], 
            'prenom' => $_POST['prenom'],
            'entreprise' => $_POST['entreprise'],
            'adresseent' => $_POST['adresseent'],
            'poste_occupe' => $_POST['poste_occupe'],
            'departement' => $_POST['departement'],
            'telephone' => $_POST['tele'],
            'type_utilisateur' => 'inspecteur'
        ));

        if($insertion){
            // Envoi de l'email avec PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Paramètres du serveur SMTP (exemple pour Gmail)
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Serveur SMTP de Gmail
                $mail->SMTPAuth = true;
                $mail->Username = 'kelm55895@gmail.com'; // Votre adresse e-mail Gmail
                $mail->Password = 'gtvmsfnvpuyvgydc'; // Votre mot de passe SMTP Gmail
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Destinataire
                $mail->setFrom('kelm55895@gmail.com', 'Khadija');
                $mail->addAddress('kelm55895@gmail.com'); // L'e-mail de l'utilisateur

                // Contenu de l'e-mail
                $mail->isHTML(true);
                $mail->Subject = 'Bienvenue chez nous';
                $mail->Body = 'Bonjour ' . $_POST['prenom'] . ',<br><br>Bienvenue chez nous. Votre mot de passe est : ' . $_POST['motdepasse'];

                $mail->send();
                // Redirection vers la page de tableau de bord
                header("Location: ../pages/inspecteurs.php");
                exit(); // Assure la fin de l'exécution du script après la redirection
            } catch (Exception $e) {
                $erreur = 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
            }
        } else {
            $erreur = "Erreur : l'insertion dans la base de données a échoué !";
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
    <title>Inspection</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="index.js"></script>
    <style>
        #button {
            background-color: #2995b9;
            border-color: #2995b9;
        }
        #button2 {
            background-color: #2995b9;
            border-color: #2995b9;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid shadow" style="border-radius: 20px;">
        <a class="navbar-brand" href="index.php">
            <img src="../pictures/logoinsp.jpg" width="170px" height="45px" style="margin-left: 20px; margin-bottom: 5px;">
        </a>
    </div>
</nav>
<section class="vh-100" style="background-color: #ffffff; background-size:contain;">
    <div class="container py-xxl-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
            <div class="card-body p-4 p-lg-5 text-black">
                                <form action="" method="post">

                                    <div style="margin-left: 25%;" class="d-flex align-items-center mb-3 pb-1">
                                        <span class="h1 fw-bold mb-0" style="color: rgb(30, 1, 84);">Ajouter un inspecteur</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: gray; text-size-adjust: 20px;"></h5>

                                    <?php if (isset($erreur)): ?>
                                        <div class="alert alert-danger"><?php echo $erreur; ?></div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="nom" style="color: rgb(54, 19, 120);"><strong>Nom :</strong></label>
                                                <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom de famille" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="prenom" style="color: rgb(54, 19, 120);"><strong>Prénom :</strong></label>
                                                <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email" style="color: rgb(54, 19, 120);"><strong>Email :</strong></label>
                                        <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="nomprenom@ocpgroup.ma" required pattern="^[a-zA-Z]+[a-zA-Z]*@ocpgroup\.ma$" title="L'email doit être au format nomprenom@ocpgroup.ma" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="motdepasse" style="color: rgb(54, 19, 120);"><strong>Mot de passe :</strong></label>
                                        <input type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe" class="form-control form-control-lg" required />
                                        <input type="checkbox" id="motdepasse" class="form-check-input" onclick="afficherMotDePasse()">Afficher le mot de passe
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="tele" style="color: rgb(54, 19, 120);"><strong>N° Téléphone :</strong></label>
                                        <input type="tel" id="tele" name="tele" class="form-control form-control-lg" placeholder="N° Téléphone" required pattern="^[0-9]{10}$" title="Le numéro de téléphone doit contenir 10 chiffres." />
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="entreprise" style="color: rgb(54, 19, 120);"><strong>Entreprise :</strong></label>
                                                <input type="text" id="entreprise" name="entreprise" class="form-control" placeholder="Entreprise" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="adresseent" style="color: rgb(54, 19, 120);"><strong>Adresse d'entreprise :</strong></label>
                                                <input type="text" id="adresseent" name="adresseent" class="form-control" placeholder="Adresse d'entreprise" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="departement" style="color: rgb(54, 19, 120);"> <strong> Département : </strong></label>
                                        <input type="texte" id="departement" name="departement" class="form-control form-control-lg" placeholder="Département" required />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="poste_occupe" style="color: rgb(54, 19, 120);"> <strong> Poste occupé : </strong></label>
                                        <input type="text" id="poste_occupe" name="poste_occupe" class="form-control form-control-lg" placeholder="Poste occupé" required />
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" id="button" type="submit" name="submit">Ajouter</button>
                                        <button type="button" onclick="window.location.href='inspecteurs.php'" class="btn btn-dark btn-lg btn-block" id="button2">Annuler</button>
                                    </div>
                                </form>
                            </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>