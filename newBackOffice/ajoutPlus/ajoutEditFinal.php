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

      $editNom=htmlentities($_POST["editNom"]);
      $editAdrweb=htmlentities($_POST["editAdrweb"]);

      $sql="INSERT INTO editeur (EDIT_NOM, EDIT_ADRWEB) VALUES ('".$editNom."', '".$editAdrweb."');";
      echo $sql;
      $connection->exec($sql);
       ?>
</body>
</html>
