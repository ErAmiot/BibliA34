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
        <h1>Modification Collection</h1><h2>Connecté(e) : <?php echo $_SESSION['LOGID'];?></h2>
    </div>
    <div id="main_content">
        <?php
        $numCol = htmlentities($_POST["coll"]);
        $sql = 'SELECT *  FROM collection WHERE COL_NUM = "'.$numCol.'"';
        $table = $connection->query($sql);
        while ($ligne = $table->fetch()) {
            $nomCol = $ligne['COL_NOM'];
            $nomEdit = $ligne['EDIT_NUM'];            
        }
        $table->closeCursor();
        ?>
        <h1>Modifier <?php echo $nomCol ?>:</h1>
         <form action="modificationCollection.php" method="POST">
            <input type="hidden" name="numCol" value="<?php echo $numCol ?>">
            <select name="editeur">
                <?php
                $sql = 'SELECT EDIT_NUM, EDIT_NOM FROM editeur';
                echo $sql.'<br>';
                $table = $connection->query($sql);
                while($ligne = $table->fetch()) {
                    $EDIT_NOM = $ligne['EDIT_NOM'];
                    echo $EDIT_NOM.'<br>';
                    $EDIT_NUM = $ligne['EDIT_NUM'];
                    echo $EDIT_NUM;
                    if($EDIT_NOM == $nomEdit)
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
                </select>
            <input name="nomModif" value="<?php echo $nomCol ?>" type="text"><br/>
        
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
