<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Back office</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="../jsbo.js"></script>
</head>
<body>
<?php
    session_start();
     //vérification de la session
    require '../getNav.php';
    setNav();
    if (isset($_SESSION['LOGID'])) {
    require '../../sqlconnect.php';
?>
    <div id="current_page">
      <h1>Ajout Auteur:</h1>
    </div>
    <div id="main_content">
      <form action="ajoutAuteurFinal.php" method="POST">
          <p>Ajouter un Auteur<p>
            <input type="text" name="autNom" value="" placeholder="Nom" required/>
            <input type="text" name="autPrenom" value="" placeholder="Prenom" required/><br/>
            <input type="submit" value="Valider"/>
            <input type="button" value="Retour" onClick="retour();"/>
        </form>
    </div>
      <?php
      }
      else{
        header('Location: login.php');
      }
      ?>
    </body>
</html>
