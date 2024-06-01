<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_inspection";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: Accueil.php");
    exit();
}

// Vérifier si l'ID du plan à modifier est présent dans l'URL
if (!isset($_GET['idinsp'])) {
    echo "ID de l'inspection non spécifié";
    exit();
}

$idinsp = $_GET['idinsp'];

// Récupérer les données de l'inspection à modifier depuis la base de données en utilisant son ID
$stmt = $conn->prepare("SELECT * FROM inspections_externe WHERE id = :idinsp");
$stmt->execute([':idinsp' => $idinsp]);

$plan = $stmt->fetch(PDO::FETCH_ASSOC);

$tag = $plan['tag'];
$insp = $plan['insp'];
$methode_insp = $plan['methode_insp'];
$etat = $plan['etat'];
$commentaire = $plan['commentaire'];

// Vérifier si l'inspection existe
if (!$plan) {
    echo "Inspection non trouvée";
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nouveau_tag = $_POST['nouveau_tag'];
    $nouveau_insp = $_POST['nouveau_insp'];
    $nouveau_methode_insp = $_POST['nouveau_methode_insp'];
    $nouveau_etat = $_POST['nouveau_etat'];
    $nouveau_commentaire = $_POST['nouveau_commentaire'];

    try {
        // Démarrer une transaction
        $conn->beginTransaction();

        // Mettre à jour les informations dans la table `inspections_externe`
        $stmt = $conn->prepare("UPDATE inspections_externe SET  
                        tag = :nouveau_tag,
                        insp = :nouveau_insp,
                        methode_insp = :nouveau_methode_insp,
                        etat = :nouveau_etat,
                        commentaire = :nouveau_commentaire
                        WHERE id = :idinsp");

        $stmt->execute([
            ':nouveau_tag' => $nouveau_tag,
            ':nouveau_insp' => $nouveau_insp,
            ':nouveau_methode_insp' => $nouveau_methode_insp,
            ':nouveau_etat' => $nouveau_etat,
            ':nouveau_commentaire' => $nouveau_commentaire,
            ':idinsp' => $idinsp 
        ]);

        // Mettre à jour les informations correspondantes dans la table `rapports`
        $stmt2 = $conn->prepare("UPDATE rapports SET
                        tag = :nouveau_tag,
                        insp = :nouveau_insp,
                        methode_insp = :nouveau_methode_insp,
                        etat = :nouveau_etat
                        WHERE id_insp_ie = :idinsp && categorie = 'externe'");

        $stmt2->execute([
            ':nouveau_tag' => $nouveau_tag,
            ':nouveau_insp' => $nouveau_insp,
            ':nouveau_methode_insp' => $nouveau_methode_insp,
            ':nouveau_etat' => $nouveau_etat,
            ':idinsp' => $idinsp
        ]);

        // Committer la transaction
        $conn->commit();

        // Rediriger l'utilisateur après la mise à jour
        header("Location: inspection-externe.php");
        exit();
    } catch (PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $conn->rollBack();
        echo "Erreur lors de la mise à jour de l'inspection : " . $e->getMessage();
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
        <div  class="container-fluid shadow " style="border-radius: 20px;">
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
                                    <input type="hidden" name="id" value="<?php echo $idinsp; ?>">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0" style="color: rgb(30, 1, 84);">Modifier les données d'une inspection</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: gray; text-size-adjust: 20px;" style="color: rgb(54, 19, 120);"></h5>

                                        <?php if (isset($erreur)): ?>
                                            <div class="alert alert-danger"><?php echo $erreur; ?></div>
                                        <?php endif; ?>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                           

       
        
        <div class="form-outline mb-4" >
        <label for="nouveau_tag" class="form-label" style="color: rgb(54, 19, 120);"><strong>Tag :</strong></label>
        <input type="text" id="nouveau_tag" name="nouveau_tag" class="form-control form-control-lg" value="<?php echo $tag; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_insp" class="form-label" style="color: rgb(54, 19, 120);"><strong> Inspection :</strong></label>
        <input type="text" id="nouveau_insp" name="nouveau_insp" class="form-control form-control-lg" value="<?php echo $insp; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_methode_insp" class="form-label" style="color: rgb(54, 19, 120);"><strong>Méthode d'inspection utilisée :</strong></label>
        <input type="text" id="nouveau_methode_insp" name="nouveau_methode_insp" class="form-control form-control-lg" value="<?php echo $methode_insp; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_etat" class="form-label" style="color: rgb(54, 19, 120);"><strong>Etat d'équipement:</strong></label>
        <input type="text" id="nouveau_etat" name="nouveau_etat" class="form-control form-control-lg" value="<?php echo $etat; ?>"required>
        </div>

       

        <div class="form-outline mb-4" >
        <label for="nouveau_commentaire" class="form-label" style="color: rgb(54, 19, 120);"><strong>Commentaire :</strong></label>
        <input type="text" id="nouveau_commentaire" name="nouveau_commentaire" class="form-control form-control-lg" value="<?php echo $commentaire; ?>"required>
      </div>

      <div class="d-flex justify-content-between pt-1 mb-4">
    <button class="btn btn-dark btn-lg" id="button" type="submit" name="submit" style="background-color:blueviolet; color: white;">Enregistrer</button>
    <button type="button" onclick="window.location.href='inspection-externe.php'" class="btn btn-dark btn-lg"  style="background-color:blueviolet; color: white">Annuler</button>
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