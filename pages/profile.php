<?php
// Démarrer la session
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

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupérer les valeurs de session
$email = $_SESSION['email'];
$type_utilisateur = $_SESSION['type_utilisateur'];

// Définir la table en fonction du type d'utilisateur
$table_utilisateur = '';
if ($type_utilisateur === 'inspecteur') {
    $table_utilisateur = 'inspecteurs';
} elseif ($type_utilisateur === 'ingénieur_en_inspection') {
    $table_utilisateur = 'ingénieurseninspection';
}

// Préparer la requête SQL en fonction du type d'utilisateur
$stmt = $conn->prepare("SELECT * FROM $table_utilisateur WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    // Si une ligne est retournée, cela signifie que l'utilisateur existe
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les données de l'utilisateur en fonction du type
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $adresseent = $row['adresseent'];
    $entreprise = $row['entreprise'];
    $departement = $row['departement'];
    $poste_occupe = $row['poste_occupe'];
    $telephone = $row['telephone'];
} else {
    // Utilisateur non trouvé dans la base de données, déconnexion et redirection vers la page de connexion
    session_unset();
    session_destroy();
    header("Location: Acceuil.php");
    exit();
}

// Fermer la connexion à la base de données
$conn = null;
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
    <script src="index.js"></script>
    <script src="pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
 <style> 
 a:hover {
    background-color: white;
    color: blue;
}
 
 li {
    list-style-type: none;
    :root{
--col::#212529;
--main-color: #2995b9;
--red:red ;
--light-color:#777;
--light-bg:#eee;
--black:#2c3e50;
--white:#fff;
--box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
--border:.1rem solid rgba(,0,0,.2)

}
         #button{
        background-color: #2995b9;
        border-color: #2995b9;
        margin-left: 20px;
        }
        h5{
          color: #2995b9;
        }

        .footer.grid{
    font-size:80%;
    overflow-x: hidden;
    scroll-padding-top: 7rem;
    scroll-behavior: smooth;
}

section{
    padding: 2rem;
    margin:0 auto ;
    max-width: 1200px;



}

.footer .grid{
    display: grid;
    grid-template-columns: repeat(auto-fit, 30rem);
    gap: 1.5rem;
    justify-content: center;
    align-items: flex-start;
}
.footer .grid .box h3{
    font-size: 2rem;
    color: var(--black);
    margin: 1rem 0;
    padding-bottom: 1rem;
    text-transform: capitalize;}

.footer .grid .box a{
    display: block;
    padding: 1.5rem 0;
    font-size: 1.6rem;
    color: var(--light-color);
}

.footer .grid .box a i{
    color: var(--main-color);
    margin-right: .8rem;
    transition: .2s linear;

}
footer .grid .box a:hover i{
    margin-right: 2rem;
}
.footer .credit{
    text-align: center;
    padding:3rem  2rem;
    border-top: var(--border);
    background-color: var(--white);
    font-size: 2rem;

    color: var(--light-color);
    line-height: 1.5;
}
.footer .credit span{
    color: var(--main-color);
    text-transform: capitalize;
}
}
.modifier-ps{
    text-align: end;
    margin-left: 650px;
    margin-top: 20px;
}
.modifier-ps a{
    cursor: pointer;
    text-decoration: underline !important;
}
.modifier-ps a:hover{
    color: #2995b9 !important;
}
</style>
    <title>Dashboard</title>
    
