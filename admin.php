<?php
session_start();

// Vérification session

if (isset($_SESSION['id_user']))

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

    // Récupération du statut de l'utilisateur

    $id_user = $_SESSION['id_user'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];

    $reponse = $bdd->query("SELECT statut FROM account WHERE id_user = '{$id_user}'");
    $resultat = $reponse->fetch();

    // Si administrateur on affiche la page

    if ($resultat['statut'] == "admin")
    {

        // Si tous les champs sont complétés on ajoute le nouvel utilisateur
        if (isset($_POST['username']) AND isset($_POST['motdepasse']) AND !empty($_POST['username']) AND !empty($_POST['motdepasse']))
        {



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

        // Si les champs ne sont pas complétés on affiche le formulaire
        else
        {
        ?>

            <!DOCTYPE html>

            <html>

                <head>
                    <meta charset="utf-8" />
                    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">  
                    <link href="css/style.css" rel="stylesheet">    
                    <title>Admininstration</title>
                </head>

                <body>

                    <header>

                        <?php
                            include('header.php');
                        ?>

                    </header>

                    <div class="container bg-light py-3 px-3">
                
                        <p>Veuillez entrer les identifiant et mot de passe du nouvel utilisateur</p>

                        <form action="admin.php" method="post">
                            <p>
                            <input type="text" name="username" placeholder="username" />
                            <input type="password" name="motdepasse" placeholder="mot de passe" />
                            <input type="submit" value="valider" />
                            </p>
                        </form>

                    </div>

                    <footer>

                        <?php 
                            include("footer.php");
                        ?>

                    </footer>

                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                </body>

            </html>

        <?php
        }

    }

    // Si utilisateur non autorisé on renvoie à la page de connexion
    else
    {
        header("Location:connexion.php");
    }
     
}

// Si pas de session on renvoie à la page de connexion
else
{
    header("Location:connexion.php");
}
?>