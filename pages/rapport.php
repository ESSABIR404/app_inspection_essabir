<?php
// Démarrer la session
session_start();
$nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';
$prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : '';
$type_utilisateur = isset($_SESSION['type_utilisateur']) ? $_SESSION['type_utilisateur'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';




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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
   <link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css">
   
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
a:hover {
    background-color: white;
    color:blue;
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
               <?php 
                         //Verifier si l'utilisateur est connecter 
                         if(!isset($_SESSION['email']) ) {
                            header("Location:connexion.php");
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

        
             
                        

                      
   
            <?php


// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_inspection";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Requête pour récupérer les rapports
$sql = "SELECT id, annomalie, etat, insp, methode_insp, recommandation, tag, verification FROM rapports";
$result = $conn->query($sql);

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
    <title>Rapports</title>
    <style>
        /* Styles personnalisés */
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn-modify {
            background-color: #2995b9;
            border: none;
            color: white;
            padding: 5px 10px;
            cursor: pointer;
            
        }
        .btn-modify:hover {
            background-color: #217a91;
        }
        .btn-add{
            background-color: #2995b9;
            border: none;
            color: white;
            padding: 5px 10px;
            cursor: pointer;
        }
        .btn-add:hover{
            background-color: #217a91;
        }

        
    </style>

        <h1 class="p-relative">Rapports</h1>
        <input type="text" id="searchInput" placeholder="Rechercher par tag...">
        <table >
    <thead>
        <tr>
            <th>ID</th>
            <th>Anomalie</th>
            <th>État</th>
            <th>Insp</th>
            <th>Méthode d'Inspection</th>
            <th>Recommandation</th>
            <th>Tag</th>
            <th>Vérification</th>
            <?php if ($type_utilisateur === 'inspecteur' && $role === 'admin'): ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Afficher les données pour chaque ligne
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["annomalie"] . "</td>";
                echo "<td>" . $row["etat"] . "</td>";
                echo "<td>" . $row["insp"] . "</td>";
                echo "<td>" . $row["methode_insp"] . "</td>";
                echo "<td>" . $row["recommandation"] . "</td>";
                echo "<td>" . $row["tag"] . "</td>";
                echo "<td>" . $row["verification"] . "</td>";
                
                if ($type_utilisateur === 'inspecteur' && $role === 'admin') {
                    echo "<td>";
                    if (is_null($row["recommandation"]) && is_null($row["verification"]) && is_null($row["annomalie"])) {
                        echo "<button class='btn-add' onclick='editRow(this)'>Ajouter</button>";
                    } else {
                        echo "<button class='btn-add' onclick='editRow(this)'>Modifier</button>";
                    }
                    echo "<a class='btn btn-danger btn-sm' href='javascript:void(0)' onclick='openModal(" . $row['id'] . ")'>Supprimer</a>";
                    echo "</td>";
                }
                
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Aucun rapport trouvé.</td></tr>";
        }
        ?>
    </tbody>
</table>
    </div>
</div>

<script>
function editRow(btn) {
    // Restaurer l'état initial de toutes les lignes
    resetAllRows();

    // Trouver la ligne parente (tr) du bouton cliqué
    var row = btn.parentNode.parentNode;
    
    // Trouver les cellules de la ligne (td) que vous souhaitez modifier
    var anomalieCell = row.cells[1];
    var recommandationCell = row.cells[5];
    var verificationCell = row.cells[7];

    // Remplacer le contenu textuel par des champs d'entrée
    anomalieCell.innerHTML = "<input style='border: none;width: 120px;background-color: transparent;'  type='text' value='" + anomalieCell.innerText + "'>";
    recommandationCell.innerHTML = "<input style='border: none;width: 120px;background-color: transparent;' type='text' value='" + recommandationCell.innerText + "'>";
    verificationCell.innerHTML = "<input style='border: none;width: 120px;background-color: transparent;' type='text' value='" + verificationCell.innerText + "'>";
    
    // Modifier le bouton "Ajouter" en "Enregistrer"
    btn.innerHTML = "Enr";
    // Modifier l'attribut onclick du bouton pour appeler une autre fonction lors du clic
    btn.setAttribute("onclick", "saveRow(this)");
}

function saveRow(btn) {
    // Trouver la ligne parente (tr) du bouton cliqué
    var row = btn.parentNode.parentNode;
    
    // Récupérer les valeurs des champs d'entrée
    var id = row.cells[0].innerText; // ID
    var recommandation = row.cells[5].querySelector('input').value; // Recommandation
    var annomalie = row.cells[1].querySelector('input').value; // Anomalie
    var verification = row.cells[7].querySelector('input').value; // Vérification

    // Envoyer les données au serveur via une requête AJAX (vous devez implémenter cette partie)
    // Exemple de requête AJAX avec jQuery
    $.ajax({
        url: 'updateRapports.php', // URL du script PHP pour la mise à jour
        method: 'POST',
        data: {
            id: id,
            recommandation: recommandation,
            annomalie: annomalie,
            verification: verification
        },
        success: function(response) {
            updateTable();
            
        },
        error: function(xhr, status, error) {
            // Gérer les erreurs en cas d'échec de la requête AJAX
            console.error(error);
        }
    });
}
function updateTable() {
    // Vous pouvez mettre à jour la table ici
    // Par exemple, vous pouvez recharger la page pour afficher les données mises à jour
    location.reload(); // Recharger la page
}

function resetAllRows() {
    // Trouver toutes les lignes de la table
    var rows = document.querySelectorAll("tbody tr");
    
    // Parcourir chaque ligne pour restaurer son état initial
    rows.forEach(function(row) {
        // Trouver les cellules de la ligne (td) que vous souhaitez réinitialiser
        var anomalieCell = row.cells[1];
        var recommandationCell = row.cells[5];
        var verificationCell = row.cells[7];

        // Remplacer le contenu des champs d'entrée par le texte d'origine
        anomalieCell.innerHTML = anomalieCell.querySelector("input") ? anomalieCell.querySelector("input").value : anomalieCell.innerText;
        recommandationCell.innerHTML = recommandationCell.querySelector("input") ? recommandationCell.querySelector("input").value : recommandationCell.innerText;
        verificationCell.innerHTML = verificationCell.querySelector("input") ? verificationCell.querySelector("input").value : verificationCell.innerText;

        // Remettre le bouton "Ajouter" à sa valeur d'origine
        var addButton = row.querySelector(".btn-add");
        if (addButton) {
            addButton.innerHTML = "Ajouter";
            addButton.setAttribute("onclick", "editRow(this)");
        }
    });
}
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var searchInput = document.getElementById("searchInput");
        var tableRows = document.querySelectorAll("table tbody tr");

        // Ajouter un écouteur d'événements pour la saisie dans la barre de recherche
        searchInput.addEventListener("input", function() {
            var searchText = searchInput.value.toLowerCase();

            // Parcourir toutes les lignes du tableau
            tableRows.forEach(function(row) {
                var tagCell = row.cells[6].innerText.toLowerCase(); // L'indice 6 correspond à la colonne contenant les tags

                // Vérifier si le tag de la ligne correspond à la recherche
                if (tagCell.includes(searchText)) {
                    row.style.display = ""; // Afficher la ligne si le tag correspond à la recherche
                } else {
                    row.style.display = "none"; // Masquer la ligne sinon
                }
            });
        });
    });
