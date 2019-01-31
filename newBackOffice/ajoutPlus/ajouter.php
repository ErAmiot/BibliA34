<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Accès BackOffice</title>
    </head>
    <body onload="location.href = '../index.php';">
        <?php
        //
        session_start();
        if (isset($_SESSION['LOGID'])) {
            # code..
            ?>
            <h1>Ajout</h1>
            <?php
            $titre = htmlentities($_POST["titre"]);
            $auteur = $_POST["auteur"];
            $collection = htmlentities($_POST["collection"]);
            $editeur = htmlentities($_POST["editeur"]);
            $rubrique = $_POST["rubrique"];
            $isbn = htmlentities($_POST["isbn"]);
            $date = htmlentities($_POST["date"]);
            $resume = htmlentities($_POST["resume"]);
            $etat = htmlentities($_POST["etat"]);
            require '../../sqlconnect.php';
            $sql = 'INSERT INTO livre (LIV_ISBN, COL_NUM, EDIT_NUM, LIV_TITRE, LIV_DATE, LIV_RESUME, LIV_ETAT) '
                    . 'VALUES ("'. $isbn . '", "' . $collection . '", "' . $editeur . '", "' . $titre . '","' . $date . '", "' . $resume . '", "' . $etat . '");';
            $connection->exec($sql);
            echo 'requete'.$sql.'<br>';
            foreach ($auteur as $aut) {
                $sql2 = "INSERT INTO ecrire (AUT_NUM, LIV_ISBN) VALUES ('" . $aut . "', '" . $isbn . "');";
            $connection->exec($sql2);
            }
            foreach ($rubrique as $rub) {
                $sql3 = "INSERT INTO correspondre (RUB_ID, LIV_ISBN) VALUES ('" . $rub . "', '" . $isbn . "');";
                echo 'requete 3 '.$sql3.'<br>';
            $connection->exec($sql3);
            }



            echo "le livre a bien été ajouté.";
            ?>
            <br/>
            <br/>
            <?php
        } else {
            header('Location: login.html');
        }
        ?>

    </body>
</html>