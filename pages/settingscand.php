<?php
// Démarrer la session
session_start();
$nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';
$prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : '';
$type_utilisateur = isset($_SESSION['type_utilisateur']) ? $_SESSION['type_utilisateur'] : '';
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
    <title>Dashboard</title>
    <style>
      img{
        width : 170px;
        }  
        #button{
        background-color: #2995b9;
        border-color: #2995b9;
        margin-left: 20px;
        }
    </style>
</head>
<body>
<div class="page d-flex">
            <div class="sidebar bg-white p-20 p-relative">
                <a href="index.php">
            <img src="../pictures/logoinsp.jpg" alt="logo" class="p-relative " >
            </a>
                <ul>
                   
                <?php
               //Verifier si l'utilisateur est connecter
               if(!isset($_SESSION['email'])) {
                 echo <<<HTML
                   <li>
                    <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="settingscand.php">
                        <i class="fa-solid fa-gear"></i>
                        <span>Paramètres</span>
                    </a>
                   </li>
                   <li>
                 <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="connexion.php">
                       <i class="fa-solid fa-user"></i>
                       <span>Profile</span>
                 </a>
                 </li>
                 <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="Acceuil.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Se déconnecter</span>
                        </a>
                    </li>
                HTML;
               } elseif($type_utilisateur === 'inspecteur') { 
                 echo <<<HTML
                   <li>
                    <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="settingscand.php">
                        <i class="fa-solid fa-gear"></i>
                        <span>Paramètres</span>
                    </a>
                  </li>
                  <li>
                  <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="profile.php">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                  </a>
                  </li>
                  <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="Acceuil.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Se déconnecter</span>
                        </a>
                    </li>
                 HTML;
               }
               ?>
            </ul>
        </div>
        <div class="content w-full">
            <div class="head bg-white p-15 between-flex">
                 
                <div  class="icons d-flex align-center" style="margin-left: 82%;">
                <?php
                    // Vérifier si l'utilisateur est connecté
                    if (!isset($_SESSION['email'])) {
                        echo '<a href="connexion.php"><button id="button" type="button" class="btn btn-outline-dark">S\'identifier</button></a>';
                    } else {
                        // Les coordonnées de l'utilisateur
                        

                        // Afficher les informations en fonction du type d'utilisateur
                        if ($type_utilisateur === 'candidat') {
                            echo '<span>' . $nom . ' ' . $prenom . '</span><img src="../pictures/anonym.jpg" alt="">';
                        } else {
                            // Afficher les informations pour les autres types d'utilisateurs
                        }
                    }
                ?>
                </div>
            </div>
            <h1 class="p-relative">Paramètres</h1>
            <div class="settings-page m-20 ">
                <div class="p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10">Contrôle du Site</h2>
                    <p class="mt-0 mb-20 c-grey fs-15">Contrôler le Site Web en cas de Maintenance</p>
                    <div class="mb-15 between-flex">
                        <div>
                            <span>Contrôle du Site Web</span>
                            <p class="c-grey mt-5 mb-0 fs-13">Ouvrir/fermer le site Web et saisir la raison</p>
                        </div>
                    </div>
                    <textarea class="close-message p-10 rad-6 d-block w-full" placeholder="Pouquoi tu veux fermer le Site?"></textarea>
                </div>
            </div>
        </div>
    </div>
</body>
</html>