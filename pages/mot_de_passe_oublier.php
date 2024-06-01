<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';
session_start();
include_once 'cnx.php';

// Fonction pour générer un code de vérification aléatoire
function generateVerificationCode($length = 6) {
    $characters = '0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

$message = '';
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    // Vérifier si l'e-mail existe dans la base de données
    $stmt = $conn->prepare('SELECT * FROM inspecteurs WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $inspecteur = $stmt->fetch();

    if ($inspecteur) {
        // Générer un code de vérification aléatoire
        $verificationCode = generateVerificationCode();

        // Stocker le code de vérification en session
        $_SESSION['verification_code'] = $verificationCode;
        $_SESSION['email'] = $email;
        $_SESSION['type_utilisateur']=$type_utilisateur;

        // Envoyer le code de vérification par e-mail
        $mail = new PHPMailer(true);

        try {
            // Paramètres du serveur SMTP (exemple pour Gmail)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP de Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'kelm55895@gmail.com'; // Votre adresse e-mail Gmail
            $mail->Password = 'gtvmsfnvpuyvgydc'; // Votre mot de passe SMTP Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Destinataire
            $mail->setFrom('kelm55895@gmail.com', 'Khadija');
            $mail->addAddress('kelm55895@gmail.com'); // L'e-mail de l'utilisateur

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Code de verification pour reinitialiser le mot de passe';
            $mail->Body = 'Votre code de vérification est : ' . $verificationCode;

            $mail->send();
            $message = 'Un code de vérification a été envoyé à votre adresse e-mail.';
            header('Location: verification_code.php');
        } catch (Exception $e) {
            $erreur = 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
        }
    } else {
        $erreur = 'Cet email n\'existe pas.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
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
        list-style-type: none;
      }

      .nav-a ul li {
        position: relative;
        margin-left: 5%;
        margin-top: 1%;
        marker: none;
        
      }

      .nav-a ul li a {
        color: black !important;
        text-decoration: none
      }

        .containerRm {
            width: 100%;
           
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="email"] {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .c-m{
            height: 472px;
            margin-top: 150px;
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
  <div class="c-m">
    <div class="containerRm">
        <h1>Mot de passe oublié</h1>
        <?php if ($erreur): ?>
            <div class="alert alert-danger"><?php echo $erreur; ?></div>
        <?php endif; ?>
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Réinitialiser le mot de passe</button>
        </form>
    </div>
    </div>
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