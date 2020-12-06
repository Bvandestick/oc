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
            echo $prenom;
        ?>

    </header>

    <div id="corps">

        <div class="acteur">

            <div class="logo_acteur" >
            <p>LOGO ICI</p>
            </div>

            <article>
                <h3>CDE</h3>
                <p>La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.
                Son président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.</p>
            </article>

            <div class="button_acteur" >
            <p>Lire la suite</p>
            </div>

        </div>
    
    </div>

    <footer>

        <?php include('footer.php'); ?>

    </footer>




</body>

</html>