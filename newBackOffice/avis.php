<?php
session_start();
require '../sqlconnect.php';

$isbn=$_POST['isbn'];
$avis='"'.$_POST['votreAvis'].'"';
$user_id=$_SESSION['CLIENT_ID'];

$sql = "UPDATE emprunter SET AVIS_EMPRUNTER = $avis WHERE LIV_ISBN = '$isbn' AND CLIENT_ID = $user_id";
echo $sql;
$connection->query($sql);

header('Location: empruntClient.php');