</head>
<body>



    <div class="page d-flex">
    
    <div class="sidebar  p-20 p-relative" style="background-color:blueviolet; color: white; .footer .grid .box a:hover {
    background-color: white;
    color: var(--main-color); /* Couleur du texte au survol */
}">
        <img src="../pictures/logoinsp.jpg" width="170px" height="45px" style="margin-left: 20px; margin-bottom: 5px;">
      
      </a>
            <?php
                if ($type_utilisateur === 'ingénieur_en_inspection' ) {
                    echo <<<HTML
               
                    <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="profile.php">
                                  <i class="fa-solid fa-user"></i>
                                  <span>Profil</span>
                          </a>
                    </li>
                    <li>
                       <a class=" d-flex align-center fs-14 c-black rad-6 p-10" id="usersLink" >
                           <i class="fa-solid fa-users"></i>
                           <span>Utilisateurs</span>
                           </a>
                           <ul id="additionalOptions" style="display: none; margin:8px;">
                           <li><a href="inspecteurs.php" class=" d-flex align-center fs-14 c-black rad-6 p-10">
                           <i class="fa-solid fa-users"></i><span >Inspecteurs</span></a></li>
                           <li><a href="ingenieurs.php" class=" d-flex align-center fs-14 c-black rad-6 p-10">
                        <i class="fa-solid fa-users"></i><span>Ingénieurs en inspection</span></a></li></ul>
                       </li>
     
     
                    <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="equipement.php">
                              <i class="fa-solid fa-list-check"></i>
                              <span>Equipements</span>
                          </a>
                   </li>
                   <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="planing.php">
                              <i class="bi bi-calendar-fill"></i>
                              <span>Plan d’inspection</span>
                          </a>
                  </li>
                  <li>
                  <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="inspections.php" id="inspectionsLink">
                  <i class="fa-solid fa-list-check"></i>
                     <span>Inspections</span>
                    </a>
                     <ul id="additionalOptionsInspections" style="display: none;margin:8px;">
                     <li>
                        <a href="inspections1.php" class="d-flex align-center fs-14 c-black rad-6 p-10">
                          <i class="fa-solid fa-list-check"></i>
                             <span>Inspections Niveau 1</span>
                                </a>
                                    </li>
                                <li>
                                <a href="#" class="d-flex align-center fs-14 c-black rad-6 p-10" id="inspectionsNiveau2Link">
                                      <i class="fa-solid fa-list-check"></i>
                                     <span>Inspections Niveau 2</span>
                                          </a>
                                         <ul id="additionalOptionsInspectionsNiveau2" style="display: none; margin:8px;">
                                          <li>
                                        <a href="inspection-externe.php" class="d-flex align-center fs-14 c-black rad-6 p-10">
                                        <i class="fa-solid fa-list-check"></i>
                                     <span>Inspection Externe</span>
                               </a>
                           </li>
                             <li>
                             <a href="inspection-interne.php" class="d-flex align-center fs-14 c-black rad-6 p-10">
                           <i class="fa-solid fa-list-check"></i>
                           <span>Inspection Interne</span>
                          </a>
                             </li>
                                      </ul>
                                          </li>
                                            </ul>
                                           </li>
                       <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="cheklist.php">
                               <i class="fa-solid fa-list-check"></i>
                               <span>Checklist d'inspection</span>
                           </a>
                       </li>
                  <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="rapport.php">
                              <i class="bi bi-book-fill"></i>
                              <span>Rapports</span>
                          </a>
                  </li>
                  <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="settingsrec.php">
                              <i class="fa-solid fa-gears"></i>
                              <span>Paramètres</span>
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
                elseif($_SESSION['type_utilisateur']==='inspecteur') { 
                    echo <<<HTML
                   
                    <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="profile.php">
                                  <i class="fa-solid fa-user"></i>
                                  <span>Profil</span>
                          </a>
                    </li>
                    <li>
                       <a class=" d-flex align-center fs-14 c-black rad-6 p-10" id="usersLink">
                           <i class="fa-solid fa-users"></i>
                           <span>Utilisateurs</span>
                           </a>
                           <ul id="additionalOptions" style="display: none; margin:8px;">
                           <li><a href="inspecteurs.php" class=" d-flex align-center fs-14 c-black rad-6 p-10">
                           <i class="fa-solid fa-users"></i><span>Inspecteurs</span></a></li>
                           <li><a href="ingenieurs.php" class=" d-flex align-center fs-14 c-black rad-6 p-10">
                        <i class="fa-solid fa-users"></i><span>Ingénieurs en inspection</span></a></li></ul>
                       </li>
     
     
                    <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="equipement.php">
                              <i class="fa-solid fa-list-check"></i>
                              <span>Equipements</span>
                          </a>
                   </li>
                   <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="planing.php">
                              <i class="bi bi-calendar-fill"></i>
                              <span>Plan d’inspection</span>
                          </a>
                  </li>
                  <li>
                  <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="inspections.php" id="inspectionsLink">
                  <i class="fa-solid fa-list-check"></i>
                     <span>Inspections</span>
                    </a>
                     <ul id="additionalOptionsInspections" style="display: none;margin:8px;">
                     <li>
                        <a href="inspections1.php" class="d-flex align-center fs-14 c-black rad-6 p-10">
                          <i class="fa-solid fa-list-check"></i>
                             <span>Inspections Niveau 1</span>
                                </a>
                                    </li>
                                <li>
                                <a href="#" class="d-flex align-center fs-14 c-black rad-6 p-10" id="inspectionsNiveau2Link">
                                      <i class="fa-solid fa-list-check"></i>
                                     <span>Inspections Niveau 2</span>
                                          </a>
                                         <ul id="additionalOptionsInspectionsNiveau2" style="display: none; margin:8px">
                                          <li>
                                        <a href="inspection-externe.php" class="d-flex align-center fs-14 c-black rad-6 p-10">
                                        <i class="fa-solid fa-list-check"></i>
                                     <span>Inspection Externe</span>
                               </a>
                           </li>
                             <li>
                             <a href="inspection-interne.php" class="d-flex align-center fs-14 c-black rad-6 p-10">
                           <i class="fa-solid fa-list-check"></i>
                           <span>Inspection Interne</span>
                          </a>
                             </li>
                                      </ul>
                                          </li>
                                            </ul>
                                           </li>
                       <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="cheklist.php">
                               <i class="fa-solid fa-list-check"></i>
                               <span>Checklist d'inspection</span>
                           </a>
                       </li>
                  <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="rapport.php">
                              <i class="bi bi-book-fill"></i>
                              <span>Rapports</span>
                          </a>
                  </li>
                  <li>
                          <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="settingsrec.php">
                              <i class="fa-solid fa-gears"></i>
                              <span>Paramètres</span>
                          </a>
                    </li>
                  <li>
                          <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="connexion.php">
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
            <div class="icons d-flex align-center" style="margin-left: 82%;">
            <?php
                // Vérifier si l'utilisateur est connecté
                if (!isset($_SESSION['email'])) {
                    echo '<a href="connexion.php"><button id="button" type="button" class="btn btn-outline-dark">S\'identifier</button></a>';
                } else {
                    // Afficher les informations en fonction du type d'utilisateur
                    if ($type_utilisateur === 'ingénieur_en_inspection' || $type_utilisateur === 'inspecteur') {
                        echo '<span>' . $nom . ' ' . $prenom . '</span><img src="../pictures/anonym.jpg" alt="">';
                    }
                }
                
            ?>
           
        </div>
            </div>

            <h1 class="p-relative">Profil</h1>
            <div class="profile-page m-20">
                <div class="overview bg-white rad-10 d-flex align-center">
                       
                <?php
  if ($type_utilisateur === 'inspecteur' ) {
    echo <<<HTML
                      <div class="avatar-box txt-c p-20">
                      <img class="rad-half mb-10" src="images/pdp.jpg" alt="">
                        <h5 class="m-0 p-10"> $nom $prenom</h5>
                        <p>inspecteur</p>
                    </div>
                    <div class="info-box">
                    <div class="box p-20 d-flex align-center">
                        <div class="fs-14 d-flex align-items-center">
                                <i  class="bi bi-person-fill"  style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Nom complet</strong></div>
                                <div>$nom $prenom</div>
                            </div>
                            </div>
                            <div class="fs-14 d-flex align-items-center">
                                <i class="bi bi-envelope-fill" style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Email</strong></div>
                                <div>$email</div>
                            </div>
                            </div>
                            <div class="fs-14 d-flex align-items-center">
                                <i class="bi bi-telephone-fill" style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Telephone</strong></div>
                                <div>$telephone</div>
                            </div>
                            </div>  
                        </div>
                        <div class="box p-20 d-flex align-center">
                        <div class="fs-14 d-flex align-items-center">
                                <i class="fas fa-briefcase" style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Poste Occupé</strong></div>
                                <div>$poste_occupe</div>
                            </div>
                            </div>
                            <div class="fs-14 d-flex align-items-center">
                                <i class="fas fa-building"  style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Entreprise</strong></div>
                                <div>$entreprise</div>
                            </div>
                            </div>
                            <div class="fs-14 d-flex align-items-center">
                                <i class="fas fa-map-marker-alt location-icon" style="margin-right: 15px;  font-size: 20px; "></i>

                           <div> 
                            <div>
                                <strong style="color: rgb(54, 19, 120);">Adresse d'entreprise</strong></div>
                                <div>$adresseent</div>
                            </div>

                            </div>

                
                            <div>
                            <div class="box p-20 d-flex align-center">
                          
                          <div class="fs-14 d-flex align-items-center">
                                      <i class="bi bi-people-fill" style="margin-right: 15px; margin-left: -20px;   font-size: 20px; "></i>
      
                                 <div> <div><strong style="color: rgb(54, 19, 120);">Département</strong></div>
                                      <div>$departement</div>
                                  </div>
                                  
                                  </div>
                                 
                                  
                                 
                              </div>
                              <div class="modifier-ps">
                                    <a href='modifier_mot_de_passe.php'> modifier le mot de passe </a>
                                  </div>
                                <div class="button-container">

                               <button type="button" onclick="window.location.href='modifier_profil.php'" class="bi bi-pencil-square" style="background-color:blueviolet; color: white;"  >  Modifier votre profil</button>

                                              </div></div>

                        </div></div>           
                        
                    HTML;
                }
              ?> 
                    
             


    <style>
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
              <?php
                if ($type_utilisateur === 'ingénieur_en_inspection') {
                    echo <<<HTML
                      <div class="avatar-box txt-c p-20" id="invoice">
                        <img class="rad-half mb-10" src="images/pdp.jpg" alt="">
                        <h5 class="m-0 p-10"> $nom $prenom</h5>
                        <p>ingénieur en inspection</p>
                    </div>
                    <div class="info-box">
                    <div class="box p-20 d-flex align-center">
                        <div class="fs-14 d-flex align-items-center">
                                <i  class="bi bi-person-fill"  style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Nom complet</strong></div>
                                <div>$nom $prenom</div>
                            </div>
                            </div>
                            <div class="fs-14 d-flex align-items-center">
                                <i class="bi bi-envelope-fill" style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Email</strong></div>
                                <div>$email</div>
                            </div>
                            </div>
                            <div class="fs-14 d-flex align-items-center">
                                <i class="bi bi-telephone-fill" style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Telephone</strong></div>
                                <div>$telephone</div>
                            </div>
                            </div>  
                        </div>
                        <div class="box p-20 d-flex align-center">
                        <div class="fs-14 d-flex align-items-center">
                                <i class="fas fa-briefcase" style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Poste Occupé</strong></div>
                                <div>$poste_occupe</div>
                            </div>
                            </div>
                            <div class="fs-14 d-flex align-items-center">
                                <i class="fas fa-building"  style="margin-right: 15px;  font-size: 20px;"></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Entreprise</strong></div>
                                <div>$entreprise</div>
                            </div>
                            </div>
                            <div class="fs-14 d-flex align-items-center">
                                <i class="fas fa-map-marker-alt location-icon" style="margin-right: 15px;  font-size: 20px; "></i>

                           <div> <div><strong style="color: rgb(54, 19, 120);">Adresse d'entreprise</strong></div>
                                <div>$adresseent</div>
                            </div>

                            </div>

                
                            <div>
                            <div class="box p-20 d-flex align-center">
                          
                          <div class="fs-14 d-flex align-items-center">
                                      <i class="bi bi-people-fill" style="margin-right: 15px; margin-left: -20px;   font-size: 20px; "></i>
      


                                 <div> <div><strong style="color: rgb(54, 19, 120);">Département</strong></div>
                                      <div>$departement</div>
                                  </div>
                                  </div>
                                  <div class="modifier-ps">
                                    <a href='modifier_mot_de_passe.php'> modifier le mot de passe </a>
                                  </div>
                                 
                              </div> <div class="button-container">

                                      <button type="button" onclick="window.location.href='modifier_profil.php'" class="bi bi-pencil-square" style="background-color:blueviolet; color: white;"  >  Modifier votre profil</button>

                                                 </div>
                                                    </div>
                        </div> 
                    
                    
                    
                    </div>
                
                       
                    HTML;
                }
                
              ?> 
                    
                </div>
            </div>
         
        </div>
    </div>








    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var inspectionsNiveau2Link = document.getElementById("inspectionsNiveau2Link");
        var additionalOptionsInspectionsNiveau2 = document.getElementById("additionalOptionsInspectionsNiveau2");

        // Fonction pour afficher ou masquer les options pour l'inspection niveau 2
        function toggleInspectionsNiveau2Options() {
            if (additionalOptionsInspectionsNiveau2.style.display === "none") {
                additionalOptionsInspectionsNiveau2.style.display = "block";
            } else {
                additionalOptionsInspectionsNiveau2.style.display = "none";
            }
        }

        // Afficher ou masquer les options lorsque l'utilisateur clique sur "Inspections Niveau 2"
        inspectionsNiveau2Link.addEventListener("click", function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du lien
            toggleInspectionsNiveau2Options(); // Appeler la fonction pour afficher ou masquer les options
        });
    });
