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
                <title>Page d'inscription</title>
            </head>

            <body>

                <p>Merci de compléter votre profil et choisir un nouveau mot de passe.</p>

                <form action="inscription.php" method="post">
                    <p>
                    <input type="text" name="nom" />
                    <input type="text" name="prenom" />
                    <input type="password" name="motdepasse" />
                    <input type="text" name="question" />
                    <input type="text" name="reponse" />
                    <input type="submit" value="valider" />
                    </p>
                </form>


            </body>

        </html>
    <?php
    }
}

else
{
    header("connexion.php");
}

