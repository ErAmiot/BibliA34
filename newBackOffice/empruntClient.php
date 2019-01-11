<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
<?php
session_start();
require '../sqlconnect.php';
require 'getNavClient.php';

?>
<body>

<?php if (isset($_SESSION['CLIENT_ID'])){ ?>
    
<center><h2>Mes emprunts : </h2></center>
<table
    <tr>
        <th>Titre</th>
        <th>Date d'emprunt</th>
        <th>Date d'emprunt maximale</th>
        <th>Date rendu</th>
    </tr>

<?php

	$user_id = $_SESSION['CLIENT_ID'];
                                        $reponse = $connection->query("SELECT * FROM emprunter WHERE CLIENT_ID='$user_id'");
                                        while ($donnees = $reponse->fetch()) {
                                        $isbn  = $donnees["LIV_ISBN"];                                    
                                        $reponse1 = $connection->query("SELECT * FROM livre WHERE LIV_ISBN='$isbn' ");
                                        while ($donnees1 = $reponse1->fetch()) {
                                        
                                        ?>
                                                    
                                                       

                                          <?php 
                                          
                                            $don = '                                                 
                                                        <tr> 
                                                            <th>'.$donnees1['LIV_TITRE'].'</th>
                                                            <th>'.$donnees['EMP_DATE'].'</th>
                                                            <th>'.$donnees['EMP_DATE_R_MAX'].'</th>
                                                            <th>'.$donnees['EMP_DATE_R_REEL'].'</th>
                                                        </tr>';
                          	
                                          echo $don;
   					}

                }  

?>
</table>
<?php
    }
?>
</body>
</html>
 
		



