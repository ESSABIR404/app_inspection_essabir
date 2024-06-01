<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['verification_code'] ?? '';

    if ($code == $_SESSION['verification_code']) {
        header('Location: verification_mp.php');
        exit;
    } else {
        $erreur = 'Code de vérification incorrect.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 5px;
            background-color: #f4f4f4;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .alert {
            margin-bottom: 20px;
        }
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
    <div class="container">
        <h2>Vérification du code</h2>
        <?php if (isset($erreur)): ?>
            <div class="alert alert-danger"><?php echo $erreur; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="verification_code">Code de vérification :</label>
                <input type="text" id="verification_code" name="verification_code" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Vérifier</button>
        </form>
    </div>
    </div>
</body>
</html>