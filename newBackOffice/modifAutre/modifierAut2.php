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
        <h1>Modification Auteur</h1><h2>Connecté(e) : <?php echo $_SESSION['LOGID'];?></h2>
    </div>
    <div id="main_content">
        <?php
        $numAut = htmlentities($_POST["aut"]);
        $sql = 'SELECT *  FROM auteur WHERE AUT_NUM = "'.$numAut.'"';
        $table = $connection->query($sql);
        while ($ligne = $table->fetch()) {
            $nomAut = $ligne['AUT_NOM'];
            $prenomAut = $ligne['AUT_PRENOM'];            
        }
        $table->closeCursor();
        ?>
        <h1>Modifier <?php echo $nomAut." ".$prenomAut ?>:</h1>
         <form action="modificationAuteur.php" method="POST">
            <input type="hidden" name="numAut" value="<?php echo $numAut ?>">
            
            <input name="nomModif" value="<?php echo $nomAut ?>" type="text"><br/>
            <input name="prenomModif" value="<?php echo $prenomAut ?>" type="text">
        
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
