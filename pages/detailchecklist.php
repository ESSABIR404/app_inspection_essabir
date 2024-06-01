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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
   
    <title>Document</title>
<style> .logo {
    width: 100px; 
    height: auto;
}</style>
</head>
<body>
<?php 
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
  
  if(isset($_GET['idcheck'])){
    $idcheck = $_GET['idcheck'];

    $sql = "SELECT * FROM cheklist WHERE id=:idcheck";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idcheck', $idcheck, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>
<div  id="invoice">
    <table style="border:-10px;">
        <tr rowspan="3"> <td >
                <img src="../pictures/jesa.jpg" alt="Votre Image" class="logo">
            </td>
            <td >
                <h1 style="color:black;"><strong>Checklist d'inspection de l'Engin</strong></h1>
            </td></tr>
         
            <tr rowspan="3">
            <td>Inspection :</td>
            <td><?php echo  $row['insp'];?></td></tr>
            <tr rowspan="3">
            <td>Tag d'équipement:</td>
            <td><?php echo  $row['tag'];?></td></tr>
            <tr rowspan="3">
            <td>Nom de l'inspecteur :</td>
            <td><?php echo  $row['nom_insp'];?></td></tr>
            <tr rowspan="3">
            <td>Date de l'inspection :</td>
            <td><?php echo  $row['date_inspection'];?></td></tr>
            <tr rowspan="3">
            <td>Résultat final :</td>
            <td><?php echo  $row['resultat_final'];?></td></tr>
           
           <tr rowspan="3"><td> Signature de l'inspecteur</td>
         </tr>
       
   
<tr rowspan="3">
<td>Aprouvé </td>
<td>A Eljadida le ...-...-......</td></tr>

    </table>
    

  
</div>
    <button class="btn btn-primary" id="download" style="background-color:blueviolet; color: white" >telecharger sous forme pdf</button>
 
 
 
 
 








</body>
<script>window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 0,
                filename: 'checklist.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(invoice).set(opt).save();
        })}</script>
</html>