<?php
require '../sqlconnect.php';

if(isset($_GET["prenomAuteur"]) || isset($_GET["nomAuteur"])) {
  $prenomAuteur=htmlentities($_GET["prenomAuteur"]);
  $nomAuteur=htmlentities($_GET["nomAuteur"]);

  $sql = "SELECT  *  FROM livre, auteur, ecrire, collection, correspondre, editeur "
          . "WHERE livre.EDIT_NUM = editeur.EDIT_NUM "
          . "AND livre.LIV_ISBN = ecrire.LIV_ISBN "
          . "AND ecrire.AUT_NUM = auteur.AUT_NUM and livre.COL_NUM = collection.COL_NUM "
          . "AND livre.LIV_ISBN = correspondre.LIV_ISBN "
          . "AND (AUT_NOM = '".$nomAuteur."' "
          . "OR AUT_PRENOM = '".$prenomAuteur."');";
          
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
<div id="divImprAut"> <!-- Div pour imprimer le tableau grâce à la fonction printdiv()-->
    <table> <!-- Tableau qui affiche la liste des livres en fonction de l'Auteur -->
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
    </table> <!-- Fin du tableau -->
    </div>
<!-- Bouton pour imprimer le tableau -->
<button type="button" onclick="printdiv('divImprAut');">Imprimer la liste des livres</button>

                <script>
                    //Fonction qui permet d'imprimer ce qui se trouve dans un div nommé "divImprAut"
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
  else {//Si aucun livre ne correspond à la recherche
    echo "Aucun livre ne correspond a votre recherche.";
  }

}
elseif (isset($_GET["numEditeur"])) {//Si l'utilisateur souhaite rechercher un livre en fonction de l'éditeur
  $numEditeur=htmlentities($_GET["numEditeur"]);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, editeur WHERE livre.LIV_ISBN = ecrire.LIV_ISBN and ecrire.AUT_NUM = auteur.AUT_NUM and livre.COL_NUM = collection.COL_NUM and livre.LIV_ISBN = correspondre.LIV_ISBN and livre.EDIT_NUM = editeur.EDIT_NUM AND editeur.EDIT_NUM = '".$numEditeur."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprEdi"><!-- div qui permet d'imprimer le tableau qui suit grace à la fonction printdiv() -->
    <table> <!-- Tableau qui affiche tout les livres en fonction de l'éditeur choisi -->
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
    </table> <!-- Fin du tableau -->
                </div>
                <!-- Bouton qui permet d'imprimer le tableau -->
                <button type="button" onclick="printdiv('divImprEdi');">Imprimer la liste des livres</button>
                <script>
                    // Fonction qui permet d'imprimer ce qui se trouve dans le div "divImprEdi"
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
  else {// Si aucun livre ne correspond à la recherche souhaité
    echo "Aucun livre ne correspond a votre recherche.";
  }
}
elseif (isset($_GET["isbn"])) {// Recherche de livre en fonction de l'ISBN du livre
  $isbn=htmlentities($_GET["isbn"]);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, editeur WHERE livre.EDIT_NUM = editeur.EDIT_NUM AND livre.LIV_ISBN = ecrire.LIV_ISBN and ecrire.AUT_NUM = auteur.AUT_NUM and livre.COL_NUM = collection.COL_NUM and livre.LIV_ISBN = correspondre.LIV_ISBN and livre.LIV_ISBN = '".$isbn."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprIsbn"> <!-- Div permettant d'imprimer le tableau avec la fonction printdiv()-->
    <table><!-- tableau qui affiche tout les livres en fonction de l'isbn du livre -->
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
    </table><!-- Fin du tableau -->
                </div>
                <!-- bouton pour imprimer le tableau -->
                <button type="button" onclick="printdiv('divImprIsbn');">Imprimer la liste des livres</button>
                <script>
                    //fonction qui permet d'imprimer ce qui se trouve dans le div "divImprIsbn"
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
  else {//Si aucun livre ne correspond à la recherche désirée
    echo "Aucun livre ne correspond a votre recherche.";
  }
}
elseif (isset($_GET["motclef"])) {//Si l'utilisateur veut afficher les livres avec un mot clef
  $motclef=htmlentities($_GET["motclef"]);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, editeur WHERE livre.EDIT_NUM = editeur.EDIT_NUM AND livre.LIV_ISBN = ecrire.LIV_ISBN and ecrire.AUT_NUM = auteur.AUT_NUM and livre.COL_NUM = collection.COL_NUM and livre.LIV_ISBN = correspondre.LIV_ISBN and (livre.LIV_TITRE LIKE '%$motclef%' OR auteur.AUT_NOM LIKE '%$motclef%' OR auteur.AUT_PRENOM LIKE '%$motclef%') ";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprMotC"><!-- Ce qui se trouve dans ce div pourra être imprimé grâce à la fonction printdiv() -->
    <table><!-- Tableau qui affiche tout les livres en fonction du mot clef -->
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
    </table><!-- Fin du tableau -->
                </div>
                <!-- Bouton qui permet d'imprimer le tableau -->
                <button type="button" onclick="printdiv('divImprMotC');">Imprimer la liste des livres</button>
                <script>
                    //Fonction qui permet d'imprimer ce qui se trouve dans le div "divImprMotC"
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
  else {// Si aucun livre ne correspond à la recherche
    echo "Aucun livre ne correspond a votre recherche.";
  }
}
elseif (isset($_GET['valRubriques'])) {//Si l'utilisateur veut afficher les livres en fonction de la rubrique
  $valRubriques=htmlentities($_GET['valRubriques']);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, rubriques, editeur WHERE livre.EDIT_NUM = editeur.EDIT_NUM AND livre.LIV_ISBN = ecrire.LIV_ISBN and ecrire.AUT_NUM = auteur.AUT_NUM and livre.COL_NUM = collection.COL_NUM and livre.LIV_ISBN = correspondre.LIV_ISBN and correspondre.RUB_NOM = rubriques.RUB_NOM and rubriques.RUB_NOM = '".$valRubriques."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprRub"><!-- div permettant d'imprimer le tableau grâce à la fonction printdiv() -->
    <table><!-- tableau contenant le résultat de recherche de livres en fonction de la rubrique désirée -->
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
    </table><!-- Fin du tableau -->
                </div>
                <!-- Bouton permettant d'imprimer le tableau -->
                <button type="button" onclick="printdiv('divImprRub');">Imprimer la liste des livres</button>
                <script>
                    //Fonction qui permet d'imprimer ce qui se trouve dans le div "divImprRub"
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
  else {// Si aucun livre ne correspond à la recherche désirée
    echo "Aucun livre ne correspond a votre recherche.";
  }
}
elseif (isset($_GET['titre'])) {// Recherche en fonction du titre du livre
  $titre=htmlentities($_GET['titre']);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, editeur WHERE livre.EDIT_NUM = editeur.EDIT_NUM AND livre.LIV_ISBN = ecrire.LIV_ISBN and ecrire.AUT_NUM = auteur.AUT_NUM and livre.COL_NUM = collection.COL_NUM and livre.LIV_ISBN = correspondre.LIV_ISBN and livre.LIV_TITRE = '".$titre."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprTit"><!-- Div qui permet l'impression du tableau grâce à la fonction printdiv() -->
    <table> <!-- Tableau qui affiche les livres en fonction du titre du livre -->
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
    </table><!-- Fin du tableau -->
                </div>
                <!-- Bouton permettant d'imprimer le tableau -->
                <button type="button" onclick="printdiv('divImprTit');">Imprimer la liste des livres</button>
                <script>
                    //fonction qui permet d'imprimer ce qui se trouve dans le div "divImprTit"
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
  else { // Si aucun livre ne correspond à la recherche désirée
    echo "Aucun livre ne correspond a votre recherche.";
  }
}
elseif (isset($_GET['nomCollection'])) {//Recherche de livres en fonction du nom de la collection
  $nomCollection=htmlentities($_GET['nomCollection']);

  $sql = "SELECT *  FROM livre, auteur, ecrire, collection, correspondre, editeur WHERE livre.EDIT_NUM = editeur.EDIT_NUM AND livre.LIV_ISBN = ecrire.LIV_ISBN and ecrire.AUT_NUM = auteur.AUT_NUM and livre.COL_NUM = collection.COL_NUM and livre.LIV_ISBN = correspondre.LIV_ISBN and collection.COL_NOM = '".$nomCollection."'";
  $table = $connection->query($sql);
  $count = $table->rowCount();
  if ($count > 0) {
    ?>
                <div id="divImprColl"><!--div permettant l'impression du tableau en utilisant la fonction printdiv()-->
    <table><!-- Tableau qui affiche les livres en fonction de la collection -->
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
    </table><!-- fin du tableau -->
                </div>
                <!-- Bouton qui permet d'imprimer le tableau ci-dessus -->
                <button type="button" onclick="printdiv('divImprColl');">Imprimer la liste des livres</button>
                <script>
                    //Fonction permettant d'imprimer ce qui se trouve dans le div "divImprColl"
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
  else {//Si aucun livre ne correspond à la recherche désirée
    echo "Aucun livre ne correspond a votre recherche.";
  }
}
else{//En cas d'erreur
  echo "erreur";
}
?>
