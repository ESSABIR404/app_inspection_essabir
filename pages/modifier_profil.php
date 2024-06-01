<?php
// Inclure la connexion à la base de données et d'autres fichiers nécessaires

// Vérifier si l'utilisateur est connecté
session_start();
include_once'cnx.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
if(!isset($_SESSION['email'])) {
    header("Location: Acceuil.php");
    exit();
}}

// Récupérer les informations de l'utilisateur à partir de la session
// Ces informations seront pré-remplies dans le formulaire
$type_utilisateur = $_SESSION['type_utilisateur'];
$email = $_SESSION['email'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$entreprise = $_SESSION['entreprise'];
$adresseent = $_SESSION['adresseent'];
$telephone = $_SESSION['telephone'];
$departement = $_SESSION['departement'];
$poste_occupe = $_SESSION['poste_occupe'];

//Traitement du formulaire de modification
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    // Récupérer les nouvelles informations du formulaire
    $nouveau_type_utilisateur = $_POST['nouveau_type_utilisateur'];
    $nouveau_nom = $_POST['nouveau_nom'];
    $nouveau_prenom = $_POST['nouveau_prenom'];
    $nouveau_email = $_POST['nouveau_email'];
    $nouveau_entreprise = $_POST['nouveau_entreprise'];
    $nouveau_adresseent = $_POST['nouveau_adresseent'];
    $nouveau_telephone = $_POST['nouveau_telephone'];
    $nouveau_departement = $_POST['nouveau_departement'];
    $nouveau_poste_occupe = $_POST['nouveau_poste_occupe'];
    // Mettre à jour les informations dans la base de données
// Mettre à jour les informations dans la base de données
// Mettre à jour les informations dans la base de données
try {
  // Commencez la transaction
  $conn->beginTransaction();


  
  $stmt1 = $conn->prepare("UPDATE ingénieurseninspection SET 
                        type_utilisateur = :nouveau_type_utilisateur, 
                        nom = :nouveau_nom, 
                        prenom = :nouveau_prenom, 
                        email = :nouveau_email, 
                        entreprise = :nouveau_entreprise, 
                        adresseent = :nouveau_adresseent, 
                        telephone = :nouveau_telephone , 
                        departement = :nouveau_departement, 
                        poste_occupe = :nouveau_poste_occupe
                        WHERE email = :email");

  $stmt1->execute([
      ':nouveau_type_utilisateur' => $nouveau_type_utilisateur,
      ':nouveau_nom' => $nouveau_nom,
      ':nouveau_prenom' => $nouveau_prenom,
      ':nouveau_email' => $nouveau_email,
      ':nouveau_entreprise' => $nouveau_entreprise,
      ':nouveau_adresseent' => $nouveau_adresseent,
      ':nouveau_telephone' => $nouveau_telephone,    
      ':nouveau_departement' => $nouveau_departement,
      ':nouveau_poste_occupe' => $nouveau_poste_occupe,
      ':email' => $email
  ]);
  

  // Mettez à jour les informations dans la table "inspecteurs" si nécessaire
  $stmt2 = $conn->prepare("UPDATE inspecteurs SET 
                        type_utilisateur = :nouveau_type_utilisateur, 
                        nom = :nouveau_nom, 
                        prenom = :nouveau_prenom, 
                        email = :nouveau_email, 
                        entreprise = :nouveau_entreprise, 
                        adresseent = :nouveau_adresseent, 
                        departement = :nouveau_departement, 
                        telephone = :nouveau_telephone,  
                        poste_occupe = :nouveau_poste_occupe 
                        WHERE email = :email");

  $stmt2->execute([
      ':nouveau_type_utilisateur' => $nouveau_type_utilisateur,
      ':nouveau_nom' => $nouveau_nom,
      ':nouveau_prenom' => $nouveau_prenom,
      ':nouveau_email' => $nouveau_email,
      ':nouveau_entreprise' => $nouveau_entreprise,
      ':nouveau_adresseent' => $nouveau_adresseent,
      ':nouveau_telephone' => $nouveau_telephone,
      ':nouveau_departement' => $nouveau_departement,
      ':nouveau_poste_occupe' => $nouveau_poste_occupe,
      ':email' => $email
  ]);
 $_SESSION['type_utilisateur']=  $nouveau_type_utilisateur ;
  $_SESSION['email']=$nouveau_email;
 $_SESSION['nom']=$nouveau_nom ;
 $_SESSION['prenom']=$nouveau_prenom ;
 $_SESSION['entreprise']=$nouveau_entreprise ;
$_SESSION['adresseent']=$nouveau_adresseent ;
  $_SESSION['telephone']=$nouveau_telephone;
 $_SESSION['departement']=$nouveau_departement ;
  $_SESSION['poste_occupe']=$nouveau_poste_occupe;

  // Validez la transaction
  $conn->commit();

  // Rediriger l'utilisateur vers la page de profil après la mise à jour
  header("Location: profile.php");
  exit();
} catch(PDOException $e) {
  // En cas d'erreur lors de la mise à jour
  $conn->rollBack(); // Annulez la transaction en cas d'erreur
  echo "Erreur lors de la mise à jour des informations: " . $e->getMessage();
}
}?>

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
    <title>Modifier le profil</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary " >
        <div class="container-fluid shadow " style="border-radius: 20px;">
        <img src="../pictures/logoinsp.jpg" width="170px" height="45px" style="margin-left: 20px; margin-bottom: 10px;">
        <a class="navbar-brand" href="index.php">

          </a>
        </div>
      </nav>
      
    <section class="vh-100" style="background-color: #ffffff; background-size:contain;">
        <div class="container  py-xxl-1 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card shadow-lg" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="../pictures/fotos9.webp"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; margin-top: 200px; height: 500px; width: 900px;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                      
                     
      
                        <div class="d-flex align-items-center mb-3 pb-1">
                          
                        <span class="h1 fw-bold mb-0" style="color: rgb(30, 1, 84);">Modifier le profil</span>
                        </div>
   
    <form action="" method="post">
    
    <div class="form-outline mb-4" >
        <label for="nouveau_type_utilisateur" class="form-label" style="color: rgb(54, 19, 120);"><strong>type d'utilisateur :</strong></label>
        <input type="text" id="nouveau_type_utilisateur" name="nouveau_type_utilisateur" class="form-control form-control-lg" value="<?php echo $type_utilisateur; ?>"required>
        </div>
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
        <div class="button-container">
    <button class="btn btn-dark btn-lg btn-block" id="button" type="submit" name="submit">
        <i class="bi bi-check"></i> Enregistrer les modifications
    </button>
    <button type="button" onclick="window.location.href='profile.php'" class="btn btn-dark btn-lg btn-block" id="button2">
        <i class="bi bi-x"></i> Annuler
    </button>
</div>





 

    </form>
   
    <style>
     #button{
      background-color: #2995b9;
      border-color: #2995b9;

      
     }
     #button2{
      background-color: #2995b9;
      border-color: #2995b9;
      color: white;

      
     }
     .container {
            position: relative;
            min-height: 100vh; /* Pour que la div prenne toute la hauteur de la fenêtre */
            padding-bottom: 40px; /* Pour que le bouton ne soit pas caché par le pied de page */
        }

        .button-container {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        /* Styles directement appliqués à la balise button */
        button {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
</style>

</body>
</html>
