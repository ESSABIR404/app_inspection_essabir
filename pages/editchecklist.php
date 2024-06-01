

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
if (!isset($_GET['idcheck'])) {
    // Rediriger si l'ID du plan n'est pas spécifié
    echo "ID du plan non spécifié";
    exit();
}

$idcheck = $_GET['idcheck'];

// Récupérer les données du plan à modifier depuis la base de données en utilisant son ID
$stmt = $conn->prepare("SELECT * FROM cheklist WHERE id = :idcheck");
$stmt->execute([':idcheck' => $idcheck]);
$plan = $stmt->fetch(PDO::FETCH_ASSOC);
$tag=$plan['tag'];
$insp=$plan['insp'];
$date_inspection=$plan['date_inspection'];
$resultat_final=$plan['resultat_final'];
$nom_insp=$plan['nom_insp'];
// Vérifier si le plan existe
if (!$plan) {
    // Rediriger si le plan n'existe pas
    echo "equipement non trouvé";
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les nouvelles informations du formulaire
    $nouveau_tag = $_POST['nouveau_tag'];
    $nouveau_insp = $_POST['nouveau_insp'];
    $nouveau_resultat_final = $_POST['nouveau_resultat_final'];
    $nouveau_nom_insp = $_POST['nouveau_nom_insp'];
    $nouveau_date_inspection = $_POST['nouveau_date_inspection'];

    // Mettre à jour les informations dans la base de données
    try {
        // Préparez et exécutez la requête de mise à jour
        $stmt = $conn->prepare("UPDATE cheklist SET 
        tag = :nouveau_tag, 
        insp = :nouveau_insp, 
        nom_insp = :nouveau_nom_insp,
        date_inspection = :nouveau_date_inspection,
        resultat_final = :nouveau_resultat_final
        WHERE id = :idcheck");

$stmt->execute([
    ':nouveau_tag' => $nouveau_tag,
    ':nouveau_insp' => $nouveau_insp,
    ':nouveau_nom_insp' => $nouveau_nom_insp,
    ':nouveau_date_inspection'=>$nouveau_date_inspection,
    ':nouveau_resultat_final'=>$nouveau_resultat_final,
    ':idcheck' => $idcheck
]);

        // Rediriger l'utilisateur vers la page de planification après la mise à jour
        header("Location: cheklist.php");
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur lors de la mise à jour
        echo "Erreur lors de la mise à jour du plan: " . $e->getMessage();
    }
}

// Le reste du code ici pour afficher le formulaire de modification avec les données du plan
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
    <title>Modifier un équipement</title>
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
    <input type="hidden" name="idcheck" value="<?php echo $idcheck; ?>">
    <div class="d-flex align-items-center mb-3 pb-1">
        <span class="h1 fw-bold mb-0" style="color: rgb(30, 1, 84);">Modifier une checklist</span>
    </div>

    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: gray; text-size-adjust: 20px;" style="color: rgb(54, 19, 120);"></h5>

    <?php if (isset($erreur)): ?>
        <div class="alert alert-danger"><?php echo $erreur; ?></div>
    <?php endif; ?>

    <div class="row">
    <div class="form-outline mb-4">
                                            <label class="form-label" for="nouveau_tag" style="color: rgb(54, 19, 120);"><strong>Tag d'équipement:</strong></label>
                                            <input type="text" id="nouveau_tag" name="nouveau_tag" class="form-control form-control-lg" value="<?php echo $tag; ?>" required />
                                        </div>

            <div class="form-outline mb-4">
                <label for="nouveau_insp" class="form-label" style="color: rgb(54, 19, 120);"><strong>Inspection :</strong></label>
                <input type="text" id="nouveau_insp" name="nouveau_insp" class="form-control form-control-lg" value="<?php echo $insp; ?>" required>
            </div>

            <div class="form-outline mb-4">
                <label for="nouveau_nom_insp" class="form-label" style="color: rgb(54, 19, 120);"><strong>Nom de l'inspecteur:</strong></label>
                <input type="text" id="nouveau_nom_insp" name="nouveau_nom_insp" class="form-control form-control-lg" value="<?php echo $nom_insp; ?>" required>
            </div>
            
          
            <div class="form-outline mb-4 d-flex justify-content-between">
    <div style="width: 45%;">
        <label class="form-label" for="nouveau_date_inspection" style="color: rgb(54, 19, 120);"><strong>Date d'inspection:</strong></label>
        <input type="date" id="nouveau_date_inspection" name="nouveau_date_inspection" class="form-control form-control-lg" value="<?php echo $date_inspection; ?>"  required />
    </div>
    <div style="width: 45%;">
        <label class="form-label" for="nouveau_resultat_final" style="color: rgb(54, 19, 120);"><strong>Résultat final:</strong></label>
        <input type="text" id="nouveau_resultat_final" name="nouveau_resultat_final" class="form-control form-control-lg" value="<?php echo $resultat_final; ?>"   required />
    </div>
</div>
    </div>

    <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" id="button" type="submit" name="submit">Enregistrer</button>
                                            <button type="button" onclick="window.location.href='cheklist.php'" class="btn btn-dark btn-lg btn-block" id="button2">
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