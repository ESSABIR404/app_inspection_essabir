
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
      border-color:  #2995b9;

      
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
</head>
<body>
    <div class="page d-flex">
        <div class="sidebar bg-white p-20 p-relative">
        <img src="../pictures/logoinsp.jpg" width="170px" height="45px" style="margin-left: 20px; margin-bottom: 5px;">
      </a>
      
            <ul><li><a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="dashboardrec.php">
                      
                        <span></span></a> 
                        <?php if(!isset($_SESSION['email']) ) { echo <<<HTML
                    <li>
                        <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="settingsrec.php">
                          <i class="fa-solid fa-gear"></i>
                          <span>Paramètres</span>
                        </a> 
                    </li>
                    <li>
                        <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="connexion.php">
                          <i class="fa-solid fa-user"></i>
                          <span>Profile</span>
                        </a>
                    </li>
                 
                  HTML;
                  } elseif($_SESSION['type_utilisateur']==='ingénieur_en_inspection') { 
              echo <<<HTML
                <li>
                     <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="settingsrec.php">
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



            elseif($_SESSION['type_utilisateur']==='inspecteur') { 
                echo <<<HTML
                  <li>
                       <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="settingsrec.php">
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
                        if ($type_utilisateur === 'ingénieur_en_inspection') {
                            echo '<span>' . $nom . ' ' . $prenom . '</span><img src="../pictures/fotos9.webp" alt="">';
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
                        <div>
                           <label>
                                <input type="checkbox" class="toggle-checkbox" checked>
                                <div class="toggle-switch"></div>
                           </label> 
                        </div>
                    </div>
                    <textarea class="close-message p-10 rad-6 d-block w-full" placeholder="Pouquoi tu veux fermer le Site?"></textarea>
                </div>
            </div>
        </div>
    </div>
 
     


     
      



  



</body>
</html>