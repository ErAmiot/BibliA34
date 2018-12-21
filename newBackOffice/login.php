<?php
$login=htmlentities($_POST["login"]);
$pwd=md5(htmlentities($_POST["pwd"]));

require '../sqlconnect.php';
$sql = "SELECT *  FROM login WHERE LOGID =  '".$login."' AND PWD = '".$pwd."'";
$table = $connection->query($sql);
$count=$table->rowCount();
if ($count > 0) {
	while($ligne = $table->fetch()) {
		session_start();
		$_SESSION['LOGID']=$login;
	}
	header('Location: index.php');
}
else{
	?>
	<script>alert("Erreur: Nom d'utilisateur ou mot de passe incorrect.");
            window.location.href = "backlogin.php";
	</script>
	<?php
}
?>
