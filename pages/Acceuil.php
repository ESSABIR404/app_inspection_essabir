<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=>, initial-scale=1.0">
    <title>Acceuil</title>
    <link  rel="stylesheet" href="../css/bootstrap.css" >
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <style>
     #button{
      background-color: #2995b9;
      border-color: #2995b9;

      
     }

 
   
    .container {
    display: flex;
    justify-content: center; /* centrer horizontalement */
    align-items: center; /* centrer verticalement */
    height: 70px; /* définir la hauteur de la page */
    }

     
    .liggg{display: inline-block;
    }
     
    h1{
    margin-top: 100px;
    margin: 60px ; 
    color:rgb(7, 7, 125);
    font-family: Georgia, serif;
    font-size: xx-large;}

    .divchoix1{ background-color:white;
     height: 480px;
     }


    p{font-size: 40px;
    text-align: center;
    padding-top: 140px;}



    body{
    overflow-x: hidden;
     
    }
  
   .cercledeli{
    list-style-type: circle;
    }
    footer{background-color: #f5f5f5;
    height: 160px;
    box-shadow: 0px -5px 5px rgba(190, 188, 188, 0.3);
    }
    .btn1{
      transition: all 0.3s ease-in-out;
      
   }
   .btn1:hover{
    
     transform: scale(1.2);
     box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);

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
      <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    .container {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }
    .left {
        flex: 1;
        background-color: white; /* Couleur de fond blanche pour éviter de se superposer à l'image */
    }
    .left img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .right {
        flex: 1;
        background-color: blue;
    }
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f2f2f2;
        padding: 20px;
    }
    .button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
</style>
</head>
<body>

<div class="container">
    <div class="left">
        <img src="pictures/jesa.jpg" alt="Votre photo">
    </div>
    <div class="center">
        <button class="button">Connexion</button>
    </div>
    <div class="right"></div>
</div>
   
 </body>
 </html>