<?php
session_start();
include_once'cnx.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 

    $email = $_POST['email'] ?? '';
    $motdepasse = $_POST['motdepasse'] ?? '';
    $type_utilisateur = $_POST['type_utilisateur'] ?? '';

    if ($type_utilisateur == 'ingénieur_en_inspection') {
        $stmt = $conn->prepare('SELECT * FROM ingénieurseninspection WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $ingénieur_en_inspection = $stmt->fetch();

        if (!$ingénieur_en_inspection) {
            $erreur = 'Cet email n\'existe pas.';
        }elseif (md5($ingénieur_en_inspection['sel'] . $motdepasse) !== $ingénieur_en_inspection['mot_de_passe']) {
          $erreur = 'Mot de passe incorrect.';
         } else {
            $_SESSION['type_utilisateur'] = $type_utilisateur;
            $_SESSION['email'] = $email;
            $_SESSION['nom'] = $ingénieur_en_inspection['nom'];
            $_SESSION['prenom'] = $ingénieur_en_inspection['prenom'];
            $_SESSION['entreprise'] = $ingénieur_en_inspection['entreprise'];
            $_SESSION['adresseent'] = $ingénieur_en_inspection['adresseent'];
            $_SESSION['departement'] = $ingénieur_en_inspection['departement'];
            $_SESSION['telephone'] = $ingénieur_en_inspection['telephone'];
            $_SESSION['poste_occupe'] = $ingénieur_en_inspection['poste_occupe'];
            $_SESSION['role'] = $ingénieur_en_inspection['role'];
            header('Location: profile.php');
            exit;
        }
    } elseif ($type_utilisateur == 'inspecteur') {
        $stmt = $conn->prepare('SELECT * FROM inspecteurs WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $inspecteur = $stmt->fetch();

        if (!$inspecteur) {
          $erreur = 'Cet email n\'existe pas.';
        }
       elseif (md5($inspecteur['sel'] . $motdepasse) !== $inspecteur['mot_de_passe']) {
         $erreur = 'Mot de passe incorrect.';
        } 
         else {
            $_SESSION['type_utilisateur'] = $type_utilisateur;
            $_SESSION['email'] = $email;
            $_SESSION['nom'] = $inspecteur['nom'];
            $_SESSION['prenom'] = $inspecteur['prenom'];
            $_SESSION['entreprise'] = $inspecteur['entreprise'];
            $_SESSION['adresseent'] = $inspecteur['adresseent'];
            $_SESSION['departement'] = $inspecteur['departement'];
            $_SESSION['telephone'] = $inspecteur['telephone'];
          
            $_SESSION['poste_occupe'] = $inspecteur['poste_occupe'];
            $_SESSION['role'] = $inspecteur['role'];
            header('Location: profile.php');
            exit;
        }
    } else {
        $erreur = 'Veuillez sélectionner votre type d\'utilisateur.';
    }

    $conn = null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link  rel="stylesheet" href="../css/bootstrap.css" >
    <link href="connexion.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="index.js"></script>
    <style>
      
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
      }

      .nav-a ul li {
        position: relative;
        margin-left: 5%;
        margin-top: 2%;
      }

      .nav-a ul li a {
        color: black;
      }

      .containerH {
        width: 100%;
        height: 512px;
      }

     

      
      .div-connexion-form{
        margin-top: 3%;
        padding-left: 10%;
        padding-right: 10%;
        width: 80%;
        margin-left: 10%;
        
      }
      .div-span-h4 span{
        margin-left: 40%;
        margin-top: 3%;
      }
      .btn-connexion-c {
        margin-left: 45%;
        border: none;
        border-radius: 18px;
        height: 45px;
        width: 280px;
        background-color: #2995b9 !important;
        color: #fff;
      }
      .modifier-ps-co a{
        cursor: pointer;
        margin-left: 150px;
        color: #2995b9 !important;
      }
      .modifier-ps-co a:hover{
        
        text-decoration: underline;
      }
      .form-outline-c{
        display: flex;
      }
      .form-outline-c label{
          width: 200px;
          align-content: center;
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
          <li><a href="index.php">Acceuil</a></li>
          <li><a href="#">Notre Site</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="containerH px-4 px-lg-5">
    <div class="div-span-h4 d-flex align-items-center mb-3 pb-1 div-connex">
                <span class="h4 fw-bold mb-0" >Connectez-vous</span>
            </div>
    <div class="div-connexion-form">
      <form method="post" >
                          
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger"><?php echo $erreur; ?></div>
        <?php endif; ?>
            <div class="form-outline-c mb-4">
              
              <label class="form-label" for="form2Example17" style="color: rgb(30, 1, 84);"><strong>Type d'utilisateur :</strong></label>
              <input type="text" id="form2Example17" name="type_utilisateur" class="form-control form-control-lg" placeholder="inspecteur/ingénieur_en_inspection" required/>
            </div>
            <div class="form-outline-c mb-4">
              
              <label class="form-label" for="form2Example17" style="color: rgb(30, 1, 84);"><strong>Email :</strong></label>
              <input type="email" id="form2Example17" name="email" class="form-control form-control-lg" placeholder="nomprenom@ocpgroup.ma" required/>
            </div>

            <div class="form-outline-c mb-4">
              <label class="form-label"  for="motdepasse" style="color: rgb(30, 1, 84);"><strong>Mot de passe :</strong></label>
              <input type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe" class="form-control form-control-lg" required />
              

            </div>
            <input type="checkbox" id="motdepasse" class="form-check-input" onclick="afficherMotDePasse()" style="margin-left: 150px;"> Afficher le mot de passe

            <div class="pt-1 mb-4">
              <button class="btn-connexion-c" id="button" type="submit"  style="margin-top:50px;">Connexion</button>
            </div>
            <div class="modifier-ps-co">
                                    <a href='mot_de_passe_oublier.php'>  mot de passe oublier?</a>
                          </div>
          </form>

        </div>

  </div>
  <!-- Footer -->
  <footer class="text-center text-lg-start bg-light text-muted">
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"></section>
    <!-- Section: Links  -->
    <footer class="footer">
      <section class="grid">
        <div class="credit">&copy; copyright @2024 by <span>groupgi devweb</span> | all rights reserved!</div>
      </section>
    </footer>
  </footer>
      

     
     </body>
     </html>