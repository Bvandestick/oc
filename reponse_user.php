<?php 

session_start();


try
{
	$bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Récupération des données du formulaire

$answer = $_POST['reponse'];
$username = $_SESSION['username'];

// Récupération des données de la base

$reponse = $bdd->query("SELECT id_user, reponse FROM account WHERE username = '{$username}'");
$resultat = $reponse->fetch();

// Vérification

if ($answer == $resultat['reponse'])
{

echo "ok";
$_SESSION['id_user'] = $resultat['id_user'];
header("Location:inscription.php");


}

else
{
    echo "echec";
}

?>

