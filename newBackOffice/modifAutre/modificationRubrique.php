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
        $idRub=htmlentities($_POST["idRub"]);
        $nomRub=htmlentities($_POST["nomModif"]);
        $sql="UPDATE rubriques SET RUB_NOM='".$nomRub."' WHERE RUB_ID = '".$idRub."';";
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
