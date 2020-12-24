<?php
session_start();

if (isset($_SESSION['id_user']))
{

    $id_user = $_SESSION['id_user'];

    if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['motdepasse']) AND isset($_POST['question']) AND isset($_POST['reponse']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['motdepasse']) AND !empty($_POST['question']) AND !empty($_POST['reponse']))
    {

        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }


        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $motdepasse = htmlspecialchars($_POST['motdepasse']);
        $question = htmlspecialchars($_POST['question']);
        $reponse = htmlspecialchars($_POST['reponse']);

        $pass_hash = password_hash($motdepasse, PASSWORD_DEFAULT);




        $infos = $bdd->prepare("UPDATE account SET nom = :nom, prenom = :prenom, password = :pass_hash, question = :question, reponse = :reponse WHERE id_user = :id_user");
        $infos->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'pass_hash' => $pass_hash,
            'question' => $question,
            'reponse' => $reponse,
            'id_user' => $id_user
        ));

        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;

        header('Location:accueil.php');
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
                <title>Page d'inscription</title>
            </head>

            <body>

            <header>
                <?php include("header.php") ?>
            </header>

            <div class="container py-3 px-3 bg-light">

                <p>Merci de compléter votre profil et choisir un nouveau mot de passe.</p>


                <form action="inscription.php" method="post" class="col-12">
                            <p>
                            <label for="nom">Nom :</label>
                            <br />
                            <input type="text" name="nom" />
                            <br />

                            <label for="prenom">Prénom :</label>
                            <br />
                            <input type="text" name="prenom" />

                            <br />
                            <label for="motdepasse">Mot de passe :</label>
                            <br />
                            <input type="password" name="motdepasse" />

                            <br />
                            <label for="question">Votre question secrète :</label>
                            <br />
                            <input type="text" name="question" />

                            <br />
                            <label for="reponse">Réponse à votre question secrète :</label>
                            <br />
                            <input type="text" name="reponse" />

                            <br />
                            <input type="submit" value="valider" />
                            </p>
                        </form>

            </div>

            <footer>
                <?php include("footer.php") ?>
            </footer>

                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </body>

        </html>
    <?php
    }
}

else
{
    header("connexion.php");
}

