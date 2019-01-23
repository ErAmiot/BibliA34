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
        require 'getNavClient.php';
        if (isset($_SESSION['CLIENT_NOM'])) {
            require '../sqlconnect.php';
            $sql = 'select * from client where CLIENT_NOM="' . $_SESSION['CLIENT_NOM'] . '"';
            $req = $connection->query($sql);
            ?>
            <div id="current_page">

                <?php while ($donnee = $req->fetch()) { ?>
                    <h1>Index</h1><h2>Connecté(e) : <?php echo $_SESSION['CLIENT_NOM']; ?></h2><a href="../images/client/cli_<?php echo $donnee['CLIENT_PHOTO'] ?>.jpg"><img src="../images/client/cli_<?php echo $donnee['CLIENT_PHOTO'] ?>.jpg" width="50px" height="50px"/></a>
                <?php } ?>
            </div>
            <div id="main_content">
                <div id="etape1">
                    <p>
                    <form class="" action="ajouterReservationClient.php" method="post">
                        <p>Nouvelle réservation : </p>
                        <div id="ajoutempruntisbn">
                            <p>Titre du livre :</p>
                            <select id="select_recherche" name="isbn">
                                <?php
                                require '../sqlconnect.php';
                                $sql = 'SELECT *  FROM livre';
                                $table = $connection->query($sql);
                                while ($ligne = $table->fetch()) {
                                    $LIV_ISBN = $ligne['LIV_ISBN'];
                                    $LIV_TITRE = $ligne['LIV_TITRE'];
                                    ?>
                                    <option value='<?php echo $LIV_ISBN ?>'><?php echo $LIV_TITRE ?></option></br>

                                <?php
                                }
                                $table->closeCursor();
                                ?>
                            </select>
                        </div>
                        <br>
                        <input type="submit" value="Valider"/>
                        <input type="button" onClick="location.href = 'accueilClient.php';" value="Retour"/>
                    </form>
                    </p>
                </div>
            </div>
        </body>

        <?php
    } else {
        header('Location: loginClient.php');
    }
    ?>
</html>
