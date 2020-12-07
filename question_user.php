<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" />
        <title>question</title>
    </head>

    <body>


<?php

if (isset($_POST['username']))
{

// Connexion à la base
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Récupération des données

$username = htmlspecialchars($_POST['username']);


$reponse = $bdd->query("SELECT id_user, question, reponse FROM account WHERE username = '{$username}'");
$resultat = $reponse->fetch();

?>



    <p>Veuillez répondre à cette question : <?php echo $resultat['question']; ?></p>
    <form action="reponse_user.php?username=<?php echo $username; ?>" method="post">
            <p>
            Votre réponse:<input type="text" name="reponse" />
            <input type="submit" value="valider" />
            </p>
    </form>

<?php


}

else
{
    echo "Veuillez indiquer votre identifiant";
}

?>

    </body>


</html>