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
            $sql = 'select * from client where CLIENT_NOM="' . $_SESSION['CLIENT_NOM'] . '"';
            $req = $connection->query($sql);
            ?>
            <div id="current_page">
                
                <?php while ($donnee = $req->fetch()) { ?>
                <h1>Index</h1><h2>Connecté(e) : <?php echo $_SESSION['CLIENT_NOM']; ?></h2><a href="../images/client/<?php echo $donnee['CLIENT_PHOTO']?>"><img class="cliImg" src="../images/client/<?php echo $donnee['CLIENT_PHOTO']?>" /></a>
                    <?php } ?>
                </div>
                <div id="main_content">
                    <br><br><br><br>
                    <h2>Bienvenu <?php echo $_SESSION['CLIENT_NOM']; ?>, ici vous pourrez gérer l'historique de vos emprunts.</h2>
                </div>
                <?php
                
            } else {
                header('Location: loginClient.php');
            }
            ?>
    </body>
</html>
