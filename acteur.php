<?php

// Démarrage de la session
session_start();

$id_user = $_SESSION['id_user'];
$prenom = $_SESSION['prenom'];
$nom = $_SESSION['nom'];

$id_acteur = $_GET['id_acteur'];

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

$quest_acteur = $bdd->query("SELECT acteur, description, logo FROM acteurs WHERE id_acteur = '{$id_acteur}'");
$data_acteur = $quest_acteur->fetch();

$acteur = $data_acteur['acteur'];
$description = $data_acteur['description'];
$logo = $data_acteur['logo'];

// Récupération des votes

$quest_like = $bdd->query("SELECT COUNT(*) AS nb_likes FROM votes WHERE vote='like' AND id_acteur='{$id_acteur}'");
$data_like = $quest_like->fetch();

$quest_dislike = $bdd->query("SELECT COUNT(*) AS nb_dislikes FROM votes WHERE vote='dislike' AND id_acteur='{$id_acteur}'");
$data_dislike = $quest_dislike->fetch();





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
                <div><a href=new_post.php?id_acteur=<?php echo $id_acteur; ?>>Ajouter</a></div>
                <div>

                    <a href=like.php?id_acteur=<?php echo $id_acteur; ?>&avis=like>Like</a>
                    <p><?php echo $data_like['nb_likes'] ; ?></p>
                    <a href=like.php?id_acteur=<?php echo $id_acteur; ?>&avis=dislike>Dislike</a>
                    <p><?php echo $data_dislike['nb_dislikes'] ; ?></p>
                </div>
            </div>

            <div>
                <?php

                // Récupération des commentaires

                $quest_comments = $bdd->query("SELECT posts.date_add, posts.post, account.prenom FROM posts, account WHERE posts.id_user = account.id_user AND posts.id_acteur = '{$id_acteur}'");
                
                $data_comments = $quest_comments->fetch();

                
                echo $data_comments['date_add'] . $data_comments['post'] . $data_comments['prenom'];
                
                ?>
        </div>
    



    </div>

    <footer>

        <?php include('footer.php'); ?>

    </footer>




</body>

</html>