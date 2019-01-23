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
        require 'getNav.php';
        setNav();
        if (isset($_SESSION['LOGID'])) {
            require '../sqlconnect.php';
            ?>
            <div id="current_page">
                <h1>Liste Livres</h1><h2>Connecté(e) : <?php echo $_SESSION['LOGID'];?></h2>
            </div>
            <div id="main_content">
                <h2>Impression : </h2>
                <?php
                $sql = "SELECT * FROM livre, ecrire, auteur, editeur, collection, correspondre, rubriques "
                        . "WHERE livre.LIV_ISBN = ecrire.LIV_ISBN "
                        . "AND ecrire.AUT_NUM = auteur.AUT_NUM "
                        . "AND livre.EDIT_NUM = editeur.EDIT_NUM "
                        . "AND livre.COL_NUM = collection.COL_NUM "
                        . "AND livre.LIV_ISBN = correspondre.LIV_ISBN "
                        . "AND correspondre.RUB_ID = rubriques.RUB_ID";
                $table = $connection->query($sql);
                $count = $table->rowCount();
                if ($count > 0) {
                    ?>
                    <div id="divImpr">
                        <table>
                            <tr>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>N° ISBN</th>
                                <th>Auteur</th>
                                <th>Editeur</th>
                                <th>Collection</th>
                                <th>Rubrique</th>
                                <th>Date</th>
                            </tr>
                            <?php
                            while ($ligne = $table->fetch()) {
                                $LIV_ISBN = $ligne["LIV_ISBN"];
                                $COL_NOM = $ligne["COL_NOM"];
                                $EDIT_NOM = $ligne["EDIT_NOM"];
                                $LIV_TITRE = $ligne["LIV_TITRE"];
                                $LIV_DATE = $ligne["LIV_DATE"];
                                $AUT_NOM = $ligne["AUT_NOM"];
                                $AUT_PRENOM = $ligne["AUT_PRENOM"];
                                $RUB_NOM = $ligne["RUB_NOM"];
                                $LIV_IMG=$ligne["LIV_IMG"];
                                ?>
                                <tr>
                                    <td><a href="../images/livre/liv_<?php echo    $LIV_IMG ?>.jpg"><img src="../images/livre/liv_<?php echo    $LIV_IMG ?>.jpg" width="50px" height="50px"/></a></td>
                                    <td><?php echo $LIV_TITRE; ?></td>
                                    <td><?php echo $LIV_ISBN; ?></td>
                                    <td><?php echo $AUT_NOM . " " . $AUT_PRENOM; ?></td>
                                    <td><?php echo $EDIT_NOM; ?></td>
                                    <td><?php echo $COL_NOM; ?></td>
                                    <td><?php echo $RUB_NOM; ?></td>
                                    <td><?php echo $LIV_DATE; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <?php
                }
                ?>
                <button name="b_print" type="button" onclick="printdiv('divImpr');">Imprimer</button>
                <button name="b_print" type="button" onclick="location.href = 'index.php';">Retour</button>
                <script>
                    function printdiv(divImpr) {
                        var headstr = "<html><head><title></title></head><body>";
                        var footstr = "</body>";
                        var newstr = document.all.item(divImpr).innerHTML;
                        var oldstr = document.body.innerHTML;
                        document.body.innerHTML = headstr + newstr + footstr;
                        window.print();
                        document.body.innerHTML = oldstr;
                        return false;
                    }
                </script>
                <?php
            } else {
                header('Location: login.php');
            }
            ?>
    </body>
</html>