</script>

<script type="text/javascript">
   function openModal(id) {
    // Afficher une boîte de dialogue SweetAlert pour confirmer la suppression
    swal({
        title: "Confirmer la suppression",
        text: "Voulez-vous vraiment supprimer cet élément? ",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Annuler",
                value: null,
                visible: true,
                className: "btn btn-secondary",
                closeModal: true,
            },
            confirm: {
                text: "Supprimer",
                value: true,
                visible: true,
                className: "btn btn-danger",
                closeModal: true
            }
        },
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then((value) => {
        if (value) {
            // Si l'utilisateur confirme la suppression, redirigez vers la page de suppression avec l'ID de l'inspecteur
            window.location.href = 'suppRap.php?id=' + id;
        } else {
            // Optionnel : réouvrir le modal (ceci n'est généralement pas nécessaire)
            // openModal(id_inspecteur);
        }
    });
}

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var usersLink = document.getElementById("usersLink");
        var additionalOptions = document.getElementById("additionalOptions");

        usersLink.addEventListener("click", function(event) {
            event.preventDefault();
            additionalOptions.style.display = "block";
        });

        var inspectionsLink = document.getElementById("inspectionsLink");
        var additionalOptionsInspections = document.getElementById("additionalOptionsInspections");
        inspectionsLink.addEventListener("click", function(event) {
            event.preventDefault();
            additionalOptionsInspections.style.display = additionalOptionsInspections.style.display === "block" ? "none" : "block";
        });

        var inspectionsNiveau2Link = document.getElementById("inspectionsNiveau2Link");
        var additionalOptionsInspectionsNiveau2 = document.getElementById("additionalOptionsInspectionsNiveau2");
        inspectionsNiveau2Link.addEventListener("click", function(event) {
            event.preventDefault();
            additionalOptionsInspectionsNiveau2.style.display = additionalOptionsInspectionsNiveau2.style.display === "block" ? "none" : "block";
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