<?php

// Démarrage de la session
session_start();

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

else
{
    header("Location:connexion.php");
}    
?>