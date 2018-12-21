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
        require '../sqlconnect.php';
        ?>
        <?php
        $numAut=htmlentities($_POST["numAut"]);
        $nomAut=htmlentities($_POST["nomModif"]);
        $prenomAut=htmlentities($_POST["prenomModif"]);
        $sql="UPDATE auteur SET AUT_NOM='".$nomAut."',AUT_PRENOM='".$prenomAut."' WHERE AUT_NUM = '".$numAut."';";
        $connection->exec($sql);
        ?>
            <?php
        }
        else{
            header('Location: login.php');
        }
        ?>
</body>
</html>
