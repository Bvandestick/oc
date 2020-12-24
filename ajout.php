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
            <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">  
            <link href="style.css" rel="stylesheet">    
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

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>

    </html>

<?php
}
?>