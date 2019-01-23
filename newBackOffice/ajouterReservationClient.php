<!DOCTYPE html>
<html>
    <?php
    require_once 'getHead.php';
    setHead();
    ?>
    <body>
        <?php
        session_start();
        require 'getNavClient.php';
        if (isset($_SESSION['CLIENT_NOM'])) {
            # code..
            ?>
            <div id="current_page">
                <h1>Ajout Emprunt</h1><h2>Connecté(e) : <?php echo $_SESSION['CLIENT_NOM']; ?></h2>
            </div>
            <div id="main_content">
                <div id="etape1">
                    <p>
                    <form>
                        <h1>Ajout Emprunt</h1>
                        <?php
                        $isbn = htmlentities($_POST["isbn"]);
                        $client = $_SESSION["CLIENT_NOM"];
                        $idClient = $_SESSION["CLIENT_ID"];
                        $date = date('Y-m-d');
                        $dateRMax = date('Y-m-d', strtotime("+30 days"));

                        require '../sqlconnect.php';
                        //$sql = "SELECT * from emprunter";
                        //$EMP_ID = $ligne['EMP_ID'];

                        $sql = "INSERT INTO emprunter (LIV_ISBN, CLIENT_ID, EMP_ID, EMP_DATE, EMP_ETAT, EMP_DATE_R_MAX, EMP_DATE_R_REEL) VALUES ('" . $isbn . "', '" . $idClient . "', default , '" . $date . "', '0', '" . $dateRMax . "', NULL);";
                        $connection->exec($sql);
                        $sql2 = "UPDATE livre SET LIV_EMPRUNTER = 1 WHERE LIV_ISBN = '$isbn' ";
                        $connection->exec($sql2);
                        echo "Emprunt ajouté.";
                        ?>
                        <br/>
                        <br/>
                        <input type="button" onClick="location.href = 'accueilClient.php';" value="Retour"/>
                    </form>
                    </p>
                </div>
            </div>
            <?php
        } else {

            header('Location: loginClient.html');
        }
        ?>
    </body>
</html>
