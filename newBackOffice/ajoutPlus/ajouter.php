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
            if (isset($_SESSION['nomImage'])) {
                $image = $_SESSION['nomImage'];
            } else {
                echo 'oui';
            }
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
            $sql = $connection->prepare('INSERT INTO livre(LIV_ISBN, COL_NUM, EDIT_NUM, LIV_TITRE, LIV_DATE, LIV_IMG, LIV_RESUME, LIV_ETAT ) VALUES(:ISBN, :collection, :editeur, :titre, :date, :image, :resume, :etat)');
            $sql->execute(array(
                        'ISBN' => $isbn,
                        'collection' => $collection,
                        'editeur' => $editeur,
                        'titre' => $titre,
                        'date' => $date,
                        'image' => $image,
                        'resume' => $resume,
                        'etat' => $etat
                    )) or die(print_r($connection->errorInfo()));
            var_dump($auteur);

            foreach ($auteur as $aut) {
                $req = 'INSERT INTO ecrire(AUT_NUM, LIV_ISBN) VALUES("' . $aut . '","' . $isbn . '")';
                $connection->exec($req);
                echo $isbn;
                var_dump($aut);
            }
            foreach ($rubrique as $rub) {
                $sql3 = $connection->prepare('INSERT INTO correspondre(RUB_ID, LIV_ISBN) VALUES(:rub, :ISBN)');
                $sql3->execute(array(
                    'rub' => $rub,
                    'ISBN' => $isbn
                ));
            }
            unset($_SESSION['nomImage']);
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