</script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var usersLink = document.getElementById("usersLink");
            var additionalOptions = document.getElementById("additionalOptions");

            // Afficher les options supplémentaires lors du clic sur "Utilisateurs"
            usersLink.addEventListener("click", function(event) {
                event.preventDefault(); // Empêcher le comportement par défaut du lien
                additionalOptions.style.display = "block"; // Afficher les options supplémentaires
            });
        });
    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inspectionsLink = document.getElementById("inspectionsLink");
            var additionalOptions = document.getElementById("additionalOptionsInspections");

            // Afficher les options supplémentaires lors du clic sur "Inspections"
            inspectionsLink.addEventListener("click", function(event) {
                event.preventDefault(); // Empêcher le comportement par défaut du lien
                additionalOptions.style.display = "block"; // Afficher les options supplémentaires
            });
        });
    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inspectionsLink = document.getElementById("inspectionsLink");
            var additionalOptions = document.getElementById("additionalOptionsInspections");

            // Variable pour suivre l'état actuel des options
            var optionsVisible = false;

            // Ajouter un écouteur d'événements pour le clic sur le lien "Inspections"
            inspectionsLink.addEventListener("click", function(event) {
                event.preventDefault(); // Empêcher le comportement par défaut du lien

                // Basculer l'affichage des options supplémentaires
                if (optionsVisible) {
                    additionalOptions.style.display = "none"; // Masquer les options
                    optionsVisible = false; // Mettre à jour l'état des options
                } else {
                    additionalOptions.style.display = "block"; // Afficher les options
                    optionsVisible = true; // Mettre à jour l'état des options
                }
            });
        });
    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            var usersLink = document.getElementById("usersLink");
            var additionalOptions = document.getElementById("additionalOptions");

            // Variable pour suivre l'état actuel des options
            var optionsVisible = false;

            // Ajouter un écouteur d'événements pour le clic sur le lien "Utilisateurs"
            usersLink.addEventListener("click", function(event) {
                event.preventDefault(); // Empêcher le comportement par défaut du lien

                // Basculer l'affichage des options supplémentaires
                if (optionsVisible) {
                    additionalOptions.style.display = "none"; // Masquer les options
                    optionsVisible = false; // Mettre à jour l'état des options
                } else {
                    additionalOptions.style.display = "block"; // Afficher les options
                    optionsVisible = true; // Mettre à jour l'état des options
                }
            });
        });
    </script>
</body>
</html>