<!DOCTYPE html>
<html>
<?php
    require_once 'getHead.php';
    setHead();
?>
<body onload="verif();">
<?php
    session_start();
     //vérification de la session
    require 'getNavClient.php';
 
    if (isset($_SESSION['CLIENT_NOM'])) {
    require '../sqlconnect.php';
?>
    <div id="current_page">
        <h1>Index</h1><h2>Connecté(e) : <?php echo $_SESSION['CLIENT_NOM'];?></h2>
    </div>
    <div id="main_content">
        <br><br><br><br>
        <h2>Bienvenu <?php echo $_SESSION['CLIENT_NOM'];?>, ici vous pourrez gérer l'historique de vos emprunts.</h2>
    </div>
    <?php
      }
      else{
        header('Location: loginClient.php');
      }
    ?>
</body>
</html>
