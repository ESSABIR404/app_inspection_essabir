

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
$id_inspecteur="";
$nom="";
$prenom="";
$email="";
$telephone="";
$entreprise="";
$adresseent="";
$poste_occupe="";
$departement="";
$errorMessage="";
$successMessage="";

// Récupérer l'ID de l'inspecteur à partir de l'URL
if (isset($_GET['id_inspecteur'])) {
    $id_inspecteur = $_GET['id_inspecteur'];

    // Requête pour récupérer les données de l'inspecteur à partir de l'ID
    $stmt = $conn->prepare("SELECT * FROM inspecteurs WHERE id_inspecteur = :id_inspecteur");
    $stmt->bindParam(':id_inspecteur', $id_inspecteur);
    $stmt->execute();
    // Vérifier si l'inspecteur existe
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Récupérer les données de l'inspecteur
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $entreprise = $row['entreprise'];
        $adresseent = $row['adresseent'];
        $telephone = $row['telephone'];
        $departement = $row['departement'];
        $poste_occupe = $row['poste_occupe'];
    } else {
        // L'inspecteur n'existe pas, rediriger ou afficher un message d'erreur
        header("Location: inspecteurs.php");
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_inspecteur = $_POST['id_inspecteur'];
    $nom = $_POST['nouveau_nom'];
    $prenom = $_POST['nouveau_prenom'];
    $email = $_POST['nouveau_email'];
    $entreprise = $_POST['nouveau_entreprise'];
    $adresseent = $_POST['nouveau_adresseent'];
    $telephone = $_POST['nouveau_telephone'];
    $departement = $_POST['nouveau_departement'];
    $poste_occupe = $_POST['nouveau_poste_occupe'];

    try {
        // Préparer la requête de mise à jour
        $stmt = $conn->prepare("UPDATE inspecteurs SET 
                                nom = :nom, 
                                prenom = :prenom, 
                                email = :email, 
                                entreprise = :entreprise, 
                                adresseent = :adresseent, 
                                telephone = :telephone, 
                                departement = :departement, 
                                poste_occupe = :poste_occupe 
                                WHERE id_inspecteur = :id_inspecteur");

        // Exécuter la requête
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':entreprise' => $entreprise,
            ':adresseent' => $adresseent,
            ':telephone' => $telephone,
            ':departement' => $departement,
            ':poste_occupe' => $poste_occupe,
            ':id_inspecteur' => $id_inspecteur
        ]);

        // Redirection vers la page inspecteurs.php après la mise à jour
        header("Location: inspecteurs.php");
        exit();
    } catch(PDOException $e) {
        $errorMessage = "Erreur lors de la mise à jour : " . $e->getMessage();
    }
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
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
    <title>Modifier un inspecteur</title>
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
<nav class="navbar navbar-expand-lg bg-body-tertiary " >
        <div class="container-fluid shadow " style="border-radius: 20px;">
          <a class="navbar-brand" href="index.php">
            <img src="../pictures/logoinsp.jpg" width="170px" height="45px"  style="margin-left: 20px; margin-bottom: 5px;">
          </a>
        
        </div>
      </nav>
      
    <section class="vh-100" style="background-color: #ffffff; background-size:contain;">
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
                                    <form action="" method="post">
                                    <input type="hidden" name="id_inspecteur" value="<?php echo $id_inspecteur; ?>">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0" style="color: rgb(30, 1, 84);">Modifier les données d'un inspecteur</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: gray; text-size-adjust: 20px;" style="color: rgb(54, 19, 120);"></h5>

                                        <?php if (isset($erreur)): ?>
                                            <div class="alert alert-danger"><?php echo $erreur; ?></div>
                                        <?php endif; ?>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                            <div class="form-outline mb-4" >
        <label for="nouveau_nom" class="form-label" style="color: rgb(54, 19, 120);"><strong>Nom :</strong></label>
        <input type="text" id="nouveau_nom" name="nouveau_nom" class="form-control form-control-lg" value="<?php echo $nom; ?>"required>
        </div>
    
        <div class="form-outline mb-4" >
        <label for="nouveau_prenom" class="form-label" style="color: rgb(54, 19, 120);"><strong>Prénom :</strong></label>
        <input type="text" id="nouveau_prenom" name="nouveau_prenom" class="form-control form-control-lg" value="<?php echo $prenom; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_email" class="form-label" style="color: rgb(54, 19, 120);"><strong> Email :</strong></label>
        <input type="text" id="nouveau_email" name="nouveau_email" class="form-control form-control-lg" value="<?php echo $email; ?>"required>
        </div>
        
        <div class="form-outline mb-4" >
        <label for="nouveau_entreprise" class="form-label" style="color: rgb(54, 19, 120);"><strong>Entreprise :</strong></label>
        <input type="text" id="nouveau_entreprise" name="nouveau_entreprise" class="form-control form-control-lg" value="<?php echo $entreprise; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_adresseent" class="form-label" style="color: rgb(54, 19, 120);"><strong> Adresse d'entreprise :</strong></label>
        <input type="text" id="nouveau_adresseent" name="nouveau_adresseent" class="form-control form-control-lg" value="<?php echo $adresseent; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_telephone" class="form-label" style="color: rgb(54, 19, 120);"><strong>N°Téléphone :</strong></label>
        <input type="text" id="nouveau_telephone" name="nouveau_telephone" class="form-control form-control-lg" value="<?php echo $telephone; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_departement" class="form-label" style="color: rgb(54, 19, 120);"><strong>Département:</strong></label>
        <input type="text" id="nouveau_departement" name="nouveau_departement" class="form-control form-control-lg" value="<?php echo $departement; ?>"required>
        </div>

       

        <div class="form-outline mb-4" >
        <label for="nouveau_poste_occupe" class="form-label" style="color: rgb(54, 19, 120);"><strong>Poste occupé :</strong></label>
        <input type="text" id="nouveau_poste_occupe" name="nouveau_poste_occupe" class="form-control form-control-lg" value="<?php echo $poste_occupe; ?>"required>
      </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" id="button" type="submit" name="submit" style="background-color:blueviolet; color: white;">Enregistrer</button>
                                            <button type="button" onclick="window.location.href='inspecteurs.php'" class="btn btn-dark btn-lg btn-block" id="button2">
                                             Annuler
                                            </button>
                                        </div>     
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>