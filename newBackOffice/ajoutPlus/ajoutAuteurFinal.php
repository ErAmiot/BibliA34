<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Accès BackOffice</title>
	<link rel="stylesheet" type="text/css" href="backstyle.css">
    <script type="text/javascript" src="../jsbo.js"></script>
</head>
<body onload="retour();">
    <?php
    		require '../../sqlconnect.php';

      $nom=htmlentities($_POST["autNom"]);
      $prenom=htmlentities($_POST["autPrenom"]);

      $sql="INSERT INTO auteur (AUT_NOM, AUT_PRENOM) VALUES ('".$nom."', '".$prenom."');";
      echo $sql;
      $connection->exec($sql);

      echo "Auteur ajouté maggle"

       ?>
</body>
</html>
