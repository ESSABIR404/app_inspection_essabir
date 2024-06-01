<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobTime</title>
    <link rel="shortcut icon" href="pictures/img1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script>
      window.addEventListener("scroll", function() {
        var nav = document.querySelector("nav");
        nav.classList.toggle("sticky", window.scroll);
      });
    </script>
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

      .sousContainerH {
        display: flex;
        width: 80%;
        margin-left: 10%;
      }

      .titreHome {
        width: 50%;
        margin-top: 12%;
        margin-left: 8%;
      }

      .titreHome h1 {
        margin: 0 !important;
        color: black;
      }

      .titreHome p {
        margin-top: 3%;
        color: #777;
      }

      .h5-button-co {
        display: flex;
        margin-top: 10%;
      }

      .h5-button-co button {
        margin-left: 25%;
        border: none;
        border-radius: 28px;
        height: 45px;
        width: 150px;
        background-color: #2995b9;
        color: #fff;
      }

      .imageHome {
        width: 50%;
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
    <div class="sousContainerH">
      <div class="titreHome">
        <h1>Bienvenue dans Jesa</h1>
        <p>How to resolve ERESOLVE unable to resolve dependency tree error...</p>
        <div class="h5-button-co">
          <div><h5>Connectez-vous</h5></div>
          <div><a href="connexion.php"><button>Connexion</button></a></div>
        </div>
      </div>
      <div class="imageHome">
        <img src="../pictures/ll.jpg" width="280px" height="350px" style="margin-left: 80px; margin-top: 95px;">
      </div>
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