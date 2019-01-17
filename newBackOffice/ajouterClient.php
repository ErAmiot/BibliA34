<!DOCTYPE html>
<html>
  
        <?php
    require_once 'getHead.php';
    setHead();
    ?>
    
    <body >
        <?php
        session_start();
         require 'getNav.php';
         setNav();
        if (isset($_SESSION['LOGID'])) {
            # code..
            ?>
            <div id="current_page">
                <h1>Ajout Compte Client</h1><h2>Connecté(e) : <?php echo $_SESSION['LOGID'];?></h2>
            </div>
             <div id="main_content">
                <div id="etape1">
            <?php
            $nom = $_POST["nomClient"];
            $prenom = $_POST["prenomClient"];
            $tel = $_POST["telClient"];
            $adresse = $_POST["adresseClient"];
            $ville=$_POST["villeClient"];
            $cp=$_POST["codePostalClient"];
            $mail=$_POST["adresseMailClient"];
            $mdp = md5($_POST["motDePasseClient"]);

            require '../sqlconnect.php';

            $sql = "INSERT INTO client (CLIENT_NOM, CLIENT_PRENOM, CLIENT_TEl, CLIENT_ADR, CLIENT_VILLE, CLIENT_CP, CLIENT_MAIL, CLIENT_MDP ) VALUES ('" . $nom . "', '" . $prenom . "', '" . $tel . "', '" . $adresse . "', '" . $ville . "', '" . $cp . "', '" . $mail . "', '" . $mdp . "');";
          
            $connection->exec($sql);

            echo "Client ajouté.";
           
            ?>
            <br/>
            <br/>
            <a href="client.php"><input type="button" value="Retour"/></a>
                </div>
         </div>
                <?php
            } else {
                header('Location: backlogin.html');
            }
            ?>

    </body>
</html>
