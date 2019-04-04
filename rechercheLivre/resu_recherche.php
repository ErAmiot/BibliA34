<?php
require '../sqlconnect.php';

if (isset($_GET["nomAuteur"])) {

    $nomAuteur = htmlentities($_GET["nomAuteur"]);

    $sql = 'SELECT * from livre, auteur, ecrire, editeur, collection '
            . 'where livre.LIV_ISBN=ecrire.LIV_ISBN '
            . 'and editeur.EDIT_NUM=livre.EDIT_NUM '
            . 'and livre.COL_NUM=collection.COL_NUM '
            . 'and auteur.AUT_NUM=ecrire.AUT_NUM '
            . 'and auteur.AUT_NUM=' . $nomAuteur . '';



    $table = $connection->query($sql);
    $count = $table->rowCount();
    if ($count > 0) {
        ?>
        <div id="divImprAut">
            <table>
                <tr>
                    <th>Titre</th>
                    <th>N° ISBN</th>
                    <th>Editeur</th>
                    <th>Collection</th>
                    <th>Rubrique</th>
                    <th>Date</th>
                </tr>
                <?php
                while ($ligne = $table->fetch()) {
                    $sql = 'select * from rubriques, correspondre '
                            . 'where correspondre.RUB_ID=rubriques.RUB_ID '
                            . 'and correspondre.LIV_ISBN="' . $ligne["LIV_ISBN"] . '"';
                    $table2 = $connection->query($sql);
                    ?>
                    <tr>
                        <td><?php echo $ligne["LIV_TITRE"]; ?></td>
                        <td><?php echo $ligne["LIV_ISBN"]; ?></td>
                        <td><?php echo $ligne["EDIT_NOM"]; ?></td>
                        <td><?php echo $ligne["COL_NOM"]; ?></td>
                        <td><?php
                            while ($donnee = $table2->fetch()) {
                                echo $donnee['RUB_NOM'] . '.<br>';
                            }
                            ?></td>
                        <td><?php echo $ligne["LIV_DATE"]; ?></td>
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
                document.body.innerHTML = headstr + newstr + footstr;
                window.print();
                document.body.innerHTML = oldstr;
                return false;
            }
        </script>
        <?php
    } else {
        echo "Aucun livre ne correspond à votre recherche.";
    }
} elseif (isset($_GET["numEditeur"])) {
    $numEditeur = htmlentities($_GET["numEditeur"]);

    $sql = 'SELECT DISTinct * from livre, editeur, collection '
            . 'where editeur.EDIT_NUM=livre.EDIT_NUM '
            . 'and livre.COL_NUM=collection.COL_NUM '
            . 'and editeur.EDIT_NUM="' . $numEditeur . '"';

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
                    <th>Collection</th>
                    <th>Rubrique</th>
                    <th>Date</th>
                </tr>
                <?php
                while ($ligne = $table->fetch()) {
                    $sql2 = 'select * from rubriques, correspondre '
                            . 'where correspondre.RUB_ID=rubriques.RUB_ID '
                            . 'and correspondre.LIV_ISBN="' . $ligne["LIV_ISBN"] . '"';
                    $table2 = $connection->query($sql2);
                    $sql3 = 'select * from ecrire, auteur '
                            . 'where auteur.AUT_NUM=ecrire.AUT_NUM '
                            . 'and ecrire.LIV_ISBN="' . $ligne['LIV_ISBN'] . '"';
                    $table3 = $connection->query($sql3);
                    ?>
                    <tr>
                        <td><?php echo $ligne["LIV_TITRE"]; ?></td>
                        <td><?php echo $ligne["LIV_ISBN"]; ?></td>
                        <td><?php
                            while ($donnee = $table3->fetch()) {
                                echo $donnee['AUT_PRENOM'] . ' ' . $donnee['AUT_NOM'] . '.<br>';
                            }
                            ?></td>
                        <td><?php echo $ligne["COL_NOM"]; ?></td>
                        <td><?php
                            while ($donnee = $table2->fetch()) {
                                echo $donnee['RUB_NOM'] . '.<br>';
                            }
                            ?></td>
                        <td><?php echo $ligne["LIV_DATE"]; ?></td>
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
                document.body.innerHTML = headstr + newstr + footstr;
                window.print();
                document.body.innerHTML = oldstr;
                return false;
            }
        </script>
        <?php
    } else {
        echo "Aucun livre ne correspond à votre recherche.";
    }
} elseif (isset($_GET["isbn"])) {
    $isbn = htmlentities($_GET["isbn"]);

    $sql2 = 'SELECT DISTinct * from livre, editeur, collection '
            . 'where editeur.EDIT_NUM=livre.EDIT_NUM '
            . 'and livre.COL_NUM=collection.COL_NUM '
            . 'and livre.LIV_ISBN="' . $isbn . '"';
    $table = $connection->query($sql2);
    $count = $table->rowCount();
    if ($count > 0) {
        ?>
        <div id="divImprIsbn">
            <table>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Editeur</th>
                    <th>Collection</th>
                    <th>Rubrique</th>
                    <th>Date</th>
                </tr>
                <?php
                $ligne = $table->fetch()
                ?>
                <tr>
                    <td><?php echo $ligne["LIV_TITRE"]; ?></td>
                    <td><?php
                        $sql = 'select * from ecrire, auteur '
                                . 'where auteur.AUT_NUM=ecrire.AUT_NUM '
                                . 'and ecrire.LIV_ISBN="' . $isbn . '"';
                        $table = $connection->query($sql);
                        while ($donnee = $table->fetch()) {
                            echo $donnee['AUT_PRENOM'] . ' ' . $donnee['AUT_NOM'] . '.<br>';
                        }
                        ?></td>
                    <td><?php echo $ligne["EDIT_NOM"]; ?></td>
                    <td><?php echo $ligne["COL_NOM"]; ?></td>
                    <td><?php
                        $sql = 'select * from rubriques, correspondre '
                                . 'where correspondre.RUB_ID=rubriques.RUB_ID '
                                . 'and correspondre.LIV_ISBN="' . $isbn . '"';
                        $table = $connection->query($sql);
                        while ($donnee = $table->fetch()) {
                            echo $donnee['RUB_NOM'] . '.<br>';
                        }
                        ?></td>
                    <td><?php echo $ligne["LIV_DATE"]; ?></td>
                </tr>
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
                document.body.innerHTML = headstr + newstr + footstr;
                window.print();
                document.body.innerHTML = oldstr;
                return false;
            }
        </script>
        <?php
    } else {
        echo "Aucun livre ne correspond à votre recherche.";
    }
} elseif (isset($_GET["motclef"])) {
    $motclef = htmlentities($_GET["motclef"]);

    $sql = "SELECT *  FROM livre, collection, editeur "
            . "WHERE livre.EDIT_NUM = editeur.EDIT_NUM "
            . "and livre.COL_NUM = collection.COL_NUM "
            . "and livre.LIV_TITRE LIKE '%$motclef%'";
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
                    while ($ligne = $table->fetch()) {
                        $sql2 = 'select * from rubriques, correspondre '
                                . 'where correspondre.RUB_ID=rubriques.RUB_ID '
                                . 'and correspondre.LIV_ISBN="' . $ligne["LIV_ISBN"] . '"';
                        $table2 = $connection->query($sql2);
                        $sql3 = 'select * from ecrire, auteur '
                                . 'where auteur.AUT_NUM=ecrire.AUT_NUM '
                                . 'and ecrire.LIV_ISBN="' . $ligne['LIV_ISBN'] . '"';
                        $table3 = $connection->query($sql3);
                        ?>
                        <tr>
                            <td><?php echo $ligne["LIV_TITRE"]; ?></td>
                            <td><?php echo $ligne["LIV_ISBN"]; ?></td>
                            <td><?php
                                while ($donnee = $table3->fetch()) {
                                    echo $donnee['AUT_PRENOM'] . ' ' . $donnee['AUT_NOM'] . '.<br>';
                                }
                                ?></td>
                            <td><?php echo $ligne["EDIT_NOM"]; ?></td>
                            <td><?php echo $ligne["COL_NOM"]; ?></td>
                            <td><?php
                                while ($donnee = $table2->fetch()) {
                                    echo $donnee['RUB_NOM'] . '.<br>';
                                }
                                ?></td>
                            <td><?php echo $ligne["LIV_DATE"]; ?></td>
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
                    document.body.innerHTML = headstr + newstr + footstr;
                    window.print();
                    document.body.innerHTML = oldstr;
                    return false;
                }
            </script>
            <?php
        } else {
            echo "Aucun livre ne correspond à votre recherche.";
        }
    } elseif (isset($_GET['valRubriques'])) {
        $valRubriques = htmlentities($_GET['valRubriques']);

        $sql = 'SELECT DISTinct * from livre, editeur, collection, rubriques, correspondre '
                . 'where editeur.EDIT_NUM=livre.EDIT_NUM '
                . 'and livre.LIV_ISBN=correspondre.LIV_ISBN '
                . 'and rubriques.RUB_ID=correspondre.RUB_ID '
                . 'and livre.COL_NUM=collection.COL_NUM '
                . 'and rubriques.RUB_ID="' . $valRubriques . '"';
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
                        <th>Date</th>
                    </tr>
                    <?php
                    while ($ligne = $table->fetch()) {
                        $sql = 'select * from ecrire, auteur '
                                    . 'where auteur.AUT_NUM=ecrire.AUT_NUM '
                                    . 'and ecrire.LIV_ISBN="' . $ligne['LIV_ISBN'] . '"';
                        $table = $connection->query($sql);
                        ?>
                        <tr>
                            <td><?php echo $ligne["LIV_TITRE"]; ?></td>
                            <td><?php echo $ligne["LIV_ISBN"]; ?></td>
                            <td><?php while ($donnee = $table->fetch()) {
                                echo $donnee['AUT_PRENOM'] . ' ' . $donnee['AUT_NOM'] . '.<br>';
                            }
                            ?></td>
                            <td><?php echo $ligne["EDIT_NOM"]; ?></td>
                            <td><?php echo $ligne["COL_NOM"]; ?></td>
                            <td><?php echo $ligne["LIV_DATE"]; ?></td>
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
                    document.body.innerHTML = headstr + newstr + footstr;
                    window.print();
                    document.body.innerHTML = oldstr;
                    return false;
                }
            </script>
            <?php
        } else {
            echo "Aucun livre ne correspond à votre recherche.";
        }
    } elseif (isset($_GET['titre'])) {
        $titre = htmlentities($_GET['titre']);

        $sql2 = 'SELECT DISTinct * from livre, editeur, collection '
                . 'where editeur.EDIT_NUM=livre.EDIT_NUM '
                . 'and livre.COL_NUM=collection.COL_NUM '
                . 'and livre.LIV_TITRE="' . $titre . '"';
        $table = $connection->query($sql2);
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
                    $ligne = $table->fetch();
                    ?>
                    <tr>
                        <td><?php echo $ligne["LIV_TITRE"]; ?></td>
                        <td><?php echo $ligne["LIV_ISBN"]; ?></td>
                        <td><?php
                            $sql = 'select * from ecrire, auteur '
                                    . 'where auteur.AUT_NUM=ecrire.AUT_NUM '
                                    . 'and ecrire.LIV_ISBN="' . $ligne['LIV_ISBN'] . '"';
                            $table = $connection->query($sql);
                            while ($donnee = $table->fetch()) {
                                echo $donnee['AUT_PRENOM'] . ' ' . $donnee['AUT_NOM'] . '.<br>';
                            }
                            ?></td>
                        <td><?php echo $ligne["EDIT_NOM"]; ?></td>
                        <td><?php echo $ligne["COL_NOM"]; ?></td>
                        <td><?php
                            $sql = 'select * from rubriques, correspondre '
                                    . 'where correspondre.RUB_ID=rubriques.RUB_ID'
                                    . ' and correspondre.LIV_ISBN="' . $ligne["LIV_ISBN"] . '"';
                            $table2 = $connection->query($sql);
                            while ($donnee = $table2->fetch()) {
                                echo $donnee['RUB_NOM'] . '.<br>';
                            }
                            ?></td>
                        <td><?php echo $ligne["LIV_DATE"]; ?></td>
                    </tr>
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
                    document.body.innerHTML = headstr + newstr + footstr;
                    window.print();
                    document.body.innerHTML = oldstr;
                    return false;
                }
            </script>
            <?php
        } else {
            echo "Aucun livre ne correspond à votre recherche.";
        }
    } elseif (isset($_GET['nomCollection'])) {
        $nomCollection = htmlentities($_GET['nomCollection']);

        $sql = 'SELECT DISTinct * from livre, editeur, collection '
                . 'where editeur.EDIT_NUM=livre.EDIT_NUM '
                . 'and livre.COL_NUM=collection.COL_NUM '
                . 'and collection.COL_NUM="' . $nomCollection . '"';
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
                        <th>Rubrique</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    while ($ligne = $table->fetch()) {
                        $sql = 'select * from rubriques, correspondre '
                                . 'where correspondre.RUB_ID=rubriques.RUB_ID '
                                . 'and correspondre.LIV_ISBN="' . $ligne["LIV_ISBN"] . '"';
                        $table2 = $connection->query($sql);
                        $sql3 = 'select * from ecrire, auteur '
                                . 'where auteur.AUT_NUM=ecrire.AUT_NUM '
                                . 'and ecrire.LIV_ISBN="' . $ligne['LIV_ISBN'] . '"';
                        $table3 = $connection->query($sql3);
                        ?>
                        <tr>
                            <td><?php echo $ligne["LIV_TITRE"]; ?></td>
                            <td><?php echo $ligne["LIV_ISBN"]; ?></td>
                            <td><?php
                                while ($donnee = $table3->fetch()) {
                                    echo $donnee['AUT_PRENOM'] . ' ' . $donnee['AUT_NOM'] . '.<br>';
                                }
                                ?></td>
                            <td><?php echo $ligne["EDIT_NOM"]; ?></td>
                            <td><?php
                                while ($donnee = $table2->fetch()) {
                                    echo $donnee['RUB_NOM'] . '.<br>';
                                }
                                ?></td>
                            <td><?php echo $ligne["LIV_DATE"]; ?></td>
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
                    document.body.innerHTML = headstr + newstr + footstr;
                    window.print();
                    document.body.innerHTML = oldstr;
                    return false;
                }
            </script>
            <?php
        } else {
            echo "Aucun livre ne correspond à votre recherche.";
        }
    } else {
        echo "erreur";
    }
    ?>
