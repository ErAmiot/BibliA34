<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Accès BackOffice</title>
</head>
<body onload="location.href = '../index.php';">
	<?php
	session_start();
	if (isset($_SESSION['LOGID'])) {
		# code..
	?>
		<h1>Ajout</h1>
		<?php
		$titre=htmlentities($_POST["titre"]);
                echo $titre;
		$auteur=htmlentities($_POST["auteur"]);
		echo $auteur;
                $collection=htmlentities($_POST["collection"]);
		echo $collection;
                $editeur=htmlentities($_POST["editeur"]);
		echo $editeur;
                $rubrique=htmlentities($_POST["rubrique"]);
		echo $rubrique;
                $isbn=htmlentities($_POST["isbn"]);
		echo $isbn;
                $date=htmlentities($_POST["date"]);
                echo $date;

		require '../../sqlconnect.php';

		$sql="INSERT INTO livre (LIV_ISBN, COL_NUM, EDIT_NUM, LIV_TITRE, LIV_DATE) VALUES ('".$isbn."', '".$collection."', '".$editeur."', '".$titre."','".$date."');";
		$sql2="INSERT INTO ecrire (AUT_NUM, LIV_ISBN) VALUES ('".$auteur."', '".$isbn."');";
		$sql3="INSERT INTO correspondre (RUB_ID, LIV_ISBN) VALUES ('".$rubrique."', '".$isbn."');";
		$connection->exec($sql);
		$connection->exec($sql2);
		$connection->exec($sql3);
		echo "le livre a bien été ajouté.";

		?>
		<br/>
		<br/>
	<?php
	}
	else{
		header('Location: login.html');
	}
	?>

</body>
</html>
