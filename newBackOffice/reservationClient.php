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
            $sql2 = 'SELECT count(*) as nb_livre FROM livre WHERE LIV_EMPRUNTER = 0';
            $nb = $connection->query($sql2);
            ?>
            <div id="current_page">
                <h1>Réservation</h1><h2>Connecté(e) : <?php echo $_SESSION['CLIENT_NOM']; ?></h2>
            </div>
            <div id="main_content">
                <div id="etape1">
                    <p>
                    <form class="" action="ajouterReservationClient.php" method="post">
                        <p>Nouvelle réservation : </p>
                        <div id="ajoutempruntisbn">
                            <p>Titre du livre :</p>
                            <?php
                            while ($aff = $nb->fetch()) {
                                if ($aff['nb_livre'] >= 1) {
                                    $flag = false;
                                    ?>
                                    <select id="select_recherche" name="isbn">
                                        <?php
                                        require '../sqlconnect.php';
                                        $sql = 'SELECT *  FROM livre WHERE LIV_EMPRUNTER = 0';
                                        $table = $connection->query($sql);


                                        while ($ligne = $table->fetch()) {
                                            $LIV_ISBN = $ligne['LIV_ISBN'];
                                            $LIV_TITRE = $ligne['LIV_TITRE'];
                                            ?>
                                            <option value='<?php echo $LIV_ISBN ?>'><?php echo $LIV_TITRE ?></option>


                                            <?php }
                                        ?>
                                    </select>
                                    <?php
                                    $table->closeCursor();
                                } else {
                                    ?>
                                    <p>Aucun livre disponible</p>
                                    <?php
                                }
                            }
                            ?>                            
                        </div>
                        <br>         
                        <?php
                        if (isset($flag)) {
                            echo '<input type="submit" value="Valider"/>';
                        }
                        ?>
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
