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


// Récupération des like/dislike

$req_vote = $bdd->query("SELECT vote FROM votes WHERE id_user = '{$id_user}' AND id_acteur = '{$id_acteur}'");
$data_vote = $req_vote->fetch();


// Ajout du like

if (!isset($data_vote['vote']))
{
    $req = $bdd->prepare('INSERT INTO votes(id_user, id_acteur, vote) VALUES(:id_user, :id_acteur, :like)');
    $req->execute(array(
        'id_user' => $id_user,
        'id_acteur' => $id_acteur,
        'like' => "like",
        ));
    
    echo "nouveau vote ajouté";
}

else{
    echo "déja voté";
}

?>