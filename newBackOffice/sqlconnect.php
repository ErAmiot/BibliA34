<?php

// Connection au serveur
try {
    $dns = 'mysql:host=localhost;dbname=bdsamyn';
    $utilisateur = 'bdsamyn';
    $motDePasse = 'bdsamyn';
    $connection = new PDO( $dns, $utilisateur, $motDePasse );
    $connection->query("SET NAMES utf8");
} catch ( Exception $e ) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}
?>
