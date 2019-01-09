<!DOCTYPE html>
<html>
<?php
    require_once 'getHead.php';
    setHead();
?>
<body>
<?php
    session_start();
     //vérification de la session
    require 'getNav.php';
    setNav();
    if (isset($_SESSION['LOGID'])) {
    require '../sqlconnect.php';
?>
    <div id="current_page">
        <h1>Ajout Livre</h1><h2>Connecté(e) : <?php echo $_SESSION['LOGID'];?></h2>
    </div>
    <div id="main_content">
        <form action="ajoutPlus/ajouter.php" method="POST">
            <p>Ajouter un Livre<p>
            <p>Titre du livre</p>
              <input type="text" name="titre" value="" placeholder="Titre" required/><br/>
              <p>ISBN</p>
              <input type="text" name="isbn" value="" placeholder="ISBN" pattern="^[0-9]{3}-[0-9]{1}-[0-9]{4}-[0-9]{4}-[0-9]{1}$" title="L'ISBN doit ressembler à : XXX-X-XXXX-XXXX-X" required/><br/><br/><br/>
            <div id="auteur">
              Auteur :
            <select id="select_auteur0" name="auteur" onchange="ajoutFon();" required>
              <option value='rien'>Choisir :</option>
              <?php
              $sql = 'SELECT AUT_NOM, AUT_PRENOM, AUT_NUM  FROM auteur';
              $table = $connection->query($sql);
              while($ligne = $table->fetch()) {
                $nomAut = $ligne['AUT_NOM'];
                $prenomAut = $ligne['AUT_PRENOM'];
                $numAut = $ligne['AUT_NUM'];
              	?>
              	<option value='<?php echo $numAut ?>'><?php echo $nomAut.' '.$prenomAut?></option>
              <?php }
              $table->closeCursor();
              ?>
                <option value="ajoutAut">Ajouter</option>
            </select></div>
            <br/>
            Collection :
            <select id="select_collection" name="collection" onchange="ajoutFon2();" required>
              <option value=''>Choisir :</option>
              <?php
              $sql = 'SELECT COL_NOM, COL_NUM  FROM collection';
              $table = $connection->query($sql);
              while($ligne = $table->fetch()) {
                $nomCol = $ligne['COL_NOM'];
                $numCol = $ligne['COL_NUM'];
              	?>
              	<option value='<?php echo $numCol ?>'><?php echo $nomCol?></option>
              <?php }
              $table->closeCursor();
              ?>
                <option value="ajoutCol">Ajouter</option>
            </select><br/>
            <br/>
            Editeur :
            <select id="select_editeur" name="editeur" onchange="ajoutFon3();" required>
              <option value=''>Choisir :</option>
              <?php
              $sql = 'SELECT *  FROM editeur';
              $table = $connection->query($sql);
              while($ligne = $table->fetch()) {
                $nomEdit = $ligne['EDIT_NOM'];
                $numEdit = $ligne['EDIT_NUM'];
              	?>
              	<option value='<?php echo $numEdit ?>'><?php echo $nomEdit?></option>
              <?php }
              $table->closeCursor();
              ?>
                <option value="ajoutEdit">Ajouter</option>
            </select><br/>
            <br/>
            <div id="rubrique">
            Rubrique :
            <select id="select_rubrique0" name="rubrique" onchange="ajoutFon4();" required>
              <option value='rien'>Choisir :</option>
              <?php
              $sql = 'SELECT * FROM rubriques';
              $table = $connection->query($sql);
              while($ligne = $table->fetch()) {
                $idRub = $ligne['RUB_ID'];
                $nomRub = $ligne['RUB_NOM'];
              	?>
              	<option value='<?php echo $idRub ?>'><?php echo $nomRub?></option>
              <?php }
              $table->closeCursor();
              ?>
                <option value="ajoutRub">Ajouter</option>
            </select></div>

            <br/>
            Date de parution :
            <input type="date" name="date" value=""/><br/>
            <br/>
            <input type="submit" value="Valider"/>
          </p>

        </form>
      </div>
      <?php
      }
      else{
        header('Location: ../login.php');
      }
      ?>
    </body>
</html>
