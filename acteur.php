<?php

// Démarrage de la session
session_start();

$id_user = $_SESSION['id_user'];
$prenom = $_SESSION['prenom'];
$nom = $_SESSION['nom'];

$acteur = $_GET['acteur'];

// Connexion à la base de données

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Récupération des données de l'acteur

$quest_acteur = $bdd->query("SELECT id_acteur, description, logo FROM acteurs WHERE acteur = '{$acteur}'");
$data_acteur = $quest_acteur->fetch();

$id_acteur = $data_acteur['id_acteur'];
$description = $data_acteur['description'];
$logo = $data_acteur['logo'];

// Récupération des votes

$quest_like = $bdd->query("SELECT COUNT(*) AS nb_likes FROM votes WHERE vote='like' AND id_acteur='{$id_acteur}'");
$data_like = $quest_like->fetch();

$quest_like = $bdd->query("SELECT COUNT(*) AS nb_dislikes FROM votes WHERE vote='dislike' AND id_acteur='{$id_acteur}'");
$data_like = $quest_like->fetch();

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

        <div>

            <div>
            <p><img src=<?php echo $logo; ?> /></p>
            </div>

            <div>
                <h2><?php echo $acteur; ?></h2>
                <p><?php echo $description; ?></p>
            </div>

        </div>

        <div>

            <div>
                <p>Commentaires</p>
                <div>Ajouter</div>
                <div>
                    

                
                </div>
            </div>

            <div>
                <div>
                    <a href=like.php?id_acteur=<?php echo $id_acteur; ?>>Like</a>
                    <p><?php echo $data_like['nb_likes'] ; ?></p>
                    <a href=dislike.php?id_acteur=<?php echo $id_acteur; ?>>Dislike</a>
                    <p><?php echo $data_like['nb_dislikes'] ; ?></p>

            </div>

        </div>
    



    </div>

    <footer>

        <?php include('footer.php'); ?>

    </footer>




</body>

</html>