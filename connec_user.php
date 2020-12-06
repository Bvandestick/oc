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

// Récupération des données du formulaire

$username = $_POST['username'];
$motdepasse = $_POST['motdepasse'];


// Récupération des données de la base

$reponse = $bdd->query("SELECT id_user, password, nom, prenom FROM account WHERE username = '{$username}'");
$resultat = $reponse->fetch();


// Décryptage du mot de passe

$passwordcorrect = password_verify($motdepasse, $resultat['password']);



// Vérification champs remplis

if (empty($username) OR empty($motdepasse))
{
        echo "Veuillez remplir tous les champs";
}

// Vérification des identifiants

elseif ($passwordcorrect AND empty($resultat['nom']))
{
        session_start();

        $_SESSION['id_user'] = $resultat['id_user'];

        header("Location:inscription.php");
}

elseif ($passwordcorrect)
{
        session_start();

        $_SESSION['id_user'] = $resultat['id_user'];
        $_SESSION['prenom'] = $resultat['prenom'];
        $_SESSION['nom'] = $resultat['nom'];

        header("Location:accueil.php");
}      


else
{
        echo "Mauvais identifiant ou mot de passe";
}

?>