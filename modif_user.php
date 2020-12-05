<?php

session_start();

$id_user = $_SESSION['id_user'];


// Connexion à la base de données

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$username = $_POST['username'];
$motdepasse = $_POST['motdepasse'];
$question = $_POST['question'];
$reponse = $_POST['reponse'];



    if (!empty($nom) OR !empty($prenom) OR !empty($motdepasse) OR !empty($question) OR !empty($reponse))
    {
        $req = $bdd->exec("UPDATE account SET nom = '{$nom}', prenom = '{$prenom}', username = '{$username}', password = '{$motdepasse}', question = '{$question}', reponse = '{$reponse}' WHERE id_user = '{$id_user}'");

        header('Location:accueil.php');

    }
    
    
    
    else
    {

        echo "Veuillez remplir tous les champs";
    }      



?>