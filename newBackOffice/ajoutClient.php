<!DOCTYPE html>
<html>
<?php
    require_once 'getHead.php';
    setHead();
?>
<body>
<?php
    session_start();
     //vérification de la session
    require 'getNav.php';
    setNav();
    if (isset($_SESSION['LOGID'])) {
    require '../sqlconnect.php';
?>
    <div id="current_page">
        <h1>Ajout Compte Client</h1><h2>Connecté(e) : <?php echo $_SESSION['LOGID'];?></h2>
    </div>
    <div id="main_content">
    <div id="etape1">
      
        <form class="" action="ajouterClient.php" method="post">
          <p>Nouveau client</p>
          <br>
          <br>
          <div class="ajoutClientformul">
              <p>Nom</p>
            <input type="text" id="nomClient" name="nomClient" value=""  required/><br/>
          </div>
          <div class="ajoutClientformul">
              <p>Prénom</p>
              <input type="text" id="prenomClient"   name="prenomClient" value=""  required/><br/>
          </div>
          <div class="ajoutClientformul">
              <p>Tél</p>
              <input type="text" id="telClient" name="telClient" value=""  pattern="^[0-9]{10}" title="le numéro de téléphone doit ressembler à: 06XXXXXX45" required/><br/>
          </div>
          <div class="ajoutClientformul">
              <p>Adresse</p>
              <input type="text" id="adresseClient" name="adresseClient" value=""  required/><br/>
          </div>
          <div class="ajoutClientformul">
              <p>Ville</p>
              <input type="text" id="villeClient" name="villeClient" value=""  required/><br/>       
          </div>
          <div class="ajoutClientformul">
              <p>Code postal</p>
              <input type="text" id="codePostalClient" name="codePostalClient" value=""   required/><br/>
          </div>
          <div class="ajoutClientformul">
              <p>Adresse mail</p>
              <input type="text" id="adresseMailClient" name="adresseMailClient" value=""  required/><br/>
          </div>
          <div class="ajoutClientformul">
              <p>Mot de passe</p>
              <input type="text" id="motDePasseClient" name="motDePasseClient" value=""  required/><br/>
          </div> 
          <br>
          <br>
          <br>
          
     <input type="submit" value="Valider"/>
          <input type="button" onClick="location.href = 'client.php';" value="Retour"/>
        </form>
      
    </div>
    </div>
  </body>

  <?php
  }
  else{
    header('Location: backlogin.html');
  }
  ?>
</html>

