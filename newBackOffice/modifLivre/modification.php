<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Accès BackOffice</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body onload="location.href = '../index.php';">
    <?php
    session_start();
    #vérification de la session
    if (isset($_SESSION['LOGID'])) {
        require '../../sqlconnect.php';
        ?>
        <?php
        $isbn=htmlentities($_GET["isbn"]);
        $auteur=htmlentities($_GET["auteur"]);
        $editeur=htmlentities($_GET["editeur"]);
        $titre=htmlentities($_GET["titre"]);
        $date=htmlentities($_GET["date"]);
        $col=htmlentities($_GET["col"]);
        $rub=htmlentities($_GET["rubrique"]);
        $sql3 = "UPDATE correspondre SET RUB_ID = '".$rub."' WHERE LIV_ISBN = '".$isbn."';";
        $sql="UPDATE livre SET LIV_TITRE='".$titre."',EDIT_NUM='".$editeur."',LIV_DATE='".$date."',COL_NUM='".$col."' WHERE LIV_ISBN = '".$isbn."';";
        $sql2="UPDATE ecrire SET AUT_NUM='".$auteur."' WHERE LIV_ISBN = '".$isbn."';";
        $connection->exec($sql3);
        $connection->exec($sql);
        $connection->exec($sql2);
        }
        else{
            header('Location: login.php');
        }
        ?>
    </body>
    </html>
