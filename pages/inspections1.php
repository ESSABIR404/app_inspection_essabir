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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <title>Inspections</title>
</head>
<style>
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



</style>
<body>
    <div class="page d-flex">
    <div class="sidebar  p-20 p-relative" style="background-color:blueviolet; color: white;">
        <img src="../pictures/logoinsp.jpg" width="170px" height="45px" style="margin-left: 20px; margin-bottom: 5px;">
      </a>
      
            <ul>
              

                <?php
               //Verifier si l'utilisateur est connecter 
               if(!isset($_SESSION['email']) ) {
                 header("Location:connexion.php");
            }
             elseif($_SESSION['type_utilisateur']==='ingénieur_en_inspection') { 
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
                        <ul id="additionalOptions" style="display: none;">
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
                        <ul id="additionalOptionsInspections" style="display: none;">
                        <li><a href="inspections1.php" class=" d-flex align-center fs-14 c-black rad-6 p-10">
                        <i class="fa-solid fa-list-check"></i><span>Inspections niveau 1</span></a></li>
                        <li><a href="inspections2.php" class=" d-flex align-center fs-14 c-black rad-6 p-10">
                        <i class="fa-solid fa-list-check"></i><span>Inspections niveau 2</span></a></li></ul>
                    </li>
                    <li>
                    <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="cheklist.php">
                            <i class="fa-solid fa-list-check"></i>
                            <span>checklist d'inspection</span>
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
                        <ul id="additionalOptions" style="display: none;">
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
                             <ul id="additionalOptionsInspections" style="display: none;">
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
                                                 <ul id="additionalOptionsInspectionsNiveau2" style="display: none;">
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
                    <li>
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
                        if ($type_utilisateur === 'ingénieur_en_inspection'||$type_utilisateur === 'inspecteur') {
                            echo '<span>' . $nom . ' ' . $prenom . '</span><img src="../pictures/anonym.jpg" alt="">';
                        } else {
                           
                        }
                    }
                ?>
                </div>
            </div>
            <h1 class="p-relative">Inspections niveau 1</h1>
       

    <h1><stron style="color: rgb(54, 19, 120);"></strong></h1>
<table class="table" id="equipmentsTable">
<thead>
            <tr>
                <th><stron style="color: rgb(54, 19, 120);"> Order</strong></th>
                <th><stron style="color: rgb(54, 19, 120);">Question</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
              <td>y a-t-il de la saleté sur l'équipement</td>
            </tr>
            <tr>
                <td>2</td>
           
                <td>Il y a des boulons desserrés dans l'équipement?</td>
            </tr>
            <tr>
                <td>3</td>
                <td>is  there any noise or vibration in the equipement?</td>
            </tr>
            <tr>
                <td>4</td>
         
                <td>l'équipement fuit-il de l'huile?</td>
            </tr>
            <tr>
                <td>5</td>
                <td>y a-t-il des fuites de liquide des conduites de pompe?</td>
            </tr>
        </tbody>
    </table>



             
                        

                      
   
 


      
      




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