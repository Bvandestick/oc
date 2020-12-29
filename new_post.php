<?php

// Démarrage de la session
session_start();

// Vérification session
if (isset($_SESSION['id_user']))
{

    $id_user = $_SESSION['id_user'];
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $id_acteur = htmlspecialchars($_GET['id_acteur']);

    // Connexion à la base de données

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

    // Récupération données

    $req_post = $bdd->query("SELECT post FROM posts WHERE id_user = '{$id_user}' AND id_acteur = '{$id_acteur}'");
    $data_post = $req_post->fetch();

    // Ajout du commentaire si jamais posté

    if (empty($data_post['post']))

    {

        $comment = htmlspecialchars($_POST['comment']);

        $req = $bdd->prepare('INSERT INTO posts(id_user, id_acteur, date_add, post) VALUES(:id_user, :id_acteur, :date_add, :post)');
        $req->execute(array(
            'id_user' => $id_user,
            'id_acteur' => $id_acteur,
            'date_add' => date("Y-m-d H:i:s"),
            'post' => $comment,
            ));

        header("Location:acteur.php?id_acteur=$id_acteur");

    }

    // Si déjà posté on renvoie à la page de l'acteur
    else
    {
        header("Location:acteur.php?id_acteur=$id_acteur&result=already_post");
    }

}

// Si session inexistante on renvoie à la page de connexion

else
{
    header("Location:connexion.php");
}    
?>