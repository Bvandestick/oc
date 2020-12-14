<?php

if (isset($_POST['username']) AND isset($_POST['motdepasse']) AND !empty($_POST['username']) AND !empty($_POST['motdepasse']))
{

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
}

else
{
?>

    <!DOCTYPE html>

    <html>

        <head>
            <meta charset="utf-8" />
            <title>Page de connexion</title>
        </head>

        <body>
        
            <p>Veuillez entrer les identifiant et mot de passe du nouvel utilisateur</p>

            <form action="ajout.php" method="post">
                <p>
                <input type="text" name="username" />
                <input type="password" name="motdepasse" />
                <input type="submit" value="valider" />
                </p>
            </form>


        </body>

    </html>

<?php
}
?>