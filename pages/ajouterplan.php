<?php 

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
     if (!isset($_POST['numeq']) ) {
        $erreur = 'Le champ de N° d équipement est obligatoire !';
    } elseif (!isset($_POST['tache']) ) {
        $erreur = 'Le champ de tache est obligatoire !';
    } elseif (!isset($_POST['datedebut']) ) {
        $erreur = 'Le champ de la date de début est obligatoire !';
    } elseif (!isset($_POST['datefin']) ) {
        $erreur = 'Le champ de la date de fin est obligatoire !';
    }elseif (!isset($_POST['frequence']) ) {
        $erreur = 'Le champ de fréquence est obligatoire !';
    }
    
 else {
        // Préparation de la requête SQL
        $req = $bdd->prepare('INSERT INTO planisnp (numeq, tache, datedebut, datefin, frequence) 
                            VALUES (:numeq, :tache, :datedebut, :datefin, :frequence) ');

        // Exécution de la requête SQL avec les valeurs des champs du formulaire
        $insertion = $req->execute(array(
            'numeq' => $_POST['numeq'], 
            'tache' => $_POST['tache'],
            'datedebut' => $_POST['datedebut'], 
            'datefin' => $_POST['datefin'],
            'frequence' => $_POST['frequence']
   ));

   if($insertion){
    session_start();
    // Stockage des données utilisateur dans la session
  

    // Redirection vers la page de tableau de bord
    header("Location: ../pages/planing.php");
    exit(); // Assure la fin de l'exécution du script après la redirection
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

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0" style="color: rgb(30, 1, 84);">Ajouter un plan d'inspection</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: gray; text-size-adjust: 20px;" style="color: rgb(54, 19, 120);"></h5>

                                        <?php if (isset($erreur)): ?>
                                            <div class="alert alert-danger"><?php echo $erreur; ?></div>
                                        <?php endif; ?>

                                        <div class="row">
                                
                      

                                        <div class="form-outline mb-4">
    <label class="form-label" for="numeq" style="color: rgb(54, 19, 120);"><strong>N° d'équipement :</strong></label>
    <input type="text" id="numeq" name="numeq" class="form-control form-control-lg" placeholder="N° d'équipement"required/>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="tache" style="color: rgb(54, 19, 120);"><strong>Tâche :</strong></label>
    <input type="text" id="tache" name="tache" class="form-control form-control-lg" placeholder="Tâche"required/>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="datedebut" style="color: rgb(54, 19, 120);"><strong>Date de début :</strong></label>
    <input type="date" id="datedebut" name="datedebut" class="form-control form-control-lg" placeholder="Date de début"required/>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="datefin" style="color: rgb(54, 19, 120);"><strong>Date de fin :</strong></label>
    <input type="date" id="datefin" name="datefin" class="form-control form-control-lg" placeholder="Date de fin"required/>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="frequence" style="color: rgb(54, 19, 120);"><strong>Fréquence :</strong></label>
    <input type="text" id="frequence" name="frequence" class="form-control form-control-lg" placeholder="Fréquence"required/>
</div>


                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" id="button" type="submit" name="submit">Ajouter</button>
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