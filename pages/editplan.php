

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
if (!isset($_GET['id_plan'])) {
    // Rediriger si l'ID du plan n'est pas spécifié
    echo "ID du plan non spécifié";
    exit();
}

$id_plan = $_GET['id_plan'];

// Récupérer les données du plan à modifier depuis la base de données en utilisant son ID
$stmt = $conn->prepare("SELECT * FROM planisnp WHERE idp = :id_plan");
$stmt->execute([':id_plan' => $id_plan]);
$plan = $stmt->fetch(PDO::FETCH_ASSOC);
$numeq=$plan['numeq'];
$tache=$plan['tache'];
$datedebut=$plan['datedebut'];
$datefin=$plan['datefin'];
$frequence=$plan['frequence'];
// Vérifier si le plan existe
if (!$plan) {
    // Rediriger si le plan n'existe pas
    echo "Plan non trouvé";
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les nouvelles informations du formulaire
    $nouveau_numeq = $_POST['nouveau_numeq'];
    $nouveau_tache = $_POST['nouveau_tache'];
    $nouveau_datedebut = $_POST['nouveau_datedebut'];
    $nouveau_datefin = $_POST['nouveau_datefin'];
    $nouveau_frequence = $_POST['nouveau_frequence'];

    // Mettre à jour les informations dans la base de données
    try {
        // Préparez et exécutez la requête de mise à jour
        $stmt = $conn->prepare("UPDATE planisnp SET 
                        numeq = :nouveau_numeq, 
                        tache = :nouveau_tache, 
                        datedebut = :nouveau_datedebut, 
                        datefin = :nouveau_datefin,
                        frequence = :nouveau_frequence
                        WHERE idp = :id_plan");

        $stmt->execute([
            ':nouveau_numeq' => $nouveau_numeq,
            ':nouveau_tache' => $nouveau_tache,
            ':nouveau_datedebut' => $nouveau_datedebut,
            ':nouveau_datefin' => $nouveau_datefin,
            ':nouveau_frequence' => $nouveau_frequence,
            ':id_plan' => $id_plan
        ]);

        // Rediriger l'utilisateur vers la page de planification après la mise à jour
        header("Location: planing.php");
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
    <script src="pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
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
                                        <input type="hidden" name="id_plan" value="<?php echo $id_plan; ?>">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0" style="color: rgb(30, 1, 84);">Modifier le plan </span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: gray; text-size-adjust: 20px;" style="color: rgb(54, 19, 120);"></h5>

                                        <?php if (isset($erreur)): ?>
                                            <div class="alert alert-danger"><?php echo $erreur; ?></div>
                                        <?php endif; ?>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                            <div class="form-outline mb-4" >

        <div class="form-outline mb-4" >
        <label for="nouveau_numeq" class="form-label" style="color: rgb(54, 19, 120);"><strong>Tag:</strong></label>
        <input type="text" id="nouveau_numeq" name="nouveau_numeq" class="form-control form-control-lg" value="<?php echo $numeq; ?>"required>
        </div>
        
        <div class="form-outline mb-4" >
        <label for="nouveau_tache" class="form-label" style="color: rgb(54, 19, 120);"><strong>Tâche:</strong></label>
        <input type="text" id="nouveau_tache" name="nouveau_tache" class="form-control form-control-lg" value="<?php echo $tache; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_datedebut" class="form-label" style="color: rgb(54, 19, 120);"><strong> Date de début :</strong></label>
        <input type="date" id="nouveau_datedebut" name="nouveau_datedebut" class="form-control form-control-lg" value="<?php echo $datedebut; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_datefin" class="form-label" style="color: rgb(54, 19, 120);"><strong>Date de fin :</strong></label>
        <input type="date" id="nouveau_datefin" name="nouveau_datefin" class="form-control form-control-lg" value="<?php echo $datefin; ?>"required>
        </div>

        <div class="form-outline mb-4" >
        <label for="nouveau_frequence" class="form-label" style="color: rgb(54, 19, 120);"><strong>Fréquence:</strong></label>
        <input type="text" id="nouveau_frequence" name="nouveau_frequence" class="form-control form-control-lg" value="<?php echo $frequence; ?>"required>
        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" id="button" type="submit" name="submit" style="background-color:blueviolet; color: white;">Enregistrer</button>
                                            <button type="button" onclick="window.location.href='planing.php'" class="btn btn-dark btn-lg btn-block" id="button2">
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