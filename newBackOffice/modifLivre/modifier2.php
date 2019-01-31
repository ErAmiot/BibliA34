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
                <h1>Modification:</h1>
            </div>
            <div id="main_content">
                <?php
                if (isset($_POST["modif"])) {
                    $isbn = htmlentities($_POST["modif"]);
                    $sql = 'SELECT *  FROM livre where livre.LIV_ISBN = "' . $isbn . '" ';
                    $table = $connection->query($sql);
                    while ($ligne = $table->fetch()) {
                        $titre = $ligne['LIV_TITRE'];
                    }
                    $table->closeCursor();
                    ?>
                    <h1>Modifier <?php echo $titre ?>:</h1>
                    <form action="modification.php" method="GET">
                        <input type="hidden" name="isbn" value="<?php echo $isbn ?>">
                        Auteur :<br>
                        <select name="auteur[]" type="select" multiple size="3"  required>
                            <?php
                            $sql = 'SELECT * FROM ecrire where LIV_ISBN="' . $isbn . '" ';
                            $sql2 = 'SELECT * FROM auteur';
                            $table2 = $connection->query($sql2);
                            while ($ligne2 = $table2->fetch()) {
                                $AUT_NUM = $ligne2['AUT_NUM'];
                                $AUT_NOM = $ligne2['AUT_NOM'];
                                $AUT_PRENOM = $ligne2['AUT_PRENOM'];
                                $table = $connection->query($sql);
                                while ($ligne = $table->fetch()) {
                                    $numAut = $ligne['AUT_NUM'];
                                    if ($AUT_NUM == $numAut) {
                                        $selected = 'selected="yes"';
                                    }
                                }
                                echo '<option ' . $selected . ' value="' . $AUT_NUM . '">' . $AUT_NOM . ' ' . $AUT_PRENOM . '</option>';
                                $selected = '';
                            }
                            $table->closeCursor();
                            $table2->closeCursor();
                            ?>
                        </select><br><br>
                        Éditeur :
                        <select name="editeur">
                            <?php
                            $sql = 'SELECT * FROM editeur';
                            $table = $connection->query($sql);
                            while ($ligne = $table->fetch()) {
                                $EDIT_NOM = $ligne['EDIT_NOM'];
                                $EDIT_NUM = $ligne['EDIT_NUM'];
                                if ($EDIT_NOM == $editeur) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                echo '<option ' . $selected . ' value="' . $EDIT_NUM . '">' . $EDIT_NOM . '</option>';
                            }
                            $table->closeCursor();
                            ?>
                        </select><br/><br/>
                        Collection :
                        <select name="col">
                            <?php
                            $sql = 'SELECT * FROM collection';
                            $table = $connection->query($sql);
                            while ($ligne = $table->fetch()) {
                                $COL_NUM = $ligne['COL_NUM'];
                                $COL_NOM = $ligne['COL_NOM'];
                                if ($COL_NUM == $collection) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                echo '<option ' . $selected . ' value="' . $COL_NUM . '">' . $COL_NOM . '</option>';
                            }
                            $table->closeCursor();
                            ?>
                        </select><br><br>
                        Rubrique :<br>
                        <select name="rubrique[]" type="select" multiple size="6" required>
                            <?php
                            $sql = 'SELECT * FROM correspondre where LIV_ISBN="' . $isbn . '" ';
                            $sql2 = 'SELECT * FROM rubriques';
                            $table2 = $connection->query($sql2);
                            while ($ligne2 = $table2->fetch()) {
                                $RUB_ID = $ligne2['RUB_ID'];
                                $RUB_NOM = $ligne2['RUB_NOM'];
                                $table = $connection->query($sql);
                                while ($ligne = $table->fetch()) {
                                    $numRub = $ligne['RUB_ID'];
                                    if ($RUB_ID == $numRub) {
                                        $selected = 'selected="yes"';
                                    }
                                }
                                echo '<option ' . $selected . ' value="' . $RUB_ID . '">' . $RUB_NOM . '</option>';
                                $selected = '';
                            }
                            $table->closeCursor();
                            ?>
                        </select></br></br>
                        <select name="etat">
                            <option value=''>Etat</option>
                            <option value="abime">Abimé</option>
                            <option value="correct">Correct</option>
                            <option value="neuf">Neuf</option>
                        </select></br></br>

                        <?php
                        $sql = 'SELECT *  FROM livre where LIV_ISBN="' . $isbn . '"';
                        $table = $connection->query($sql);
                        $ligne = $table->fetch();
                        $resume = $ligne['LIV_RESUME'];
                        $titre = $ligne['LIV_TITRE'];
                        $date = $ligne['LIV_DATE'];
                        ?> <input name="titre" value="<?php echo $titre ?>" type="text" placeholder="Titre"></br>
                        <input name="date" value="<?php echo $date ?>" type="text" placeholder="Date de parution (optionnel)"><br/>
                        <textarea name="resume" style="margin: 0px; height: 80px; width: 400px;"><?php echo $resume ?></textarea>
                        <br/><input type="submit" value="Valider"/>
                    </form>
                    <br/>
                <?php } else {
                    ?>
                    <p>Aucun livre choisi</p><br>
                    <button name="b_print" type="button" onclick="location.href = '../modifierLivre.php';">Retour</button>
                    <?php
                }
            } else {
                header('Location: login.php');
            }
            ?>
        </div>
    </body>
</html>