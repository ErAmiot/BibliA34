<?php
require '../sqlconnect.php';

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
<div id="divImprAut">
    <table>
      <tr>
        <th>Titre</th>
        <th>N° ISBN</th>
        <th>Auteur</th>
        <th>Editeur</th>
        <th>Collection</th>
        <th>Rubrique</th>
        <th>Date</th>
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
      </tr>
      <?php
    }
    ?>
    </table>
    </div>
<button type="button" onclick="printdiv('divImprAut');">Imprimer la liste des livres</button>
                <script>
                    function printdiv(divImprAut)
                        {
                            var headstr = "<html><head><title></title></head><body>";
                            var footstr = "</body>";
                            var newstr = document.all.item(divImprAut).innerHTML;
                            var oldstr = document.body.innerHTML;
                            document.body.innerHTML = headstr+newstr+footstr;
                            window.print();
                            document.body.innerHTML = oldstr;
                            return false;
                        }
                </script>
    <?php

  }

  else {
    echo "Aucun livre ne correspond à votre recherche.";
  }

}
elseif (isset($_GET["numEditeur"])) {
  $numEditeur=htmlentities($_GET["numEditeur"]);

  $sql = "SELECT * FROM livre, ecrire, auteur, editeur, collection, correspondre, rubriques "
                        . "WHERE livre.LIV_ISBN = ecrire.LIV_ISBN "
                        . "AND ecrire.AUT_NUM = auteur.AUT_NUM "
                        . "AND livre.EDIT_NUM = editeur.EDIT_NUM "
                        . "AND livre.COL_NUM = collection.COL_NUM "
                        . "AND livre.LIV_ISBN = correspondre.LIV_ISBN "
                        . "AND correspondre.RUB_ID = rubriques.RUB_ID "
                        . "AND editeur.EDIT_NUM = '".$numEditeur."'";

  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprEdi">
    <table>
      <tr>
        <th>Titre</th>
        <th>N° ISBN</th>
        <th>Auteur</th>
        <th>Editeur</th>
        <th>Collection</th>
        <th>Rubrique</th>
        <th>Date</th>
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
      </tr>
      <?php
    }
    ?>
    </table>
                </div>
                <button type="button" onclick="printdiv('divImprEdi');">Imprimer la liste des livres</button>
                <script>
                    function printdiv(divImprEdi)
                        {
                            var headstr = "<html><head><title></title></head><body>";
                            var footstr = "</body>";
                            var newstr = document.all.item(divImprEdi).innerHTML;
                            var oldstr = document.body.innerHTML;
                            document.body.innerHTML = headstr+newstr+footstr;
                            window.print();
                            document.body.innerHTML = oldstr;
                            return false;
                        }
                </script>
    <?php
  }
  else {
    echo "Aucun livre ne correspond à votre recherche.";
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
                <div id="divImprIsbn">
    <table>
      <tr>
        <th>Titre</th>
        <th>N° ISBN</th>
        <th>Auteur</th>
        <th>Editeur</th>
        <th>Collection</th>
        <th>Rubrique</th>
        <th>Date</th>
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
      </tr>
      <?php
    }
    ?>
    </table>
                </div>
                <button type="button" onclick="printdiv('divImprIsbn');">Imprimer la liste des livres</button>
                <script>
                    function printdiv(divImprIsbn)
                        {
                            var headstr = "<html><head><title></title></head><body>";
                            var footstr = "</body>";
                            var newstr = document.all.item(divImprIsbn).innerHTML;
                            var oldstr = document.body.innerHTML;
                            document.body.innerHTML = headstr+newstr+footstr;
                            window.print();
                            document.body.innerHTML = oldstr;
                            return false;
                        }
                </script>
    <?php
  }
  else {
    echo "Aucun livre ne correspond à votre recherche.";
  }
}
elseif (isset($_GET["motclef"])) {
  $motclef=htmlentities($_GET["motclef"]);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, rubriques, editeur WHERE livre.EDIT_NUM = editeur.EDIT_NUM AND livre.LIV_ISBN = ecrire.LIV_ISBN and ecrire.AUT_NUM = auteur.AUT_NUM AND correspondre.RUB_ID = rubriques.RUB_ID and livre.COL_NUM = collection.COL_NUM and livre.LIV_ISBN = correspondre.LIV_ISBN and (livre.LIV_TITRE LIKE '%$motclef%' OR auteur.AUT_NOM LIKE '%$motclef%' OR auteur.AUT_PRENOM LIKE '%$motclef%') ";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
    <form class="" action="modifLivre/modifier2.php" method="post">
      <div id="divImprMotC">
      <table>
        <tr>
          <th>Titre</th>
          <th>N° ISBN</th>
          <th>Auteur</th>
          <th>Editeur</th>
          <th>Collection</th>
          <th>Rubrique</th>
          <th>Date</th>
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
        </tr>
        <?php
      }
    ?>
    </table>
                </div>
                <button type="button" onclick="printdiv('divImprMotC');">Imprimer la liste des livres</button>
                <script>
                    function printdiv(divImprMotC)
                        {
                            var headstr = "<html><head><title></title></head><body>";
                            var footstr = "</body>";
                            var newstr = document.all.item(divImprMotC).innerHTML;
                            var oldstr = document.body.innerHTML;
                            document.body.innerHTML = headstr+newstr+footstr;
                            window.print();
                            document.body.innerHTML = oldstr;
                            return false;
                        }
                </script>
    <?php
  }
  else {
    echo "Aucun livre ne correspond à votre recherche.";
  }
}
elseif (isset($_GET['valRubriques'])) {
  $valRubriques=htmlentities($_GET['valRubriques']);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, rubriques, editeur "
          . "WHERE livre.EDIT_NUM = editeur.EDIT_NUM "
          . "AND livre.LIV_ISBN = ecrire.LIV_ISBN "
          . "and ecrire.AUT_NUM = auteur.AUT_NUM "
          . "and livre.COL_NUM = collection.COL_NUM "
          . "and livre.LIV_ISBN = correspondre.LIV_ISBN "
          . "and correspondre.RUB_ID = rubriques.RUB_ID "
          . "and rubriques.RUB_NOM = '".$valRubriques."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprRub">
    <table>
      <tr>
        <th>Titre</th>
        <th>N° ISBN</th>
        <th>Auteur</th>
        <th>Editeur</th>
        <th>Collection</th>
        <th>Rubrique</th>
        <th>Date</th>
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
      </tr>
      <?php
    }
    ?>
    </table>
                </div>
                <button type="button" onclick="printdiv('divImprRub');">Imprimer la liste des livres</button>
                <script>
                    function printdiv(divImprRub)
                        {
                            var headstr = "<html><head><title></title></head><body>";
                            var footstr = "</body>";
                            var newstr = document.all.item(divImprRub).innerHTML;
                            var oldstr = document.body.innerHTML;
                            document.body.innerHTML = headstr+newstr+footstr;
                            window.print();
                            document.body.innerHTML = oldstr;
                            return false;
                        }
                </script>
    <?php
  }
  else {
    echo "Aucun livre ne correspond à votre recherche.";
  }
}
elseif (isset($_GET['titre'])) {
  $titre=htmlentities($_GET['titre']);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, editeur, rubriques "
          . "WHERE livre.EDIT_NUM = editeur.EDIT_NUM "
          . "AND livre.LIV_ISBN = ecrire.LIV_ISBN "
          . "AND correspondre.RUB_ID = rubriques.RUB_ID "
          . "and ecrire.AUT_NUM = auteur.AUT_NUM "
          . "and livre.COL_NUM = collection.COL_NUM "
          . "and livre.LIV_ISBN = correspondre.LIV_ISBN "
          . "and livre.LIV_TITRE = '".$titre."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprTit">
    <table>
      <tr>
        <th>Titre</th>
        <th>N° ISBN</th>
        <th>Auteur</th>
        <th>Editeur</th>
        <th>Collection</th>
        <th>Rubrique</th>
        <th>Date</th>
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
      </tr>
      <?php
    }
    ?>
    </table>
                </div>
                <button type="button" onclick="printdiv('divImprTit');">Imprimer la liste des livres</button>
                <script>
                    function printdiv(divImprTit)
                        {
                            var headstr = "<html><head><title></title></head><body>";
                            var footstr = "</body>";
                            var newstr = document.all.item(divImprTit).innerHTML;
                            var oldstr = document.body.innerHTML;
                            document.body.innerHTML = headstr+newstr+footstr;
                            window.print();
                            document.body.innerHTML = oldstr;
                            return false;
                        }
                </script>
    <?php
  }
  else {
    echo "Aucun livre ne correspond à votre recherche.";
  }
}
elseif (isset($_GET['nomCollection'])) {
  $nomCollection=htmlentities($_GET['nomCollection']);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, editeur, rubriques "
          . "WHERE livre.EDIT_NUM = editeur.EDIT_NUM "
          . "AND livre.LIV_ISBN = ecrire.LIV_ISBN "
          . "and ecrire.AUT_NUM = auteur.AUT_NUM "
          . "AND correspondre.RUB_ID = rubriques.RUB_ID "
          . "and livre.COL_NUM = collection.COL_NUM "
          . "and livre.LIV_ISBN = correspondre.LIV_ISBN "
          . "and collection.COL_NOM = '".$nomCollection."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprColl">
    <table>
      <tr>
        <th>Titre</th>
        <th>N° ISBN</th>
        <th>Auteur</th>
        <th>Editeur</th>
        <th>Collection</th>
        <th>Rubrique</th>
        <th>Date</th>
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
      </tr>
      <?php
    }
    ?>
    </table>
                </div>
                <button type="button" onclick="printdiv('divImprColl');">Imprimer la liste des livres</button>
                <script>
                    function printdiv(divImprColl)
                        {
                            var headstr = "<html><head><title></title></head><body>";
                            var footstr = "</body>";
                            var newstr = document.all.item(divImprColl).innerHTML;
                            var oldstr = document.body.innerHTML;
                            document.body.innerHTML = headstr+newstr+footstr;
                            window.print();
                            document.body.innerHTML = oldstr;
                            return false;
                        }
                </script>
    <?php
  }
  else {
    echo "Aucun livre ne correspond à votre recherche.";
  }
}
else{
  echo "erreur";
}
?>
