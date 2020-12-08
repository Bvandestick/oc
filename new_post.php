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







if (isset($_POST['comment']))
{

    $comment = $_POST['comment'];

    $req = $bdd->prepare('INSERT INTO posts(id_user, id_acteur, date_add, post) VALUES(:id_user, :id_acteur, :date_add, :post)');
    $req->execute(array(
        'id_user' => $id_user,
        'id_acteur' => $id_acteur,
        'date_add' => date("Y-m-d H:i:s"),
        'post' => $comment,
        ));



}

else
{


?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" />
        <title>Nouveau commentaire</title>
    </head>

    <body>
    
        <p>Commentez ici l'acteur</p>

        <form action="new_post.php?id_acteur=<?php echo $id_acteur; ?>" method="post">
            <p>
            <input type="text" name="comment" />
            <input type="submit" value="valider" />
            </p>
        </form>


    </body>

</html>

<?php } ?>