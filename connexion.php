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
                header("Location:connexion.php");
        }

}

else
{ ?>
        <!DOCTYPE html>

        <html>
        
            <head>
                <meta charset="utf-8" />
                <title>Page de connexion</title>
            </head>
        
            <body>

                <header>
                        <?php include("header.php"); ?>
                </header>

                <div>            
                        <p>Veuillez entrer vos identifiant et mot de passe</p>
                
                        <form action="connexion.php" method="post">
                        <p>
                        <input type="text" name="username" />
                        <input type="password" name="motdepasse" />
                        <input type="submit" value="valider" />
                        </p>
                        </form>
                        <p><a href="lostpass.php">Mot de passe oublié</a></p>
                </div>

                <footer>
                        <?php include("footer.php"); ?>
                </footer>
        
            </body>
        
        </html>  
<?php
}
?>