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
        $isbn = htmlentities($_POST["modif"]);
        $sql = 'SELECT *  FROM livre,ecrire,auteur,correspondre,rubriques, editeur WHERE livre.EDIT_NUM = editeur.EDIT_NUM AND livre.LIV_ISBN = correspondre.LIV_ISBN AND correspondre.RUB_ID = rubriques.RUB_ID AND livre.LIV_ISBN = ecrire.LIV_ISBN AND ecrire.AUT_NUM = auteur.AUT_NUM AND livre.LIV_ISBN = "'.$isbn.'" ';
        $table = $connection->query($sql);
        while ($ligne = $table->fetch()) {
            $titre = $ligne['LIV_TITRE'];
            $prenom = $ligne['AUT_PRENOM'] ;
            $nom = $ligne['AUT_NOM'] ;
            $numAut = $ligne['AUT_NUM'];
            $date = $ligne['LIV_DATE'];
            $editeur = $ligne['EDIT_NOM'];
            $collection = $ligne['COL_NUM'];
            $rubrique = $ligne['RUB_NOM'];
            $resume = $ligne['LIV_RESUME'];
            $etat = $ligne['LIV_ETAT'];
        }
        $table->closeCursor();
        ?>
        <h1>Modifier <?php echo $titre ?>:</h1>
        <form action="modification.php" method="GET">
            <input type="hidden" name="isbn" value="<?php echo $isbn ?>">
            <select name="auteur">
                <?php
                $sql = 'SELECT * FROM auteur';
                $table = $connection->query($sql);
                while($ligne = $table->fetch()) {
                    $AUT_NUM = $ligne['AUT_NUM'];
                    $AUT_NOM = $ligne['AUT_NOM'];
                    $AUT_PRENOM = $ligne['AUT_PRENOM'];
                    if($AUT_NUM == $numAut)
                    {
                        $selected = 'selected';
                    }
                    else
                    {
                        $selected = '';
                    }
                    echo '<option '.$selected.' value="'.$AUT_NUM.'">'.$AUT_NOM, $AUT_PRENOM.'</option>';
                    }
                    $table->closeCursor();
                    ?>
                </select>
                <select name="editeur">
                    <?php
                    $sql = 'SELECT * FROM editeur';
                    $table = $connection->query($sql);
                        while($ligne = $table->fetch()) {
                        $EDIT_NOM = $ligne['EDIT_NOM'];
                        $EDIT_NUM = $ligne['EDIT_NUM'];
                        if($EDIT_NOM == $editeur)
                        {
                            $selected = 'selected';
                        }
                        else
                        {
                            $selected = '';
                        }
                        echo '<option '.$selected.' value="'.$EDIT_NUM.'">'.$EDIT_NOM.'</option>';
                        }
                        $table->closeCursor();
                        ?>
                    </select><br/><br/>
                    <select name="col">
                        <?php
                        $sql = 'SELECT * FROM collection';
                        $table = $connection->query($sql);
                            while($ligne = $table->fetch()) {
                                $COL_NUM = $ligne['COL_NUM'];
                                $COL_NOM = $ligne['COL_NOM'];
                                if($COL_NUM == $collection)
                            {
                                $selected = 'selected';
                            }
                            else
                            {
                                $selected = '';
                            }
                            echo '<option '.$selected.' value="'.$COL_NUM.'">'.$COL_NOM.'</option>';
                            }
                            $table->closeCursor();
                            ?>
                    </select>
                    <select name="rubrique">
                        <?php
                        $sql = 'SELECT * FROM rubriques';
                        $table = $connection->query($sql);
                            while($ligne = $table->fetch()) {
                                $RUB_ID = $ligne['RUB_ID'];
                                $RUB_NOM = $ligne['RUB_NOM'];
                                if($RUB_NOM == $rubrique)
                            {
                                $selected = 'selected';
                            }
                            else
                            {
                                $selected = '';
                            }
                            echo '<option '.$selected.' value="'.$RUB_ID.'">'.$RUB_NOM.'</option>';
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

            <input name="titre" value="<?php echo $titre ?>" type="text" placeholder="Titre"></br>
            <input name="date" value="<?php echo $date ?>" type="text" placeholder="Date de parution (optionnel)"><br/>
            <textarea name="resume" style="margin: 0px; height: 80px; width: 400px;"><?php echo $resume ?></textarea>
            <br/><input type="submit" value="Valider"/>
        </form>
        <br/>
            <?php
        }
        else{
            header('Location: login.php');
        }
        ?>
    </div>
    </body>
</html>
