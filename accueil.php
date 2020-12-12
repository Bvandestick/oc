<?php

// Démarrage de la session
session_start();

$id_user = $_SESSION['id_user'];
$prenom = $_SESSION['prenom'];
$nom = $_SESSION['nom'];


// Connexion à la base de données

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}




?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8" />
    <title>Accueil</title>

</head>

<body>

    <header>

        <?php
            include('header.php');
        ?>

    </header>

    <div id="corps">

        <div class="acteur">

            <div class="logo_acteur" >
            <p><img src="CDE.png" /></p>
            </div>

            <div class="presentation_acteur" >
                <h3>CDE</h3>
                <p>La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.
                Son président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.</p>
            </div>

            <div class="button_acteur" >
            <a href="acteur.php?id_acteur=4">Lire la suite</a>
            </div>

        </div>


        <div class="acteur">

            <div class="logo_acteur" >
            <p><img src="dsa_france.png" /></p>
            </div>

            <div class="presentation_acteur" >
                <h3>DSA France</h3>
                <p></p>
            </div>

            <div class="button_acteur" >
            <a href="acteur.php?id_acteur=3">Lire la suite</a>
            </div>

        </div>

        <div class="acteur">

            <div class="logo_acteur" >
            <p><img src="protectpeople.png" /></p>
            </div>

            <div class="presentation_acteur" >
                <h3>Protect People</h3>
                <p></p>
            </div>

            <div class="button_acteur" >
            <a href="acteur.php?id_acteur=2">Lire la suite</a>
            </div>

        </div>

        <div class="acteur">

            <div class="logo_acteur" >
            <p><img src="formation_co.png" /></p>
            </div>

            <div class="presentation_acteur" >
                <h3>Formation and co/h3>
                <p></p>
            </div>

            <div class="button_acteur" >
            <a href="acteur.php?id_acteur=1">Lire la suite</a>
            </div>

        </div>
    
    </div>

    <footer>

        <?php include('footer.php'); ?>

    </footer>




</body>

</html>