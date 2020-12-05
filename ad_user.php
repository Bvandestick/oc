<?php

// Connexion à la base de données

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Récupération formulaire

$username = htmlspecialchars($_POST['username']);
$motdepasse = htmlspecialchars($_POST['motdepasse']);


// Hachage du mot de passe

$pass_hash = password_hash($motdepasse, PASSWORD_DEFAULT);

// Ajout des données 


$req = $bdd->prepare('INSERT INTO account(nom, prenom, username, password, question, reponse) VALUES(\'\', \'\', :username, :password, \'\', \'\')');
$req->execute(array(
	'username' => $username,
	'password' => $pass_hash,
	));

echo 'Nouvel utilisateur inscrit';
?>