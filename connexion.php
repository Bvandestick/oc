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

        // Récupération des données du formulaire

        $username = $_POST['username'];
        $motdepasse = $_POST['motdepasse'];


        // Récupération des données de la base

        $reponse = $bdd->query("SELECT id_user, password, nom, prenom FROM account WHERE username = '{$username}'");
        $resultat = $reponse->fetch();


        // Décryptage du mot de passe

        $passwordcorrect = password_verify($motdepasse, $resultat['password']);


        // Vérification des identifiants

        if ($passwordcorrect AND empty($resultat['nom']))
        {
                session_start();

                $_SESSION['id_user'] = $resultat['id_user'];

                header("Location:inscription.php");
        }

        if ($passwordcorrect AND !empty($resultat['nom']))
        {
                session_start();

                $_SESSION['id_user'] = $resultat['id_user'];
                $_SESSION['prenom'] = $resultat['prenom'];
                $_SESSION['nom'] = $resultat['nom'];

                header("Location:accueil.php");
        }   
        
        if (!$passwordcorrect)
        {
                header("Location:connexion.php?result=error");
        }

}


else
{
?>
                <!DOCTYPE html>

                <html>

                <head>
                        <meta charset="utf-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">  
                        <link href="style.css" rel="stylesheet">
                        <title>Page de connexion</title>
                </head>

                <body>

                        <header>
                                <?php include("header.php"); ?>
                        </header>

                        <div class="container bg-light px-3 py-3">

                                <?php
                                if (isset($_GET['result']) AND $_GET['result'] = 'error' )
                                {
                                ?>        
                                <p class="alert alert-danger" role="alert">Mauvais identifiant ou mot de passe</p>
                                <?php
                                }

                                ?>
                                
                                <p>Veuillez entrer vos identifiant et mot de passe</p>
                        
                                <form action="connexion.php" method="post">
                                <p>
                                <input type="text" name="username" placeholder="username" required/>
                                <input type="password" name="motdepasse" placeholder="motdepasse" required/>
                                <input type="submit" value="valider" />
                                </p>
                                </form>
                                <p><a href="lostpass.php">Mot de passe oublié</a></p>
                        </div>

                        <footer>
                                <?php include("footer.php"); ?>
                        </footer>

                        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                </body>

                </html>
<?php  
}
?>