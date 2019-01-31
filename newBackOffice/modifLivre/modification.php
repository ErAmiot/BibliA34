<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Accès BackOffice</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body  onload="location.href = '../index.php';">
        <?php
        //onload="location.href = '../index.php';"
        session_start();
        #vérification de la session
        if (isset($_SESSION['LOGID'])) {
            require '../../sqlconnect.php';
            ?>
            <?php
            $isbn = htmlentities($_GET["isbn"]);
            $auteur = $_GET["auteur"];
            $editeur = htmlentities($_GET["editeur"]);
            $titre = htmlentities($_GET["titre"]);
            $date = htmlentities($_GET["date"]);
            $col = htmlentities($_GET["col"]);
            $rubrique = $_GET["rubrique"];
            $etat = htmlentities($_GET["etat"]);
            $resume = htmlentities($_GET["resume"]);
            $suppr = 'Delete FROM correspondre where LIV_ISBN="' . $isbn . '"';
            $suppr2 = 'DELETE FROM ecrire where LIV_ISBN="' . $isbn . '"';
            $connection->exec($suppr);
            $connection->exec($suppr2);
            foreach ($auteur as $aut) {
                $sql2 = "INSERT INTO ecrire (AUT_NUM, LIV_ISBN) VALUES ('" . $aut . "', '" . $isbn . "');";
                $connection->exec($sql2);
            }
            foreach ($rubrique as $rub) {
                $sql3 = "INSERT INTO correspondre (RUB_ID, LIV_ISBN) VALUES ('" . $rub . "', '" . $isbn . "');";
                $connection->exec($sql3);
            }            
            $sql = "UPDATE livre SET LIV_TITRE='" . $titre . "',EDIT_NUM='" . $editeur . "',LIV_DATE='" . $date . "',COL_NUM='" . $col . "', LIV_ETAT='" . $etat . "', LIV_RESUME='" . $resume . "' WHERE LIV_ISBN = '" . $isbn . "';";
            $connection->exec($sql);
        } else {
            header('Location: login.php');
        }
        ?>
    </body>
</html>