<?php
require '../../sqlconnect.php';

if( isset($_GET["nomAuteur"])) {

  $nomAuteur=htmlentities($_GET["nomAuteur"]);

  $sql = "SELECT  *  FROM livre, auteur, ecrire, collection, correspondre, editeur, rubriques "
          . "WHERE livre.EDIT_NUM = editeur.EDIT_NUM "
          . "AND livre.LIV_ISBN = ecrire.LIV_ISBN "
          . "AND correspondre.RUB_ID = rubriques.RUB_ID "
          . "AND ecrire.AUT_NUM =  '".$nomAuteur."' "
          . "AND auteur.AUT_NUM =  '".$nomAuteur."' "
          . "AND livre.COL_NUM = collection.COL_NUM "
          . "AND livre.LIV_ISBN = correspondre.LIV_ISBN ;";
          
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
    <form class="" action="modifLivre/modifier2.php" method="post">
      <table>
        <tr>
          <th>Titre</th>
          <th>N° ISBN</th>
          <th>Auteur</th>
          <th>Editeur</th>
          <th>Collection</th>
          <th>Rubrique</th>
          <th>Date</th>
          <th>Livre a modifier</th>
        </tr>
      <?php
      while($ligne = $table->fetch()) {
              $LIV_ISBN = $ligne["LIV_ISBN"];
              $COL_NOM = $ligne["COL_NOM"];
              $EDIT_NOM = $ligne["EDIT_NOM"];
              $LIV_TITRE = $ligne["LIV_TITRE"];
              $LIV_DATE = $ligne["LIV_DATE"];
              $AUT_NOM = $ligne["AUT_NOM"];
              $AUT_PRENOM = $ligne["AUT_PRENOM"];
              $RUB_NOM = $ligne["RUB_NOM"];
        ?>
        <tr>
          <td><?php echo $LIV_TITRE; ?></td>
          <td><?php echo $LIV_ISBN; ?></td>
          <td><?php echo $AUT_NOM." ".$AUT_PRENOM; ?></td>
          <td><?php echo $EDIT_NOM; ?></td>
          <td><?php echo $COL_NOM; ?></td>
          <td><?php echo $RUB_NOM; ?></td>
          <td><?php echo $LIV_DATE; ?></td>
          <td><input type="radio" name="modif" value="<?php echo $LIV_ISBN ?>"></td>
        </tr>
        <?php
      }
      ?>
      </table>
      <input type="submit" value="Modifier">
    </form>
    <?php
  }
  else {
    echo $sql;
    echo "Aucun livre ne correspond a votre recherche.";
  }

}
elseif (isset($_GET["motclef"])) {
  $motclef=htmlentities($_GET["motclef"]);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, rubriques, editeur WHERE livre.EDIT_NUM = editeur.EDIT_NUM AND livre.LIV_ISBN = ecrire.LIV_ISBN AND correspondre.RUB_ID = rubriques.RUB_ID and ecrire.AUT_NUM = auteur.AUT_NUM and livre.COL_NUM = collection.COL_NUM and livre.LIV_ISBN = correspondre.LIV_ISBN and (livre.LIV_TITRE LIKE '%$motclef%' OR auteur.AUT_NOM LIKE '%$motclef%' OR auteur.AUT_PRENOM LIKE '%$motclef%') ";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
    <form class="" action="modifLivre/modifier2.php" method="post">
      <table>
        <tr>
          <th>Titre</th>
          <th>N° ISBN</th>
          <th>Auteur</th>
          <th>Editeur</th>
          <th>Collection</th>
          <th>Rubrique</th>
          <th>Date</th>
          <th>Livre a modifier</th>
        </tr>
      <?php
    	while($ligne = $table->fetch()) {
    		$LIV_ISBN = $ligne["LIV_ISBN"];
        $COL_NOM = $ligne["COL_NOM"];
    		$EDIT_NOM = $ligne["EDIT_NOM"];
    		$LIV_TITRE = $ligne["LIV_TITRE"];
        $LIV_DATE = $ligne["LIV_DATE"];
        $AUT_NOM = $ligne["AUT_NOM"];
        $AUT_PRENOM = $ligne["AUT_PRENOM"];
        $RUB_NOM = $ligne["RUB_NOM"];
        ?>
        <tr>
          <td><?php echo $LIV_TITRE; ?></td>
          <td><?php echo $LIV_ISBN; ?></td>
          <td><?php echo $AUT_NOM." ".$AUT_PRENOM; ?></td>
          <td><?php echo $EDIT_NOM; ?></td>
          <td><?php echo $COL_NOM; ?></td>
          <td><?php echo $RUB_NOM; ?></td>
          <td><?php echo $LIV_DATE; ?></td>
          <td><input type="radio" name="modif" value="<?php echo $LIV_ISBN ?>"></td>
        </tr>
        <?php
      }
      ?>
      </table>
      <input type="submit" value="Modifier">
    </form>
    <?php
  }
  else {
    echo "Aucun livre ne correspond a votre recherche.";
  }
}
elseif (isset($_GET["isbn"])) {
  $isbn=htmlentities($_GET["isbn"]);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, rubriques, editeur "
          . "WHERE livre.EDIT_NUM = editeur.EDIT_NUM "
          . "AND livre.LIV_ISBN = ecrire.LIV_ISBN "
          . "and ecrire.AUT_NUM = auteur.AUT_NUM "
          . "AND correspondre.RUB_ID = rubriques.RUB_ID "
          . "and livre.COL_NUM = collection.COL_NUM "
          . "and livre.LIV_ISBN = correspondre.LIV_ISBN "
          . "and livre.LIV_ISBN = '".$isbn."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
    <form class="" action="modifLivre/modifier2.php" method="post">
      <table>
        <tr>
          <th>Titre</th>
          <th>N° ISBN</th>
          <th>Auteur</th>
          <th>Editeur</th>
          <th>Collection</th>
          <th>Rubrique</th>
          <th>Date</th>
          <th>Livre a modifier</th>
        </tr>
      <?php
    	while($ligne = $table->fetch()) {
    		$LIV_ISBN = $ligne["LIV_ISBN"];
        $COL_NOM = $ligne["COL_NOM"];
    		$EDIT_NOM = $ligne["EDIT_NOM"];
    		$LIV_TITRE = $ligne["LIV_TITRE"];
        $LIV_DATE = $ligne["LIV_DATE"];
        $AUT_NOM = $ligne["AUT_NOM"];
        $AUT_PRENOM = $ligne["AUT_PRENOM"];
        $RUB_NOM = $ligne["RUB_NOM"];
        ?>
        <tr>
          <td><?php echo $LIV_TITRE; ?></td>
          <td><?php echo $LIV_ISBN; ?></td>
          <td><?php echo $AUT_NOM." ".$AUT_PRENOM; ?></td>
          <td><?php echo $EDIT_NOM; ?></td>
          <td><?php echo $COL_NOM; ?></td>
          <td><?php echo $RUB_NOM; ?></td>
          <td><?php echo $LIV_DATE; ?></td>
          <td><input type="radio" name="modif" value="<?php echo $LIV_ISBN ?>"></td>
        </tr>
        <?php
      }
      ?>
      </table>
      <input type="submit" value="Modifier">
    </form>
    <?php
  }
  else {
    echo "Aucun livre ne correspond a votre recherche.";
  }
}
elseif (isset($_GET['titre'])) {
  $titre=htmlentities($_GET['titre']);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, rubriques, editeur WHERE livre.EDIT_NUM = editeur.EDIT_NUM AND livre.LIV_ISBN = ecrire.LIV_ISBN and ecrire.AUT_NUM = auteur.AUT_NUM AND correspondre.RUB_ID = rubriques.RUB_ID and livre.COL_NUM = collection.COL_NUM and livre.LIV_ISBN = correspondre.LIV_ISBN and livre.LIV_TITRE = '".$titre."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
    <form class="" action="modifLivre/modifier2.php" method="post">
      <table>
        <tr>
          <th>Titre</th>
          <th>N° ISBN</th>
          <th>Auteur</th>
          <th>Editeur</th>
          <th>Collection</th>
          <th>Rubrique</th>
          <th>Date</th>
          <th>Livre a modifier</th>
        </tr>
      <?php
    	while($ligne = $table->fetch()) {
    		$LIV_ISBN = $ligne["LIV_ISBN"];
        $COL_NOM = $ligne["COL_NOM"];
    		$EDIT_NOM = $ligne["EDIT_NOM"];
    		$LIV_TITRE = $ligne["LIV_TITRE"];
        $LIV_DATE = $ligne["LIV_DATE"];
        $AUT_NOM = $ligne["AUT_NOM"];
        $AUT_PRENOM = $ligne["AUT_PRENOM"];
        $RUB_NOM = $ligne["RUB_NOM"];
        ?>
        <tr>
          <td><?php echo $LIV_TITRE; ?></td>
          <td><?php echo $LIV_ISBN; ?></td>
          <td><?php echo $AUT_NOM." ".$AUT_PRENOM; ?></td>
          <td><?php echo $EDIT_NOM; ?></td>
          <td><?php echo $COL_NOM; ?></td>
          <td><?php echo $RUB_NOM; ?></td>
          <td><?php echo $LIV_DATE; ?></td>
          <td><input type="radio" name="modif" value="<?php echo $LIV_ISBN ?>"></td>
        </tr>
        <?php
      }
      ?>
      </table>
      <input type="submit" value="Modifier">
    </form>
    <?php
  }
  else {
    echo "Aucun livre ne correspond a votre recherche.";
  }
}
?>
